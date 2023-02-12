<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CustomSoftDeletes;

class Image extends Model
{
    use HasFactory;

    use CustomSoftDeletes;

    protected $table = 'image';

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_image');
    }
}
