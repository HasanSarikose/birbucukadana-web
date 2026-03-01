<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('club_events', function (Blueprint $table) {
            $table->id();

            // Etkinlik hangi kulübe ait? (Kulüp silinirse etkinlikleri de silinir)
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');

            $table->string('title'); // Etkinlik Başlığı
            $table->string('slug')->unique(); // SEO dostu temiz URL için (örn: yapay-zeka-zirvesi)
            $table->longText('content')->nullable(); // CKEditor ile eklenecek uzun açıklama
            $table->string('image')->nullable(); // Etkinlik Afişi / Kapak Fotoğrafı
            $table->date('event_date')->nullable(); // Etkinliğin yapılacağı tarih

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_events');
    }
};
