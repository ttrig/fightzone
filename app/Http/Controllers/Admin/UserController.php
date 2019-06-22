<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUser;
use App\Http\Requests\DestroyUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;

class UserController extends AdminController
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return $this->form(new User());
    }

    public function edit(User $user)
    {
        return $this->form($user);
    }

    protected function form(User $user)
    {
        return view('admin.user.form', [
            'user' => $user,
        ]);
    }

    public function store(CreateUser $request)
    {
        User::create($request->all());

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User created!')
        ;
    }

    public function update(UpdateUser $request, User $user)
    {
        if (!$request->input('password', null)) {
            $user->update($request->except('password'));
        } else {
            $user->update($request->all());
        }

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User updated!')
        ;
    }

    public function destroy(DestroyUser $request, User $user)
    {
        $user->delete();
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User deleted!')
        ;
    }
}
