<?php

namespace App\Models\Category;

use App\Models\Attribute\AttributeForCategoryModel;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class CategoryModel extends Model
{
    use NodeTrait;

    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function attributes()
    {
        return$this->hasMany(AttributeForCategoryModel::class, 'category_id', 'id');
    }
}
