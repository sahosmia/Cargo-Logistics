<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
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
        //

        View::composer(['layouts.frontend', 'app'], function ($view) {
            $logoUrl = asset('images/techpickly-transparent-logo.jpg');
            $faviconUrl = asset('images/favicon.png');

            try {
                if (Schema::hasTable('settings')) {

                    $dbLogo = settings('site_logo');
                    if ($dbLogo && Storage::disk('public')->exists($dbLogo)) {
                        $logoUrl = Storage::disk('public')->url($dbLogo);
                    }

                    $dbFavicon = settings('favicon');
                    if ($dbFavicon && Storage::disk('public')->exists($dbFavicon)) {
                        $faviconUrl = Storage::disk('public')->url($dbFavicon);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('Settings table missing or DB connection failed: ' . $e->getMessage());
            }

            $view->with([
                'siteLogoUrl'    => $logoUrl,
                'siteFaviconUrl' => $faviconUrl,
            ]);
        });
    }
}
