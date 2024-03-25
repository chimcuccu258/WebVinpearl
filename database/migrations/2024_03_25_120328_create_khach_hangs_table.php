<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('khach_hangs')) {
            Schema::create('khach_hangs', function (Blueprint $table) {
                $table->string('maKH', 10)->primary();
                $table->string('hoTenKH', 255);
                $table->string('sdt', 20)->nullable();
                $table->text('diaChi')->nullable();
                $table->date('ngaySinh')->nullable();
                $table->tinyInteger('gioiTinh')->nullable();
                $table->string('email', 255)->unique();
                $table->string('matKhau', 255);
                $table->string('anh', 255)->default('defaultavt.png');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khach_hangs');
    }
};