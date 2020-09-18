<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->randomElement([
                'bjj',
                'boxing',
                'kickboxing',
                'wrestling',
                'nogi',
                'sac',
                'gym',
                'kids-bjj',
            ]),
        ];
    }

    public function hasPrice()
    {
        return $this->state([
            'slug' => $this->faker->randomElement(['bjj', 'boxing', 'kickboxing']),
        ]);
    }
}
