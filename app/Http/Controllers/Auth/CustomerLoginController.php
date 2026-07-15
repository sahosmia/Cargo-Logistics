<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\GenerateOTPAction;
use App\Actions\Auth\SendOTPAction;
use App\Actions\Auth\VerifyOTPAction;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestOTPRequest;
use App\Http\Requests\Auth\VerifyOTPRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class CustomerLoginController extends Controller
{
    /**
     * Show the customer login page.
     */
    public function showLoginForm(): Response
    {
        return Inertia::render('auth/customer-login');
    }

    /**
     * Request an OTP for the given phone number.
     */
    public function requestOTP(
        RequestOTPRequest $request,
        GenerateOTPAction $generateOTPAction,
        SendOTPAction $sendOTPAction
    ) {
        $validated = $request->validated();

        $phone = $validated['phone_number'];

        // Rate limiting for requesting OTP
        $this->ensureOTPRequestIsNotRateLimited($request);

        $user = User::where('phone_number', $phone)->first();
        if (! $user) {
            $user = User::create([
                'phone_number' => $phone,
                'name' => 'Customer '.substr($phone, -4),
                'role' => UserRole::Customer,
                'email' => ! empty($validated['email']) ? $validated['email'] : null,
            ]);
        } else {
            if (! empty($validated['email']) && empty($user->email)) {
                $user->update([
                    'email' => $validated['email'],
                ]);
            }
        }

        $otp = $generateOTPAction->execute();
        $sendOTPAction->execute($phone, $otp);

        return back()->with([
            'message' => 'OTP sent successfully.',
            'otp' => $otp,
        ]);
    }

    /**
     * Verify the OTP and log the customer in.
     */
    public function verifyOTP(
        VerifyOTPRequest $request,
        VerifyOTPAction $verifyOTPAction
    ) {

        // return "asdf";
        $validated = $request->validated();

        $phone = $validated['phone_number'];
        $otp = $validated['otp'];

        // Rate limiting for verifying OTP
        $this->ensureOTPVerificationIsNotRateLimited($request);

        if ($verifyOTPAction->execute($phone, $otp)) {
            $user = User::where('phone_number', $phone)->firstOrFail();

            Auth::guard('customer')->login($user, $request->boolean('remember'));

            $request->session()->regenerate();

            RateLimiter::clear($this->otpVerificationThrottleKey($request));

            // return redirect()->intended(route('customer.dashboard'));
            $redirectResponse = redirect()->intended(route('customer.dashboard'));
            $targetUrl = $redirectResponse->getTargetUrl();

            $path = parse_url($targetUrl, PHP_URL_PATH);
            $path = '/'.ltrim($path, '/');

            if ($path === '/booking' || str_starts_with($path, '/booking/')) {
                return Inertia::location($targetUrl);
            }

            return $redirectResponse;
        }

        RateLimiter::hit($this->otpVerificationThrottleKey($request), 3600); // Block for 1 hour if too many attempts

        throw ValidationException::withMessages([
            'otp' => 'The provided OTP is invalid.',
        ]);
    }

    protected function ensureOTPRequestIsNotRateLimited(Request $request)
    {
        $key = 'otp_request_'.$request->phone_number.'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'phone_number' => "Too many OTP requests. Please try again in {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($key, 60); // 1 minute window for requests
    }

    protected function ensureOTPVerificationIsNotRateLimited(Request $request)
    {
        $key = $this->otpVerificationThrottleKey($request);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $hours = ceil($seconds / 3600);
            throw ValidationException::withMessages([
                'otp' => "Too many failed attempts. Please try again in {$hours} hour(s).",
            ]);
        }
    }

    /**
     * Log the customer out of the application.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function otpVerificationThrottleKey(Request $request): string
    {
        return 'otp_verify_'.$request->phone_number.'|'.$request->ip();
    }
}
