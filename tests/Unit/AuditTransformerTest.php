<?php

namespace Tests\Unit\Traits;

use App\Models\Alert;
use App\Models\Price;
use App\Models\Text;
use App\Models\User;
use App\Transformers\AuditTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditTransformerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list()
    {
        $alert = factory(Alert::class)->create();
        $price = factory(Price::class)->create();
        $text = factory(Text::class)->create();
        $user = factory(User::class)->create();

        $alert->audits()->create([
            'event' => 'created',
            'user_id' => $user->id,
            'user_type' => get_class($user),
        ]);

        $price->audits()->create([
            'event' => 'updated',
            'user_id' => $user->id,
            'user_type' => get_class($user),
        ]);

        $text->audits()->create([
            'event' => 'updated',
            'user_id' => $user->id,
            'user_type' => get_class($user),
        ]);

        $user->audits()->create([
            'event' => 'deleted',
            'user_id' => $user->id,
            'user_type' => get_class($user),
            'old_values' => ['email' => $user->email],
            'new_values' => [],
        ]);

        $audits = $alert->audits
            ->merge($price->audits)
            ->merge($text->audits)
            ->merge($user->audits);

        [
            $createdAlert,
            $updatedPrice,
            $updatedText,
            $deletedUser,
        ] = (new AuditTransformer())->list($audits);

        $this->assertEquals('alert', $createdAlert['name']);
        $this->assertEquals('fa fa-plus', $createdAlert['icon']);
        $this->assertEquals('http://localhost/admin/alert/1/edit', $createdAlert['route']);

        $this->assertEquals('prices', $updatedPrice['name']);
        $this->assertEquals('fa fa-pencil-alt', $updatedPrice['icon']);
        $this->assertEquals('http://localhost/admin/price', $updatedPrice['route']);

        $this->assertEquals('text', $updatedText['name']);
        $this->assertEquals('fa fa-pencil-alt', $updatedText['icon']);
        $this->assertEquals('http://localhost/admin/text/1/edit', $updatedText['route']);

        $this->assertEquals('user', $deletedUser['name']);
        $this->assertEquals('fa fa-trash', $deletedUser['icon']);
        $this->assertNull($deletedUser['route']);
        $this->assertEquals($user->email, $deletedUser['context']);
    }
}
