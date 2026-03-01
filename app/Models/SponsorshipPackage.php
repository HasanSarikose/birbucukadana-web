<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorshipPackage extends Model
{
    protected $fillable = ['team_id', 'title', 'order'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'package_id');
    }
}
