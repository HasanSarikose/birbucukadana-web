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
        Schema::create('t_basvurular', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id'); // Hangi takıma başvurdu?
            $table->string('ad_soyad')->nullable(False);
            $table->string('email')->nullable(False);
            $table->string('task')->nullable(False);
            $table->string('linkedin')->nullable(False);
            $table->string('year')->nullable(False);
            $table->string('foto')->nullable(); // İstersen CV yükletirsin
            $table->boolean('onaylandi_mi')->default(0); // 0: Bekliyor, 1: Onaylandı
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_basvurular');
    }
};
