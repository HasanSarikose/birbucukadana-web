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
        Schema::table('users', function (Blueprint $table) {
            // Kullanıcının hangi kulübün admini olduğunu tutacağız
            // role sütunu zaten vardı (super_admin, team_admin). Artık 'club_admin' de olabilecek.
            $table->unsignedBigInteger('club_id')->nullable()->after('team_id');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
