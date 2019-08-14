<?php

namespace App\Http\Requests;

use App\Models\PaymentArticle;
use App\Traits\PurifiesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePaymentArticle extends FormRequest
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
            'name_en.required' => 'English name is required.',
            'name_sv.required' => 'Swedish name is required.',
            'content_en.required' => 'English description is required.',
            'content_sv.required' => 'Swedish description is required.',
        ];
    }

    public function rules()
    {
        return [
            'name_en' => 'required|max:128',
            'name_sv' => 'required|max:128',
            'content_en' => 'required|max:2048',
            'content_sv' => 'required|max:2048',
            'active' => 'required|boolean',
            'price' => 'required|numeric|between:1,9999',
            'number' => [
                'bail',
                'required',
                'numeric',
                'min:1000',
                $this->uniqueNumberRule(),
            ],
        ];
    }

    protected function uniqueNumberRule()
    {
        $tableName = (new PaymentArticle())->getTable();
        return Rule::unique($tableName, 'number');
    }
}
