<?php

namespace App\Http\Requests;

use App\Models\Alert;
use App\Traits\PurifiesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAlert extends FormRequest
{
    use PurifiesInput;

    public $purify = [
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
            'class' => ['required', Rule::in(Alert::COLORS)],
            'from_date' => 'required|date_format:Y-m-d|before_or_equal:to_date',
            'to_date' => 'required|date_format:Y-m-d|after_or_equal:from_date',
            'content_en' => 'required|max:4096',
            'content_sv' => 'required|max:4096',
            'routes' => 'nullable|array',
            'routes.*' => Rule::in(Alert::AVAILABLE_ROUTES),
        ];
    }
}
