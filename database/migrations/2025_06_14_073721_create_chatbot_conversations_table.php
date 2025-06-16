<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatbot_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('user_message');
            $table->text('bot_response');
            $table->string('conversation_type')->default('financial_advice'); // Tipe percakapan
            $table->json('context')->nullable(); // Konteks percakapan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chatbot_conversations');
    }
};
