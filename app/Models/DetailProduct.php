<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [];
    public function feature()
    {
        return $this->hasMany(ProductDetailFeature::class, 'product_detail_id', 'id');
        // return $this->hasMany(ProductDetailFeature::class, 'id');
        // return $this->hasMany(ProductDetailFeature::class, 'id', 'product_detail_id');
    }
}
