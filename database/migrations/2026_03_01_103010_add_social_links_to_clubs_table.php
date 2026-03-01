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
        Schema::table('clubs', function (Blueprint $table) {
            $table->string('instagram')->nullable()->after('about');
            $table->string('linkedin')->nullable()->after('instagram');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->string('youtube')->nullable()->after('twitter');
            $table->string('nsosyal')->nullable()->after('youtube');
        });
    }

    public function down(): void
    {
        Schema::table('clubs', function (Blueprint $table) {
            $table->dropColumn(['instagram', 'linkedin', 'twitter', 'youtube', 'nsosyal']);
        });
    }
};
