<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubMember extends Model
{
    protected $guarded = []; // Tüm alanlar doldurulabilir

    // Bu üye bir kulübe aittir
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
