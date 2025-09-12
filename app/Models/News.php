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
    public function order()
    {
        return $this->hasOne(ProjectHomePage::class);
    }
    public function translations()
    {
        return $this->hasMany(NewsTranslations::class);
    }
    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations->where('locale', $locale)->first();
    }
}
