<?php

use App\Models\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, fn(Faker $faker) => [
    'slug' => $faker->randomElement([
        'bjj',
        'boxing',
        'kickboxing',
        'wrestling',
        'nogi',
        'sac',
        'gym',
        'kids-bjj',
    ]),
]);

$factory->state(Activity::class, 'has-prices', fn(Faker $faker) => [
    'slug' => $faker->randomElement(['bjj', 'boxing', 'kickboxing']),
]);
