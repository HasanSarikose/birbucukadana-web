<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $guarded = []; // Tüm alanlar doldurulabilir

    // Bir kulübün bir admini/kullanıcısı olur (veya birden fazla)
    public function users()
    {
        return $this->hasMany(User::class, 'club_id', 'id');
    }
}
