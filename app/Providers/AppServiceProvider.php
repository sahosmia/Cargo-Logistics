<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\User;
use App\Observers\BookingObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Booking::observe(BookingObserver::class);
        User::observe(UserObserver::class);

        try {
            if (Schema::hasTable('settings')) {
                config([
                    // 'mail.default' => settings('mail_mailer') ?: config('mail.default'),
                    'mail.mailers.smtp.host' => settings('mail_host') ?: config('mail.mailers.smtp.host'),
                    'mail.mailers.smtp.port' => settings('mail_port') ?: config('mail.mailers.smtp.port'),
                    'mail.mailers.smtp.username' => settings('mail_username') ?: config('mail.mailers.smtp.username'),
                    'mail.mailers.smtp.password' => settings('mail_password') ?: config('mail.mailers.smtp.password'),
                    'mail.mailers.smtp.encryption' => settings('mail_encryption') ?: config('mail.mailers.smtp.encryption'),
                    'mail.from.address' => settings('mail_from_address') ?: config('mail.from.address'),
                    'mail.from.name' => settings('mail_from_name') ?: config('mail.from.name'),
                ]);
            }
        } catch (\Exception $e) {
            // Safe fallback during migrations
        }

        View::composer(['layouts.frontend', 'app'], function ($view) {
            $logoUrl = asset('images/techpickly-transparent-logo.png');
            $faviconUrl = asset('images/favicon.png');

            try {
                if (Schema::hasTable('settings')) {

                    $dbLogo = settings('site_logo');
                    if (! empty($dbLogo)) {
                        $logoUrl = asset('storage/'.$dbLogo);
                    }

                    $dbFavicon = settings('favicon');
                    if (! empty($dbFavicon)) {
                        $faviconUrl = asset('storage/'.$dbFavicon);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('Settings table missing or DB connection failed: '.$e->getMessage());
            }

            $view->with([
                'siteLogoUrl' => $logoUrl,
                'siteFaviconUrl' => $faviconUrl,
            ]);
        });
    }
}
