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
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('ticketId', 10)->primary();
            $table->string('serviceId', 10);
            $table->boolean('ticketType');
            $table->decimal('price',  $precision = 13, $scale = 0);
            $table->foreign('serviceId')->references('serviceId')->on('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};