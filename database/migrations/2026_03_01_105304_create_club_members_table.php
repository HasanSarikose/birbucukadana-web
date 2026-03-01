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
        Schema::create('club_members', function (Blueprint $table) {
            $table->id();
            // Hangi kulübün üyesi olduğunu tutacağız. Kulüp silinirse üyeleri de silinir (cascade).
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');

            $table->string('name'); // Üyenin Adı Soyadı
            $table->string('title'); // Unvanı (Örn: Kulüp Başkanı, Yazılım Ekibi Lideri)
            $table->string('image')->nullable(); // Üyenin Fotoğrafı

            // Üyelere özel opsiyonel sosyal medya linkleri
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_members');
    }
};
