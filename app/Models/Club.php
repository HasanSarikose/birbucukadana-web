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

    public function members()
    {
        return $this->hasMany(ClubMember::class, 'club_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(ClubEvent::class, 'club_id', 'id')->orderBy('event_date', 'desc');
    }

    public function galleries()
    {
        // En son eklenen fotoğraf en üstte çıksın diye orderBy ekledik
        return $this->hasMany(ClubGallery::class, 'club_id', 'id')->orderBy('created_at', 'desc');
    }
}
