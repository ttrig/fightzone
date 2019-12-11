<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateUser extends CreateUser
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = parent::rules();

        # password can be nullable when updating
        $rules['password'] = 'nullable|min:8';

        # ignore "unique" rule when updating email
        $rules['email'] = [
            'required',
            'email',
            Rule::unique('users')->ignore($this->user->id),
        ];

        return $rules;
    }
}
