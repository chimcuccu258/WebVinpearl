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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('customerId', 10)->primary();
            $table->string('fullName', 255);
            $table->string('phoneNumber', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('image', 255)->default('defaultavt.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};