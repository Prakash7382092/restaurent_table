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
            // ✅ ADD column here
            $table->boolean('is_admin')->default(0)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ✅ REMOVE column here
            $table->dropColumn('is_admin');
        });
    }

};
