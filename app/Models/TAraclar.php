<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAraclar extends Model
{
    use HasFactory;

    protected $table = 't_araclar';

    protected $fillable = [
        'team_id',
        'year',
        'image',
        'baslik',
        'aciklama',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
