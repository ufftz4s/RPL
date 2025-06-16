<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('consultation_type')->default('chat'); // chat, video_call, whatsapp
            $table->text('topic');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['pending', 'paid', 'scheduled', 'completed', 'cancelled'])->default('pending');
            $table->datetime('scheduled_at')->nullable();
            $table->integer('duration_minutes')->default(30);
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->text('consultant_notes')->nullable();
            $table->integer('rating')->nullable();
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};