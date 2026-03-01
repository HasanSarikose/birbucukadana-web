<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class THakkimizda extends Model
{
    use HasFactory;

    protected $table = 't_hakkimizda';

    protected $fillable = ['team_id', 'baslik', 'image', 'hakkimizda'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
