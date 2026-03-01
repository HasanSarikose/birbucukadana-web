<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cyberova extends Model
{
    use HasFactory;
    protected $table = 'cyberova';
    protected $fillable = [
        'baslik',
        'aciklama',
        'image'
    ];
    protected $guarded = [];
}
