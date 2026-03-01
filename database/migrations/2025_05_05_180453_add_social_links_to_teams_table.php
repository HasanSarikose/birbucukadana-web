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
        Schema::table('teams', function (Blueprint $table) {
            if (!Schema::hasColumn('teams', 'logo')) {
                $table->string('logo')->nullable()->after('name');
            }
            if (!Schema::hasColumn('teams', 'instagram')) {
                $table->string('instagram')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('teams', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('teams', 'website')) {
                $table->string('website')->nullable()->after('slug');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            if (Schema::hasColumn('teams', 'logo')) {
                $table->dropColumn('logo');
            }
            if (Schema::hasColumn('teams', 'instagram')) {
                $table->dropColumn('instagram');
            }
            if (Schema::hasColumn('teams', 'linkedin')) {
                $table->dropColumn('linkedin');
            }
            if (Schema::hasColumn('teams', 'website')) {
                $table->dropColumn('website');
            }
        });
    }
};
