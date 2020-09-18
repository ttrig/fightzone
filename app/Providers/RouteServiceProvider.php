<?php

namespace App\Providers;

use App\Models;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    public function boot()
    {
        Route::model('user', Models\User::class);
        Route::model('activity', Models\Activity::class);
        Route::model('event', Models\Event::class);
        Route::model('alert', Models\Alert::class);
        Route::model('text', Models\Text::class);
        Route::model('payment_article', Models\PaymentArticle::class);

        $this->routes(function () {
            Route::middleware('web')->group(base_path('routes/web.php'));
            Route::middleware('web')->group(base_path('routes/admin.php'));
        });
    }
}
