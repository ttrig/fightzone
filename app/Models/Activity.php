<?php

namespace App\Models;

use App\Traits\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasContent;
    use HasFactory;

    protected $guarded = ['*'];

    public function getNameAttribute()
    {
        return __('app.activity.' . $this->slug);
    }

    public function events()
    {
        return $this->hasMany(Event::class)
            ->orderBy('dow')
            ->orderBy('from_time')
        ;
    }
}
