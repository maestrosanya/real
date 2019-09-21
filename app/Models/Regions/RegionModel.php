<?php

namespace App\Models\Regions;

use App\Models\Advert\Advert;
use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function getAllParentsId()
    {
        if ($region = $this->parent ){

            $parentArrayId = [];

            $parentArrayId[] = $this->id;

            while ($region) {

                $parentArrayId[] = $region->id;

                $region = $region->parent;
            }
            return $parentArrayId;

        } else {
            return [];
        }

    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public static function getCountry()
    {
        return self::where('parent_id', null)->get();
    }
}
