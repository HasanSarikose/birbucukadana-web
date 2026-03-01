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
        Schema::create('club_galleries', function (Blueprint $table) {
            $table->id();

            // Hangi kulübün galerisi? (Kulüp silinirse fotoğrafları da silinir)
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');

            $table->string('image'); // Fotoğrafın dosya yolu
            $table->string('caption')->nullable(); // Fotoğrafın altına eklenecek kısa açıklama (opsiyonel)

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_galleries');
    }
};
