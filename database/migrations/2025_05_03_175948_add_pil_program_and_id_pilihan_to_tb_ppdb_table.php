<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPilProgramAndIdPilihanToTbPpdbTable extends Migration
{
    public function up()
    {
        Schema::table('tb_ppdb', function (Blueprint $table) {
            $table->string('pil_program')->nullable(); // bisa diisi nama program secara langsung
            $table->integer('id_pilihan')->nullable(); // bisa jadi foreign key jika diperlukan

            // Jika ada tabel tujuan, misal 'pilihans', aktifkan baris ini:
            // $table->foreign('id_pilihan')->references('id')->on('pilihans');
        });
    }

    public function down()
    {
        Schema::table('tb_ppdb', function (Blueprint $table) {
            // jika ada foreign key, hapus dulu:
            // $table->dropForeign(['id_pilihan']);

            $table->dropColumn(['pil_program', 'id_pilihan']);
        });
    }
}
