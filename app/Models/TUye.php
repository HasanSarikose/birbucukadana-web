<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TUye extends Model
{
    use HasFactory;

    protected $table = 't_uyeler';

    protected $fillable = ['team_id', 'year', 'name', 'image', 'task', 'email', 'linkedin'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
