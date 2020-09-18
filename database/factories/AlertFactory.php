<?php

namespace Database\Factories;

use App\Models\Alert;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlertFactory extends Factory
{
    protected $model = Alert::class;

    public function definition()
    {
        return [
            'routes' => null,
            'class' => $this->faker->randomElement(Alert::COLORS),
            'from_date' => now()->toDateString(),
            'to_date' => now()->addDays(2)->toDateString(),
            'content_sv' => $this->faker->paragraph,
            'content_en' => $this->faker->paragraph,
        ];
    }

    public function active()
    {
        return $this->state([]);
    }

    public function inactive()
    {
        return $this->state([
            'from_date' => now()->subDays(2)->toDateString(),
            'to_date' => now()->subDays(1)->toDateString(),
        ]);
    }
}
