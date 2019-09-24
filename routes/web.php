<?php

Route::get('', 'HomeController@index')->name('home');
Route::get('lang/{lang}', 'HomeController@lang')->name('lang');
Route::get('schedule', 'ScheduleController')->name('schedule');
Route::get('prices', 'PriceController')->name('prices');
Route::get('kids-bjj', 'KidsBjjController')->name('kids_bjj');
Route::get('kids-boxing', 'KidsBoxingController')->name('kids_boxing');
Route::get('join', 'JoinController')->name('join');
Route::get('about', 'AboutController')->name('about');
Route::view('contact', 'contact')->name('contact');
Route::get('sitemap.xml', 'SitemapController')->name('sitemap');

# dashboards
Route::get('tv', 'TvController')->name('tv');

# training
Route::get('bjj', 'TrainingController')->name('bjj');
Route::get('boxing', 'TrainingController')->name('boxing');
Route::get('kickboxing', 'TrainingController')->name('kickboxing');
Route::get('wrestling', 'TrainingController')->name('wrestling');
Route::get('nogi', 'TrainingController')->name('nogi');
Route::get('sac', 'TrainingController')->name('sac');
Route::get('gym', 'TrainingController')->name('gym');

# auth
Route::group(['namespace' => 'Auth', 'middleware' => 'english'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::get('', 'LoginController@showLoginForm')->name('login');
        Route::post('', 'LoginController@login');
    });
    Route::post('logout', 'LoginController@logout')->name('logout');
});

# admin
Route::group([
    'namespace' => 'Admin',
    'middleware' => ['english', 'auth'],
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('', 'IndexController')->name('index');

    Route::resource('user', 'UserController');
    Route::resource('alert', 'AlertController');
    Route::resource('text', 'TextController')->only(['index', 'edit', 'update']);
    Route::resource('event', 'EventController');

    Route::group([
        'prefix' => 'price',
        'as'     => 'price.',
    ], function () {
        Route::get('', 'PriceController@index')->name('index');
        Route::post('', 'PriceController@update')->name('update');
    });
});
