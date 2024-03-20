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
        Schema::create('bills', function (Blueprint $table) {
            $table->string('billId', 10)->primary();
            $table->string('customerId', 10);
            $table->dateTime('paymentDate');
            $table->string('phoneNumber', 20)->nullable();
            $table->string('email', 255);
            $table->foreign('customerId')->references('customerId')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};