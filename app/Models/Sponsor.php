<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = ['package_id', 'name', 'logo_path'];

    public function package()
    {
        return $this->belongsTo(SponsorshipPackage::class, 'package_id');
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
