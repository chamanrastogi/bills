<?php
namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
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
        // Skip CLI / Artisan / Queue
        if (app()->runningInConsole()) {
            return;
        }
        if (! app()->environment(['production', 'staging'])) {
            return;
        }
                                               // 🔒 DEFINE YOUR LICENSED DOMAIN HERE
        $allowedDomain = 'aasthajewellers.in'; // change this

        $currentDomain = Request::getHost();

        // Normalize (remove www)
        $normalize = fn($domain) => ltrim(strtolower($domain), 'www.');

        if ($normalize($currentDomain) !== $normalize($allowedDomain)) {
            abort(403, 'Unauthorized domain.');
        }
        //
        if (Schema::hasTable('site_settings')) {
            $site_settings = SiteSetting::first();
            if ($site_settings) {
                $data = $site_settings->app_name;

                Config(['app.name' => $data]);
            }
        } // End If

    }
}
