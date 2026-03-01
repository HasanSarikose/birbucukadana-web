<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasttoNow extends Model
{
    use HasFactory;
    protected $table = 'pastton';
    protected $fillable = [
        'image',
        'baslik',
        'yazi'
    ];
    protected $guarded = [];
}
