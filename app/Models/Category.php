<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CustomSoftDeletes;

class Category extends Model
{
    use HasFactory;

    use CustomSoftDeletes;

    protected $table = 'category';

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'category_product');
    }
}
