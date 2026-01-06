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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->foreignId('restaurent_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('item_name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // e.g., veg/non-veg, appetizer, main course
            $table->decimal('price', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
