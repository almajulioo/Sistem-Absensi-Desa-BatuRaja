<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
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
        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Home')
                    ->url('/') 
                    ->icon('heroicon-o-arrow-left') 
                    ->group('Quick Links') 
                    ->sort(1), 
            ]);
        });
        // $this->app['request']->server->set('HTTPS', true);
    }
}
