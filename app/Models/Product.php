<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CustomSoftDeletes;

class Product extends Model
{
    use HasFactory;

    use CustomSoftDeletes;

    protected $table = 'product';

    public $timestamps = false;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_product');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'product_image');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($query) {
            $query->images()->delete();
        });
    }
}
