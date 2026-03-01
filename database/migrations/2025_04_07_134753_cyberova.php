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
        Schema::create('t_anasayfa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('anasayfa');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('t_hakkimizda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('baslik');
            $table->string('image');
            $table->string('hakkimizda');
            $table->timestamps();
        });

        Schema::create('t_uyeler', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->year('year');
            $table->string('name');
            $table->string('image');
            $table->string('task');
            $table->string('email');
            $table->string('linkedin');
            $table->timestamps();
        });

        Schema::create('t_sponsor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('image');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('t_basarilar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('image');
            $table->string('baslik');
            $table->string('aciklama');
            $table->timestamps();
        });

        Schema::create('t_araclar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->year('year');
            $table->string('image');
            $table->string('baslik');
            $table->string('aciklama');
            $table->timestamps();
        });

        Schema::create('t_urun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('image');
            $table->string('name');
            $table->string('feature1');
            $table->string('feature2');
            $table->string('feature3');
            $table->string('feature4')->nullable();
            $table->string('feature5')->nullable();
            $table->timestamps();
        });

        Schema::create('t_galeri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('image');
            $table->string('baslik');
            $table->string('aciklama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_galeri');
        Schema::dropIfExists('t_urun');
        Schema::dropIfExists('t_araclar');
        Schema::dropIfExists('t_basarilar');
        Schema::dropIfExists('t_sponsor');
        Schema::dropIfExists('t_uyeler');
        Schema::dropIfExists('t_hakkimizda');
        Schema::dropIfExists('t_anasayfa');
    }
};
