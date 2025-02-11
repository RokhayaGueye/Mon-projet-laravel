<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TelegramService; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Enregistre le TelegramService
        $this->app->singleton(TelegramService::class, function ($app) {
            return new TelegramService();  
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
