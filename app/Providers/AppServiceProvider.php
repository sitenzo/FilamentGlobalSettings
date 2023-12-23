<?php

namespace App\Providers;

use Filament\Support\View\Components\Modal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

use Filament\Tables;

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
        Model::unguard();
    }
}
