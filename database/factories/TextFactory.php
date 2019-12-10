<?php

use App\Models\Text;
use Faker\Generator as Faker;

$factory->define(Text::class, function (Faker $faker) {
    return [
        'route'      => $faker->word,
        'name'       => $faker->word,
        'content_sv' => $faker->sentence,
        'content_en' => $faker->sentence,
    ];
});

$factory->state(Text::class, 'empty', function (Faker $faker) {
    return [
        'content_sv' => '',
        'content_en' => '',
    ];
});

$factory->state(Text::class, 'short', function (Faker $faker) {
    return [
        'content_sv' => $faker->paragraph(5),
        'content_en' => $faker->paragraph(5),
    ];
});

$factory->state(Text::class, 'long', function (Faker $faker) {
    return [
        'content_sv' => $faker->paragraph(12),
        'content_en' => $faker->paragraph(12),
    ];
});

$factory->state(Text::class, 'extra-long', function (Faker $faker) {
    return [
        'content_sv' => '<p>' . $faker->paragraph(23) . '</p><p>' . $faker->paragraph(23) . '</p>',
        'content_en' => '<p>' . $faker->paragraph(23) . '</p><p>' . $faker->paragraph(23) . '</p>',
    ];
});

$factory->state(Text::class, 'table', function (Faker $faker) {
    $html = '<table class="table">'
          . '<thead class="thead-light"><tr><th>Foo</th><th>Bar</th></tr></thead>'
          . '<tbody><tr><td>Foz</td><td>Baz</td></tr></tbody>'
          . '</table>';

    return [
        'content_sv' => $html,
        'content_en' => $html,
    ];
});
