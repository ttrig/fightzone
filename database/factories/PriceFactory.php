<?php

use App\Models\Activity;
use App\Models\Price;

$factory->define(Price::class, function (Faker\Generator $faker) {
    return [
        'activity_id' => function () {
            return factory(Activity::class)->states('has-prices')->create()->id;
        },
        'adult_1_m' => $faker->randomNumber(3),
        'adult_6_m' => $faker->randomNumber(4),
        'adult_1_y' => $faker->randomNumber(4),
        'youth_1_m' => $faker->randomNumber(3),
        'youth_6_m' => $faker->randomNumber(4),
        'youth_1_y' => $faker->randomNumber(4),
    ];
});
