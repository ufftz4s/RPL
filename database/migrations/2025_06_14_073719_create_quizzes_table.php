<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['budgeting', 'saving', 'debt_management', 'investment', 'financial_planning']);
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->integer('time_limit_minutes')->nullable(); // Batas waktu dalam menit
            $table->integer('passing_score')->default(70); // Nilai minimum lulus (%)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
