<?php

use App\Models\PaymentArticle;
use Faker\Generator as Faker;

$factory->define(PaymentArticle::class, function (Faker $faker) {
    static $number = 1000;
    return [
        'name_sv' => $faker->sentence(3),
        'name_en' => $faker->sentence(3),
        'content_sv' => $faker->paragraph(2),
        'content_en' => $faker->paragraph(2),
        'number' => $number++,
        'price' => $faker->randomNumber(4),
        'active' => true,
    ];
});

$factory->state(PaymentArticle::class, 'inactive', ['active' => false]);
