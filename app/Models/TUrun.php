<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TUrun extends Model
{
    use HasFactory;

    protected $table = 't_urun';

    protected $fillable = [
        'team_id',
        'image',
        'name',
        'feature1',
        'feature2',
        'feature3',
        'feature4',
        'feature5',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
