<?php

namespace Tests\Feature\Admin;

use App\Models\Price;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->be(factory(User::class)->create());
    }

    public function test_index()
    {
        $price = factory(Price::class)->create();

        $this->get(route('admin.price.index'))
            ->assertOk()
            ->assertSeeText('Prices')
            ->assertSeeText($price->activity->name)
        ;
    }

    public function test_update_happy_path()
    {
        $model1 = factory(Price::class)->create(['adult_1_y' => 100]);
        $model2 = factory(Price::class)->create(['adult_1_y' => 300]);

        $data = [
            $model1->activity_id => [
                'adult_1_y' => 200,
            ],
            $model2->activity_id => 'not array',
        ];

        $this->post(route('admin.price.update'), $data)
            ->assertRedirect(route('admin.price.index'))
            ->assertSessionHas('success')
        ;

        $model1->refresh();
        $model2->refresh();

        $this->assertEquals($model1->adult_1_y, 200);
        $this->assertEquals($model2->adult_1_y, 300);
    }

    public function test_update_missing_price_model()
    {
        $model = factory(Price::class)->make();
        $data = [$model->activity_id => [$model->toArray()]];

        $this->post(route('admin.price.update'), $data)->assertNotFound();

        $this->assertEmpty(Price::count());
    }
}
