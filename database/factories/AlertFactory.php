<?php

use App\Models\Alert;
use Faker\Generator as Faker;

$factory->define(Alert::class, function (Faker $faker) {
    return [
        'routes'     => null,
        'class'      => $faker->randomElement(Alert::COLORS),
        'from_date'  => now()->toDateString(),
        'to_date'    => now()->addDays(2)->toDateString(),
        'content_sv' => $faker->paragraph,
        'content_en' => $faker->paragraph,
    ];
});

$factory->state(Alert::class, 'active', []);
$factory->state(Alert::class, 'inactive', [
    'from_date' => now()->subDays(2)->toDateString(),
    'to_date'   => now()->subDays(1)->toDateString(),
]);
