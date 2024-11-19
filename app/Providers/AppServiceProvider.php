<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Config;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        if (Schema::hasTable('site_settings')) {
            $site_settings = SiteSetting::first();
            if ($site_settings) {
                $data = $site_settings->app_name;

                Config(['app.name' => $data]);
            }
        } // End If

    }
}
