<?php

namespace App\Models\Rerions;

use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    protected $table = 'regions';

    /*protected $fillable = [
        'name', 'slug', 'parent_id'
    ];*/

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
