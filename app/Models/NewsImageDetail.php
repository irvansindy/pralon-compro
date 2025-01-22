<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImageDetail extends Model
{
    use HasFactory;
    protected $table = "news_image_details";
    protected $fillable = [
        "news_id",
        "file_name",
        "ordering"
    ];
    public function NewsBlog()
    {
        return $this->belongsTo(News::class);
    }
}
