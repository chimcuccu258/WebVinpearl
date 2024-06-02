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
        if (!Schema::hasTable('cthds')) {
            Schema::create('cthds', function (Blueprint $table) {
                $table->string('maHD', 10);
                $table->string('maVe', 10);
                $table->float('soLuong');
                $table->string('giaTien');
                $table->primary(['maHD', 'maVe']);
                $table->foreign('maVe')->references('maVe')->on('ves');
                $table->foreign('maHD')->references('maHD')->on('hoa_dons');
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
        Schema::dropIfExists('cthds');
    }
};