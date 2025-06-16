<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->json('answers'); // Jawaban user dalam format JSON
            $table->integer('score'); // Skor yang didapat
            $table->integer('total_questions'); // Total soal
            $table->integer('correct_answers'); // Jumlah jawaban benar
            $table->boolean('is_passed'); // Apakah lulus
            $table->integer('time_taken_seconds')->nullable(); // Waktu yang digunakan
            $table->timestamp('started_at')->nullable(); // Ubah ke nullable
            $table->timestamp('completed_at')->nullable(); // Ubah ke nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
