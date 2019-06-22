<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\SanitizesInput;

class CreateUser extends FormRequest
{
    use SanitizesInput;

    public $sanitize = [
        'email',
        'name',
    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'bail|required|email|unique:users',
            'name'     => 'required|min:2',
            'password' => 'required|min:8',
        ];
    }
}
