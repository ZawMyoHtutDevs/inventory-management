<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Should return TRUE or FALSE
        Gate::define('admin', function() {
            return auth()->user()->is_admin == 1;
        });

        // Is Active Plan
        Gate::define('is_active', function() {
            return auth()->user()->agency->end_date > Carbon::now();
            // return auth()->user()->agency->status === 'active';
        });

        
        
        Schema::defaultStringLength(191);

    }
}
