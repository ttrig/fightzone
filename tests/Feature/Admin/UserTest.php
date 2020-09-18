<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->be($this->user);
    }

    public function test_index()
    {
        $this->get(route('admin.user.index'))
            ->assertOk()
            ->assertSeeTextInOrder([
                'Users',
                $this->user->email,
                e($this->user->name),
            ])
        ;
    }

    public function test_create()
    {
        $this->get(route('admin.user.create'))
            ->assertOk()
            ->assertSeeText('Add user')
        ;
    }

    public function test_edit()
    {
        $this->get(route('admin.user.edit', $this->user))
            ->assertOk()
            ->assertSeeTextInOrder([
                'Edit user',
                'E-mail',
                'Name',
                'Password',
            ])
            ->assertSee($this->user->email)
        ;
    }

    public function test_store_happy_path()
    {
        $data = [
            'email' => 'foo@bar',
            'name' => 'Foo',
            'password' => 'Passw0rd',
        ];

        $this->post(route('admin.user.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.user.index'))
        ;

        $this->assertDatabaseHas('users', [
            'email' => 'foo@bar',
            'name' => 'Foo',
        ]);
    }

    public function test_store_sad_path()
    {
        $this->post(route('admin.user.store'), [])
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
                'name' => 'The name field is required.',
                'password' => 'The password field is required.',
            ])
        ;
    }

    public function test_update_happy_path()
    {
        $data = [
            'email' => 'bar@bar',
            'name' => 'Bar',
            'password' => 'new-password',
        ];

        $this->put(route('admin.user.update', $this->user), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.user.index'))
        ;

        $this->user->refresh();

        $this->assertEquals($this->user->name, 'Bar');
        $this->assertEquals($this->user->email, 'bar@bar');
        $this->assertTrue(\Hash::check('new-password', $this->user->password));
    }

    public function test_update_without_password_dont_save_empty_password()
    {
        $data = [
            'email' => 'foo@bar',
            'name' => 'Foo',
            'password' => '',
        ];

        $this->put(route('admin.user.update', $this->user), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.user.index'))
        ;

        $this->assertDatabaseHas('users', [
            'email' => 'foo@bar',
            'name' => 'Foo',
            'password' => $this->user->password,
        ]);
    }

    public function test_update_sad_path()
    {
        $this->put(route('admin.user.update', $this->user), [])
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
                'name' => 'The name field is required.',
            ])
        ;
    }

    public function test_destroy_happy_path()
    {
        $user = User::factory()->create();

        $this->delete(route('admin.user.destroy', $user))
            ->assertRedirect(route('admin.user.index'))
        ;

        $this->assertTrue($user->refresh()->trashed());
    }

    public function test_destroy_current_user()
    {
        $this->delete(route('admin.user.destroy', $this->user))->assertForbidden();
        $this->assertDatabaseHas('users', ['id' => $this->user->id]);
    }
}
