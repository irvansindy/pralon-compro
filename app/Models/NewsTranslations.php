<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslations extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_id',
        'locale',
        'title',
        'short_desc',
        'header_content',
        'content',
    ];
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
