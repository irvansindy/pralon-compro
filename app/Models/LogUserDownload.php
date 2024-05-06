<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUserDownload extends Model
{
    use HasFactory;
    protected $table = 'log_user_downloads';
    protected $fillable = [
        'name',
        'phone_number',
        'email',
    ];
}
