<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetailFeature extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [];
    public function detailFeature()
    {
        // return $this->hasMany(DetailProduct::class, "product_detail_id", "id");
        return $this->belongsTo(DetailProduct::class, 'product_detail_id', 'id');
    }
}
