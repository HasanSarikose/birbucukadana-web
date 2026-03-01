<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSponsor extends Model
{
    use HasFactory;

    protected $table = 't_sponsor';

    protected $fillable = ['team_id', 'image', 'name'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
