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
            $table->string('zone', 10)->nullable();
        });
        DB::statement("ALTER TABLE employees ADD CONSTRAINT zone_check CHECK (zone IN ('east', 'west', 'north', 'south'))");
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('zone');
        });
    }
};
