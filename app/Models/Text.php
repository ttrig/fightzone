<?php

namespace App\Models;

use App\Traits\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Text extends AuditableModel
{
    use HasContent;
    use HasFactory;

    protected $guarded = [];
}
