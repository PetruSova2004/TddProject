<?php

namespace App\Providers;

use App\Http\Controllers\Api\Pub\Cart\Services\CartService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartService::class, function () {
            return new CartService();
        });
        // Метод singleton регистрирует службу как singleton, что означает, что один и тот же экземпляр будет повторно использоваться в нескольких запросах, а метод bind регистрирует службу как новый экземпляр при каждом запросе.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
