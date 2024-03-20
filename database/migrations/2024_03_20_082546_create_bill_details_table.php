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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->string('billId', 10);
            $table->string('ticketId', 10);
            $table->float('quantity');
            $table->string('price');
            $table->primary(['billId', 'ticketId']);
            $table->foreign('ticketId')->references('ticketId')->on('tickets');
            $table->foreign('billId')->references('billId')->on('bills');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};