<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basvuru extends Model
{
    protected $table = 't_basvurular';
    protected $guarded = []; // Tüm sütunlar doldurulabilir
}
