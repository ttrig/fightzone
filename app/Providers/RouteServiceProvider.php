<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Alert;
use App\Models\Event;
use App\Models\Price;
use App\Models\Text;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();

        Route::model('user', User::class);
        Route::model('activity', Activity::class);
        Route::model('event', Event::class);
        Route::model('price', Price::class);
        Route::model('alert', Alert::class);
        Route::model('text', Text::class);
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
