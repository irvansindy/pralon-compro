<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->hasOne(NewsCategory::class, 'id','news_category_id');
    }

    public function NewsImageDetail()
    {
        return $this->hasMany(NewsImageDetail::class);
    }
}
