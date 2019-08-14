<?php

namespace App\Providers;

use App\Models;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();

        Route::model('user', Models\User::class);
        Route::model('activity', Models\Activity::class);
        Route::model('event', Models\Event::class);
        Route::model('price', Models\Price::class);
        Route::model('alert', Models\Alert::class);
        Route::model('text', Models\Text::class);
        Route::model('payment_article', Models\PaymentArticle::class);
    }

    public function map()
    {
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'))
        ;
    }
}
