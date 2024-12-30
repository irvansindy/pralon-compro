<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyPralonAboutUs extends Model
{
    use HasFactory;
    protected $table = 'why_pralon_about_us';
    protected $guarded = [];
    public function detail()
    {
        return $this->hasMany(DetailWhyPralonAboutUs::class,'history_about_us_id','id');
    }
}
