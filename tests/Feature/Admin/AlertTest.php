<?php

namespace Tests\Feature\Admin;

use App\Models\Alert;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlertTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(factory(User::class)->create());
    }

    public function test_index()
    {
        $this->get(route('admin.alert.index'))->assertOk();
    }

    public function test_create()
    {
        $this->get(route('admin.alert.create'))
            ->assertOk()
            ->assertSeeText('Create')
        ;
    }

    public function test_edit()
    {
        $alert = factory(Alert::class)->create();

        $this->get(route('admin.alert.edit', $alert))
            ->assertOk()
            ->assertSeeText($alert->content)
            ->assertSeeText('Update')
        ;
    }

    public function test_store_sad_path()
    {
        $this->post(route('admin.alert.store', []))
            ->assertSessionHasErrors([
                'class' => 'The class field is required.',
                'from_date' => 'The from date field is required.',
                'to_date' => 'The to date field is required.',
                'content_en' => 'English content is required.',
                'content_sv' => 'Swedish content is required.',
            ])
        ;

        $this->assertEmpty(Alert::count());
    }

    public function test_store_happy_path()
    {
        $data = factory(Alert::class)->make()->toArray();
        $data['from_date'] = now()->toDateString();
        $data['to_date'] = now()->addHour()->toDateString();
        $data['routes'] = [Alert::AVAILABLE_ROUTES[0]];

        $this->post(route('admin.alert.store', $data))
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.alert.index'))
        ;

        $this->assertDatabaseHas('alerts', [
            'class' => $data['class'],
            'content_en' => $data['content_en'],
            'content_sv' => $data['content_sv'],
            'routes' => json_encode($data['routes']),
        ]);
    }

    public function test_update_sad_path()
    {
        $alert = factory(Alert::class)->create();

        $this->put(route('admin.alert.update', $alert), [])
            ->assertSessionHasErrors([
                'class' => 'The class field is required.',
                'from_date' => 'The from date field is required.',
                'to_date' => 'The to date field is required.',
                'content_en' => 'English content is required.',
                'content_sv' => 'Swedish content is required.',
            ])
        ;
    }

    public function test_update_happy_path()
    {
        $alert = factory(Alert::class)->create([
            'routes' => [Alert::AVAILABLE_ROUTES[0]]
        ]);

        $data = $alert->toArray();
        $data['from_date'] = now()->toDateString();
        $data['to_date'] = now()->addHour()->toDateString();
        $data['routes'] = '';

        $this->put(route('admin.alert.update', $alert), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.alert.index'))
        ;

        $alert->refresh();

        $this->assertEquals($data['from_date'], $alert->from_date->toDateString());
        $this->assertEquals($data['to_date'], $alert->to_date->toDateString());
        $this->assertNull($alert->routes);
    }

    public function test_destroy()
    {
        $alert = factory(Alert::class)->create();

        $this->delete(route('admin.alert.destroy', $alert))
            ->assertRedirect(route('admin.alert.index'))
        ;

        $this->assertDatabaseMissing('alerts', ['id' => $alert->id]);
    }
}
