<?php


namespace App\Models\Advert;


use App\Models\Regions\RegionModel;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public $table = "adverts";

    const STATUS_DRAFT = 'draft';
    const STATUS_MODERATION = 'moderation';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CLOSED = 'closed';

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];


    public function isDraft()
    {
        return $this->status == self::STATUS_DRAFT ? true : false;
    }

    public function isModeration()
    {
        return $this->status == self::STATUS_MODERATION ? true : false;
    }

    public function isPublished()
    {
        return $this->status == self::STATUS_PUBLISHED ? true : false;
    }

    public function isRejected()
    {
        return $this->status == self::STATUS_REJECTED ? true : false;
    }

    public function isClosed()
    {
        return $this->status == self::STATUS_CLOSED ? true : false;
    }

    public function region()
    {
        return $this->belongsTo(RegionModel::class);
    }

    public function attributes()
    {
        return $this->hasMany(AdvertAttributeValue::class);
    }


}
