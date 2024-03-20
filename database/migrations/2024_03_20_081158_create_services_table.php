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
        Schema::create('services', function (Blueprint $table) {
            $table->string('serviceId', 10)->primary();
            $table->string('serviceName', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->default('default.png');
            $table->string('typeServiceId', 10);
            $table->float('ranking')->nullable();
            $table->string('phoneService', 20);
            $table->text('addressService');
            $table->foreign('typeServiceId')->references('typeServiceId')->on('type_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};