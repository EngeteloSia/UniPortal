<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Http\Middleware\RoleMiddleware;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // ✅ Register custom middleware alias
        Route::aliasMiddleware('role', RoleMiddleware::class);

        // Optional: existing route groups
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
