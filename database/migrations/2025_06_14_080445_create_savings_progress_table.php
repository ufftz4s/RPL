<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('savings_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('savings_target_id')->constrained('savings_targets')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->date('saved_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('savings_progress');
    }
};
