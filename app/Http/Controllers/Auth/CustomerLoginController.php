<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Actions\Auth\GenerateOTPAction;
use App\Actions\Auth\SendOTPAction;
use App\Actions\Auth\VerifyOTPAction;
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
        Request $request,
        GenerateOTPAction $generateOTPAction,
        SendOTPAction $sendOTPAction
    ) {
        $request->validate([
            'phone_number' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:10'],
        ]);

        $phone = $request->phone_number;

        // Rate limiting for requesting OTP
        $this->ensureOTPRequestIsNotRateLimited($request);

        $user = User::firstOrCreate(
            ['phone_number' => $phone],
            [
                'name' => 'Customer ' . substr($phone, -4),
                'role' => UserRole::Customer,
            ]
        );

        $otp = $generateOTPAction->execute();
        $sendOTPAction->execute($phone, $otp);

        return back()->with('message', 'OTP sent successfully.');
    }

    /**
     * Verify the OTP and log the customer in.
     */
    public function verifyOTP(
        Request $request,
        VerifyOTPAction $verifyOTPAction
    ) {
        $request->validate([
            'phone_number' => ['required', 'string'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $phone = $request->phone_number;
        $otp = $request->otp;

        // Rate limiting for verifying OTP
        $this->ensureOTPVerificationIsNotRateLimited($request);

        if ($verifyOTPAction->execute($phone, $otp)) {
            $user = User::where('phone_number', $phone)->firstOrFail();

            Auth::guard('customer')->login($user, $request->boolean('remember'));

            $request->session()->regenerate();

            RateLimiter::clear($this->otpVerificationThrottleKey($request));

            return redirect()->intended(route('dashboard'));
        }

        RateLimiter::hit($this->otpVerificationThrottleKey($request), 3600); // Block for 1 hour if too many attempts

        throw ValidationException::withMessages([
            'otp' => 'The provided OTP is invalid.',
        ]);
    }

    protected function ensureOTPRequestIsNotRateLimited(Request $request)
    {
        $key = 'otp_request_' . $request->phone_number . '|' . $request->ip();

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
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function otpVerificationThrottleKey(Request $request): string
    {
        return 'otp_verify_' . $request->phone_number . '|' . $request->ip();
    }
}
