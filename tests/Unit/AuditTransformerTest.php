<?php

namespace Tests\Unit\Traits;

use App\Models\Text;
use App\Models\User;
use App\Transformers\AuditTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditTransformerTest extends TestCase
{
    use RefreshDatabase;

    public function test_happy_path()
    {
        $user = factory(User::class)->create();
        $text = factory(Text::class)->create();

        $text->audits()->create([
            'event' => 'created',
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

        $audits = $text->audits->merge($user->audits);
        $result = (new AuditTransformer())->list($audits);
        $result = collect($result)->toArray();

        $this->assertEquals($result[0]['name'], 'text');
        $this->assertEquals($result[0]['icon'], 'fa fa-plus');

        $this->assertEquals($result[1]['icon'], 'fa fa-pencil-alt');
        $this->assertEquals($result[1]['route'], 'http://localhost/admin/text/1/edit');

        $this->assertEquals($result[2]['name'], 'user');
        $this->assertEquals($result[2]['icon'], 'fa fa-trash');
        $this->assertEquals($result[2]['context'], $user->email);
    }
}
