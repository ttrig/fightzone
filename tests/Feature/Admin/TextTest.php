<?php

namespace Tests\Feature\Admin;

use App\Models\Text;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TextTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->be(factory(User::class)->create());
    }

    public function test_index()
    {
        $text = factory(Text::class)->create();

        $this->get(route('admin.text.index'))
            ->assertOk()
            ->assertSeeTextInOrder([
                'Texts',
                $text->route,
                $text->name,
            ])
        ;
    }

    public function test_edit()
    {
        $text = factory(Text::class)->create();

        $this->get(route('admin.text.edit', $text))
            ->assertOk()
            ->assertSeeText('Edit text')
            ->assertSeeText($text->route)
            ->assertSeeText($text->name)
        ;
    }

    public function test_update()
    {
        $text = factory(Text::class)->create();

        $text->content_sv = 'ny text';
        $text->content_en = 'new text';

        $this->put(route('admin.text.update', $text), $text->toArray())
            ->assertRedirect(route('admin.text.index'))
        ;

        $text->refresh();

        $this->assertEquals('ny text', $text->content_sv);
        $this->assertEquals('new text', $text->content_en);
    }

    public function test_update_missing_text()
    {
        $this->put(route('admin.text.update', 1))->assertNotFound();
    }
}
