<?php

namespace Database\Factories;

use App\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

class TextFactory extends Factory
{
    protected $model = Text::class;

    public function definition()
    {
        return [
            'route' => $this->faker->word,
            'name' => $this->faker->word,
            'content_sv' => $this->faker->sentence,
            'content_en' => $this->faker->sentence,
        ];
    }

    public function empty()
    {
        return $this->state([
            'content_sv' => '',
            'content_en' => '',
        ]);
    }

    public function short()
    {
        return $this->state([
            'content_sv' => $this->faker->paragraph(5),
            'content_en' => $this->faker->paragraph(5),
        ]);
    }

    public function long()
    {
        return $this->state([
            'content_sv' => $this->faker->paragraph(12),
            'content_en' => $this->faker->paragraph(12),
        ]);
    }

    public function extraLong()
    {
        return $this->state([
            'content_sv' => '<p>' . $this->faker->paragraph(23) . '</p><p>' . $this->faker->paragraph(23) . '</p>',
            'content_en' => '<p>' . $this->faker->paragraph(23) . '</p><p>' . $this->faker->paragraph(23) . '</p>',
        ]);
    }

    public function table()
    {
        $html = <<<EOD
            <table class="table">
                <thead class="thead-light"><tr><th>Foo</th><th>Bar</th></tr></thead>
                <tbody><tr><td>Foz</td><td>Baz</td></tr></tbody>
            </table>
            EOD;

        return $this->state([
            'content_sv' => $html,
            'content_en' => $html,
        ]);
    }
}
