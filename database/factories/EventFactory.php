<?php

use App\Models\Activity;
use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, fn(Faker $faker) => [
    'activity_id' => fn() => factory(Activity::class)->create()->id,
    'dow' => now()->dayOfWeekIso,
    'from_time' => now()->format('H:i'),
    'to_time' => now()->addHour()->format('H:i'),
    'is_enabled' => true,
    'is_open_mat' => false,
    'content_sv' => $faker->sentence(2),
    'content_en' => $faker->sentence(2),
]);

$factory->state(Event::class, 'random', function (Faker $faker) {
    $from_hour = $faker->numberBetween(10, 19);
    return [
        'activity_id' => 1,
        'dow' => $faker->numberBetween(1, 7),
        'from_time' => $from_hour . ':00',
        'to_time' => $from_hour + 1 . ':30',
        'is_open_mat' => !rand(0, 7),
        'content_sv' => $faker->sentence(2),
        'content_en' => $faker->sentence(2),
    ];
});

$factory->state(Event::class, 'open-mat', [
    'is_open_mat' => true,
]);

$factory->state(Event::class, 'disabled', [
    'is_enabled' => false,
]);
