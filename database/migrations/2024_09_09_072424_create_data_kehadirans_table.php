<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kehadirans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // Mengacu pada tabel data_karyawans
            $table->unsignedBigInteger('bulan'); // Simpan bulan sebagai integer (01-12)
            $table->unsignedBigInteger('tahun'); // Simpan tahun sebagai integer (2024)
            $table->unsignedInteger('sakit')->default(0);
            $table->unsignedInteger('alpha')->default(0);
            $table->timestamps();
            
            $table->foreign('karyawan_id')->references('id')->on('data_karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_kehadirans');
    }
}
