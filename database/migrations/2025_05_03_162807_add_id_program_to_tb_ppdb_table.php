<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tb_ppdb', function (Blueprint $table) {
            $table->integer('id_program')->nullable(); // kolom baru
            $table->foreign('id_program')->references('id')->on('tb_paket_kursus'); // sesuaikan nama tabel tujuan
        });
    }

    public function down()
    {
        Schema::table('tb_ppdb', function (Blueprint $table) {
            $table->dropForeign(['id_program']);
            $table->dropColumn('id_program');
        });

    }

    /**
     * Reverse the migrations.
     */
   
};
