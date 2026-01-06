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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('restaurent_id');
            $table->tinyInteger('rating'); // 1 to 5
            $table->text('comments')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->timestamps();           
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurent_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
