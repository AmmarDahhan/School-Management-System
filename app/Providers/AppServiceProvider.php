<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        // $this->app->booted(function () {
        //     Livewire::setUpdateRoute(function ($handle) {
        //         $locale = request()->segment(1);
        //         $locales = config('app.locales', ['en', 'ar']);
        //         $localePrefix = in_array($locale, $locales) ? '/' . $locale : '';
        //         return Route::post($localePrefix . '/livewire/update', function () use ($handle) {
        //             return $handle(request());
        //         })->name('livewire.update');
        //     });
        // });

        // Livewire::ignoreRoutes();
    }
}
