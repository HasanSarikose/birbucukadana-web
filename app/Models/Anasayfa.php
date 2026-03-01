<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anasayfa extends Model
{
    use HasFactory;
    protected $table = 'anasayfa';
    protected $fillable = [
        'anasayfa',
        'image'
    ];
    protected $guarded = [];
}
