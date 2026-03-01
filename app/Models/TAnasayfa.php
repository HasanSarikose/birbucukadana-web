<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAnasayfa extends Model
{
    use HasFactory;

    protected $table = 't_anasayfa'; // Tablonun doğru ismiyle eşleştirdik

    protected $fillable = [
        'team_id',
        'anasayfa',
        'image',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
