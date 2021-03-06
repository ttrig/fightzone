<?php

namespace App\Http\Requests;

use App\Traits\PurifiesInput;
use Illuminate\Foundation\Http\FormRequest;

class UpdateText extends FormRequest
{
    use PurifiesInput;

    private $purify = [
        'content_en',
        'content_sv',
    ];

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'content_en.required' => 'English content is required.',
            'content_sv.required' => 'Swedish content is required.',
        ];
    }

    public function rules()
    {
        return [
            'content_en' => 'required',
            'content_sv' => 'required',
        ];
    }
}
