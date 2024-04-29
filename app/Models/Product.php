<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [];
    public function detailProduct()
    {
        return $this->hasOne(DetailProduct::class, 'product_id', 'id');
    }
    public function detailImage()
    {
        return $this->hasMany(DetailImageProduct::class,'product_id', 'id');
    }
    public function brocure()
    {
        return $this->hasOne(productBrocure::class,'product_id', 'id');
    }
    public function priceList()
    {
        return $this->hasOne(productPriceList::class,'product_id', 'id');
    }
}
