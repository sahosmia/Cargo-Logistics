<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return array_merge(parent::share($request), [
            'name' => settings('app_name', config('app.name')),
            'settings' => [
                'app_name' => settings('app_name', config('app.name')),
                'logo' => settings('site_logo') && \Illuminate\Support\Facades\Storage::disk('public')->exists(settings('site_logo'))
                    ? \Illuminate\Support\Facades\Storage::disk('public')->url(settings('site_logo'))
                    : asset('logo.svg'),
                'default_vat' => settings('default_vat', 0),
                'default_ait' => settings('default_ait', 0),
                'quotation_thanks_text' => settings('quotation_thanks_text'),
            ],
            'auth' => [
                'user' => $request->user() ? array_merge($request->user()->toArray(), [
                    'roles' => $request->user()->getRoleNames(),
                    'permissions' => $request->user()->getAllPermissions()->pluck('name'),
                ]) : ($request->user('customer') ? $request->user('customer')->toArray() : null),
                'guard' => $request->user() ? 'admin' : ($request->user('customer') ? 'customer' : null),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'flash' => [
                'message' => $request->session()->get('message'),
                'success' => $request->session()->get('success'),
                'error'   => $request->session()->get('error'),
                'otp'     => $request->session()->get('otp'),
            ],
        ]);
    }
}
