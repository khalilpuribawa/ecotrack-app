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
    Schema::create('green_points', function (Blueprint $table) {
        $table->id();
        $table->foreignId('added_by')->constrained('users')->onDelete('cascade');
        $table->string('name');
        $table->text('description');
        $table->string('type'); // Kolom 'type' dari error sebelumnya
        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);
        $table->string('status')->default('pending'); 
        $table->boolean('verified')->default(false);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('green_points');
    }
};