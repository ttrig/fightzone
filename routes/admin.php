<?php

use App\Http\Controllers\Admin\AlertController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PaymentArticleController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['english', 'auth'],
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('', IndexController::class)->name('index');

    Route::resource('user', UserController::class)->except('show');
    Route::resource('alert', AlertController::class)->except('show');
    Route::resource('text', TextController::class)->only(['index', 'edit', 'update']);
    Route::put('event/{event}/disable', [EventController::class, 'disable'])->name('event.disable');
    Route::put('event/{event}/enable', [EventController::class, 'enable'])->name('event.enable');
    Route::resource('event', EventController::class)->except('show');
    Route::resource('payment_article', PaymentArticleController::class)->except('show');
});
