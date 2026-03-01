<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubGallery extends Model
{
    protected $guarded = [];

    // Bu fotoğraf bir kulübe aittir
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
