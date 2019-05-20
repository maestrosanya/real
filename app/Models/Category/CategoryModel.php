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
        return $this->hasMany(AttributeForCategoryModel::class, 'category_id', 'id');
    }

    protected function parentsId()
    {
        if($this->parent) {

            $arrayAttr = $this->parent->parentsId() . ',' . $this->id;

            return $arrayAttr;
        } else {
            return $arrayAttr = $this->id;
        }
    }

    public function parentAttributes()
    {
        $parentsId = $this->parentsId();
        $array_parentsId = array_slice(explode(',', $parentsId), 0, -1);

        return AttributeForCategoryModel::whereIn('category_id', $array_parentsId)->orderBy('sort')->getModels();
    }

    public function allAttributes()
    {
        $allAttribute = array_merge($this->attributes()->getModels(), $this->parentAttributes());

        uasort($allAttribute, function ($a, $b){
            return ($a['sort'] > $b['sort']);
        });

        return $allAttribute;
    }
}
