<?php

namespace App\Http\Requests;

class UpdatePaymentArticle extends CreatePaymentArticle
{
    protected function uniqueNumberRule()
    {
        return parent::uniqueNumberRule()->ignore($this->id);
    }
}
