<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware(['guest', 'throttle:12,1'])->except('logout');
    }

    public function redirectTo()
    {
        return route('admin.index');
    }
}
