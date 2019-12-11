<?php

namespace App\Http\Requests;

class UpdateEvent extends CreateEvent
{
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['activity_id']);

        return $rules;
    }
}
