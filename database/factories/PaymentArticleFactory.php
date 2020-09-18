<?php

namespace Database\Factories;

use App\Models\PaymentArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentArticleFactory extends Factory
{
    protected $model = PaymentArticle::class;

    public function definition()
    {
        return [
            'name_sv' => $this->faker->sentence(3),
            'name_en' => $this->faker->sentence(3),
            'content_sv' => $this->faker->paragraph(2),
            'content_en' => $this->faker->paragraph(2),
            'number' => $this->faker->unique->numberBetween(1000, 9000),
            'price' => $this->faker->randomNumber(4),
            'active' => true,
        ];
    }

    public function inactive()
    {
        return $this->state([
            'active' => false,
        ]);
    }
}
