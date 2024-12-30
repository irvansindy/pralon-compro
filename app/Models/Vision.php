<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    use HasFactory;
    protected $table = 'visions';
    protected $guarded = [];
    public function mision()
    {
        return $this->hasMany(Mision::class,'vision_id','id');
    }
}
