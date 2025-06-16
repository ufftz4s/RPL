<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->json('options'); // Array pilihan jawaban A, B, C, D
            $table->string('correct_answer'); // A, B, C, atau D
            $table->text('explanation')->nullable(); // Penjelasan jawaban
            $table->integer('points')->default(1); // Poin per soal
            $table->integer('order')->default(0); // Urutan soal
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
};
