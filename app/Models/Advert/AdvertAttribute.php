<?php

namespace App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class AdvertAttribute extends Model
{
    public $table = 'advert_attr_value';

    public $timestamps = false;

    protected $fillable = ['advert_id', 'attribute_id', 'value'];
}
