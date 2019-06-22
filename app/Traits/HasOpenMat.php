<?php

namespace App\Traits;

trait HasOpenMat
{
    protected static function bootHasOpenMat()
    {
        static::saving(function ($model) {
            # null content when "open mat"
            if ($model->is_open_mat) {
                $model->content_en = null;
                $model->content_sv = null;
            }
        });
    }
}
