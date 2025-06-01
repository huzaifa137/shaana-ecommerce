<?php
namespace App\Providers;

use App\Http\Middleware\CustomerAuth;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Router $router): void
    {
        $router->aliasMiddleware('CustomerAuth', CustomerAuth::class);
    }
}
