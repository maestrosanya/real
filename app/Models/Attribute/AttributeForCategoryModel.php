<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;

class AttributeForCategoryModel extends Model
{
    protected $table = 'attributes';

    public $timestamps = false;

    const ATTRIBUTE_TYPE_STRING = 'string';
    const ATTRIBUTE_TYPE_INTEGER = 'integer';
    const ATTRIBUTE_TYPE_FLOAT = 'float';
    const ATTRIBUTE_TYPE_SELECT = 'select';

    protected $fillable = [
        'name', 'type', 'required', 'variants', 'sort'
    ];

    static public function getTypes()
    {
        return [
            self::ATTRIBUTE_TYPE_STRING => self::ATTRIBUTE_TYPE_STRING,
            self::ATTRIBUTE_TYPE_INTEGER => self::ATTRIBUTE_TYPE_INTEGER,
            self::ATTRIBUTE_TYPE_FLOAT => self::ATTRIBUTE_TYPE_FLOAT,
            self::ATTRIBUTE_TYPE_SELECT => self::ATTRIBUTE_TYPE_SELECT,
        ];
    }

    public function isString()
    {
        return $this->type == self::ATTRIBUTE_TYPE_STRING ? true : false;
    }

    public function isInteger()
    {
        return $this->type == self::ATTRIBUTE_TYPE_INTEGER ? true : false;
    }

    public function isFloat()
    {
        return $this->type == self::ATTRIBUTE_TYPE_FLOAT ? true : false;
    }

    public function isSelect()
    {
        return $this->type == self::ATTRIBUTE_TYPE_SELECT ? true : false;
    }

}
