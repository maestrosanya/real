<?php

namespace App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class AdvertAttributeValue extends Model
{

    public $table = 'advert_attr_value';

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }
}
