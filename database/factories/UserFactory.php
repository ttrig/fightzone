<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'remember_token' => null,
        ];
    }

    public function admin()
    {
        return $this->state([
            'name' => 'admin',
            'email' => 'admin@fightzone.se',
            'password' => 'admin',
        ]);
    }
}
