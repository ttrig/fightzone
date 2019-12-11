<?php

namespace App\Http\Requests;

use App\Traits\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;

class CreateEvent extends FormRequest
{
    use SanitizesInput;

    public $sanitize = [
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
            'dow.required' => 'Day of week is required',
            'content_en.required_if' => 'The english description field is required when not open mat.',
            'content_sv.required_if' => 'The swedish description field is required when not open mat.',
        ];
    }

    public function rules()
    {
        return [
            'activity_id' => 'required|exists:activities,id',
            'dow' => 'required|between:1,7',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i',
            'is_open_mat' => 'boolean',
            'content_en' => 'required_if:is_open_mat,0|max:64',
            'content_sv' => 'required_if:is_open_mat,0|max:64',
        ];
    }
}
