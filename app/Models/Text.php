<?php

namespace App\Models;

use App\Traits\HasContent;

class Text extends AuditableModel
{
    use HasContent;

    protected $guarded = [];
}
