<?php

use Faker\Generator as Faker;
use App\Models\Instructor;

$factory->define(Instructor::class, fn(Faker $faker) => [
    'activity_id' => 1,
    'name' => $faker->name,
    'image' => $faker->imageUrl(500, 700, 'cats'),
    'black_belt' => 0,
    'content_sv' => $faker->jobTitle,
    'content_en' => $faker->jobTitle,
]);
