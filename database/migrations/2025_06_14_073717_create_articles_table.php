<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('category', ['saving_tips', 'budgeting', 'investment', 'debt_management', 'financial_planning']);
            $table->json('tags')->nullable();
            $table->integer('read_time_minutes')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_published')->default(false);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
