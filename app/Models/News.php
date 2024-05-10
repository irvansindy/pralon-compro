<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_category_id',
        'title',
        'image',
        'short_desc',
        'content',
        'date',
    ];
    public function category()
    {
        return $this->hasOne(NewsCategory::class, 'id','news_category_id');
    }

    public function imageDetail()
    {
        return $this->hasMany(NewsImageDetail::class,'news_id', 'id');
    }
}
