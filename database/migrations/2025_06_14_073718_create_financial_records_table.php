<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['income', 'expense']);
            $table->string('category'); // gaji, makanan, transportasi, dll
            $table->text('description');
            $table->decimal('amount', 15, 2);
            $table->date('transaction_date');
            $table->string('payment_method')->nullable(); // cash, bank_transfer, e_wallet
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_records');
    }
};
