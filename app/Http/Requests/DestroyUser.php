<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DestroyUser extends FormRequest
{
    public function authorize()
    {
        return $this->user->id != Auth::user()->id;
    }

    public function rules()
    {
        return [];
    }
}
