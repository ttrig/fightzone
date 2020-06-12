<?php

namespace Tests\Feature\Admin;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(factory(User::class)->create());
    }

    public function test_index()
    {
        $event = factory(Event::class)->create();

        $this->get(route('admin.event.index'))
            ->assertSeeText(__('app.activity.' . $event->activity->slug))
            ->assertOk()
        ;
    }

    public function test_create()
    {
        $this->get(route('admin.event.create'))
            ->assertOk()
            ->assertSeeText('Create')
        ;
    }

    public function test_edit()
    {
        $event = factory(Event::class)->create();

        $this->get(route('admin.event.edit', $event))
            ->assertOk()
            ->assertSeeText('Update')
        ;
    }

    public function test_store_sad_path()
    {
        $this->post(route('admin.event.store', []))
            ->assertSessionHasErrors([
                'activity_id' => 'The activity id field is required.',
                'dow' => 'Day of week is required',
                'from_time' => 'The from time field is required.',
                'to_time' => 'The to time field is required.',
            ])
        ;
        $this->assertEmpty(Event::count());
    }

    public function test_store_happy_path()
    {
        $data = factory(Event::class)->make()->toArray();

        $this->post(route('admin.event.store', $data))
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.event.index'))
        ;

        $this->assertEquals(1, Event::count());
    }

    public function test_update_sad_path()
    {
        $event = factory(Event::class)->create();

        $this->put(route('admin.event.update', $event), [])
            ->assertSessionHasErrors([
                'dow' => 'Day of week is required',
                'from_time' => 'The from time field is required.',
                'to_time' => 'The to time field is required.',
            ])
        ;
    }

    public function test_update_happy_path()
    {
        $event = factory(Event::class)->create();

        $this->put(route('admin.event.update', $event), $event->toArray())
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.event.index'))
        ;
    }

    public function test_disable()
    {
        $event = factory(Event::class)->create();

        $this->put(route('admin.event.disable', $event))
            ->assertRedirect(route('admin.event.index'))
        ;

        $this->assertFalse($event->refresh()->is_enabled);
    }

    public function test_enable()
    {
        $event = factory(Event::class)->state('disabled')->create();

        $this->put(route('admin.event.enable', $event))
            ->assertRedirect(route('admin.event.index'))
        ;

        $this->assertTrue($event->refresh()->is_enabled);
    }

    public function test_destroy()
    {
        $event = factory(Event::class)->create();

        $this->delete(route('admin.event.destroy', $event))
            ->assertRedirect(route('admin.event.index'))
        ;

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}
