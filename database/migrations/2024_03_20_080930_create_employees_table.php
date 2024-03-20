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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employeeId', 10)->primary();
            $table->string('fullName', 255);
            $table->text('address');
            $table->date('birthday');
            $table->string('phoneNumber', 20);
            $table->string('gender', 10);
            $table->string('image', 255);
            $table->string('typeEmployeeId', 10);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->foreign('typeEmployeeId')->references('typeEmployeeId')->on('type_employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};