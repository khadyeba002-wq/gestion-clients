<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Category;
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

        // Create admin user and categories if they don't exist in production
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

                $categories = [
                    'Parfum',
                    'Maquillage',
                    'Soin',
                    'Accessoire',
                    'perruques',
                    'Chaussures',
                    'vetements',
                ];

                foreach ($categories as $name) {
                    Category::updateOrCreate(['name' => $name], ['name' => $name]);
                }
            } catch (\Exception $e) {
                // Silently fail if database isn't ready yet
            }
        }
    }
}
