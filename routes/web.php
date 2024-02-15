<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\KidsBjjController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TvController;
use App\Http\Controllers\YouthBjjController;
use App\Http\Controllers\YouthBoxingController;
use App\Http\Controllers\YouthKickboxingController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('lang/{lang}', [HomeController::class, 'lang'])->name('lang');
Route::get('schedule', ScheduleController::class)->name('schedule');
Route::get('prices', PriceController::class)->name('prices');
Route::get('youth-bjj', YouthBjjController::class)->name('youth_bjj');
Route::get('kids-bjj', KidsBjjController::class)->name('kids_bjj');
Route::get('youth-boxing', YouthBoxingController::class)->name('youth_boxing');
Route::get('youth-kickboxing', YouthKickboxingController::class)->name('youth_kickboxing');
Route::get('join', JoinController::class)->name('join');
Route::get('history', HistoryController::class)->name('history');
Route::get('facility', FacilityController::class)->name('facility');
Route::view('partners', 'partners')->name('partners');
Route::view('contact', 'contact')->name('contact');
Route::get('sitemap.xml', SitemapController::class)->name('sitemap');

Route::redirect('about', 'history');

# dashboards
Route::get('tv', TvController::class)->name('tv');

# training
Route::get('bjj', TrainingController::class)->name('bjj');
Route::get('boxing', TrainingController::class)->name('boxing');
Route::get('kickboxing', TrainingController::class)->name('kickboxing');
Route::redirect('/nogi', '/');
Route::get('sac', TrainingController::class)->name('sac');
Route::get('gym', TrainingController::class)->name('gym');

# payment
Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
    Route::get('', [PaymentController::class, 'index'])->name('index');
    Route::get('monthly-costs', [PaymentController::class, 'getMonthlyCosts'])
        ->name('monthly-costs');
    Route::get('checkout/{payment_article}', [PaymentController::class, 'checkout'])
        ->name('checkout');
});

# auth
Route::group(['middleware' => 'english'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::get('', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('', [LoginController::class, 'login']);
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
