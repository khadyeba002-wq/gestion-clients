<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Create admin user if it doesn't exist
        if ($this->app->environment('production')) {
            try {
                User::updateOrCreate(
                    ['email' => 'admin@ladyshome.com'],
                    [
                        'name' => 'Admin LadyHome',
                        'password' => Hash::make('password'),
                        'role' => 'admin',
                    ]
                );
            } catch (\Exception $e) {
                // Silently fail if database isn't ready yet
            }
        }
    }
}
