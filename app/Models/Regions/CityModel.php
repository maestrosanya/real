<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    public $table = 'cities';

    protected $fillable = ['name', 'slug', 'parent_id'];

    public function region()
    {
        return $this->belongsTo(RegionModel::class, 'parent_id');
    }
}
