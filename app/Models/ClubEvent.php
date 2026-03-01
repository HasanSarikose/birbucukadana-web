<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class ClubEvent extends Model
{
    protected $guarded = []; // Tüm alanlar doldurulabilir

    // Başlık girildiğinde otomatik Slug (temiz url) oluşturmak için
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            $event->slug = Str::slug($event->title);
        });
        static::updating(function ($event) {
            $event->slug = Str::slug($event->title);
        });
    }

    // Bu etkinlik bir kulübe aittir
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
