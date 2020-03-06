<?php

use Faker\Generator as Faker;
use App\Models\User;

$factory->define(User::class, fn(Faker $faker) => [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $faker->password,
    'remember_token' => null,
]);

$factory->state(User::class, 'admin', [
    'name' => 'admin',
    'email' => 'admin@fightzone.se',
    'password' => 'admin',
]);
