<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // File migration Anda

public function up(): void
{
    Schema::create('challenge_participants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('challenge_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // REKOMENDASI: Tambahkan status 'rejected'
        $table->enum('status', ['joined', 'submitted', 'completed', 'rejected'])->default('joined');
        
        // Nama kolom Anda sudah bagus
        $table->string('submitted_proof')->nullable(); // Path ke file foto
        
        // REKOMENDASI: Kolom detail tambahan
        $table->text('admin_feedback')->nullable(); // Feedback dari admin jika ditolak
        $table->timestamp('submitted_at')->nullable(); // Waktu pasti saat submit

        $table->timestamps(); // created_at dan updated_at
        
        // Ini sudah sangat bagus!
        $table->unique(['challenge_id', 'user_id']);
    });
}
    public function down(): void
    {
        Schema::dropIfExists('challenge_participants');
    }
};