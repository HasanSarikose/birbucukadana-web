<?php

namespace App\Models;

use App\Models\SponsorshipPackage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'logo',
        'website',
        'linkedin',
        'instagram'// Takım adı gibi özellikler ekleyebilirsiniz.
    ];

    /**
     * Bir takımın sahip olduğu kullanıcıları al.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            $baseSlug = Str::slug($team->name);
            $slug = $baseSlug;
            $counter = 1;

            while (Team::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $team->slug = $slug;
        });

        static::updating(function ($team) {
            $baseSlug = Str::slug($team->name);
            $slug = $baseSlug;
            $counter = 1;

            while (
            Team::where('slug', $slug)
                ->where('id', '!=', $team->id)
                ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $team->slug = $slug;
        });
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sponsorshipPackages()
    {
        return $this->hasMany(SponsorshipPackage::class);
    }
}
