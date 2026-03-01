<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBasarilar extends Model
{
    use HasFactory;

    protected $table = 't_basarilar';

    protected $fillable = [
        'team_id',
        'image',
        'baslik',
        'aciklama',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
