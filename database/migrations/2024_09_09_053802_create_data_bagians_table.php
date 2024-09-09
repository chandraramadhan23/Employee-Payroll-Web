<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBagiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bagians', function (Blueprint $table) {
            $table->id();
            $table->string('bagian');
            $table->unsignedBigInteger('gaji_pokok');
            $table->unsignedBigInteger('transport');
            $table->unsignedBigInteger('total_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_bagians');
    }
}
