<?php

namespace Tests\Feature\Admin;

use App\Models\PaymentArticle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentArticleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(factory(User::class)->create());
    }

    public function test_index()
    {
        $article = factory(PaymentArticle::class)->create();

        $this->get(route('admin.payment_article.index'))
            ->assertOk()
            ->assertSeeText($article->name)
            ->assertSeeText($article->price)
            ->assertSee(route('admin.payment_article.edit', $article->id))
        ;
    }

    public function test_create()
    {
        $this->get(route('admin.payment_article.create'))
            ->assertOk()
            ->assertSeeText('Create')
        ;
    }

    public function test_edit()
    {
        $article = factory(PaymentArticle::class)->create();

        $this->get(route('admin.payment_article.edit', $article->id))
            ->assertOk()
            ->assertSee($article->name)
            ->assertSeeText($article->content)
            ->assertSeeText('Update')
        ;
    }

    public function test_store_sad_path()
    {
        $this->post(route('admin.payment_article.store', []))
            ->assertSessionHasErrors([
                'number' => 'The number field is required.',
                'price' => 'The price field is required.',
                'active' => 'The active field is required.',
                'name_en' => 'English name is required.',
                'name_sv' => 'Swedish name is required.',
                'content_en' => 'English description is required.',
                'content_sv' => 'Swedish description is required.',
            ])
        ;

        $this->assertEmpty(PaymentArticle::count());
    }

    public function test_store_happy_path()
    {
        $data = factory(PaymentArticle::class)->make()->toArray();

        $this->post(route('admin.payment_article.store', $data))
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.payment_article.index'))
        ;

        $this->assertDatabaseHas('payment_articles', $data);
    }

    public function test_update_happy_path()
    {
        $article = factory(PaymentArticle::class)->create();

        $data = $article->toArray();
        $data['active'] = false;

        $this->put(route('admin.payment_article.update', $article->id), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.payment_article.index'))
        ;

        $this->assertFalse($article->fresh()->active);

        $this->assertFalse(cache()->has('billmate-payment-plans-for-article-' . $article->id));
    }

    public function test_update_sad_path()
    {
        $article = factory(PaymentArticle::class)->create();

        $this->put(route('admin.payment_article.update', $article->id), [])
            ->assertSessionHasErrors([
                'number' => 'The number field is required.',
                'price' => 'The price field is required.',
                'active' => 'The active field is required.',
                'name_en' => 'English name is required.',
                'name_sv' => 'Swedish name is required.',
                'content_en' => 'English description is required.',
                'content_sv' => 'Swedish description is required.',
            ])
        ;
    }

    public function test_update_trashed_article()
    {
        $article = factory(PaymentArticle::class)->create();

        $article->delete();

        $this->put(route('admin.payment_article.update', $article->id), [])
            ->assertNotFound()
        ;
    }

    public function test_destroy()
    {
        $article = factory(PaymentArticle::class)->create();

        $this->delete(route('admin.payment_article.destroy', $article->id))
            ->assertRedirect(route('admin.payment_article.index'))
        ;

        $this->assertTrue($article->fresh()->trashed());
    }
}
