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
        Schema::table('pendaftar_online', function (Blueprint $table) {
            $table->string('program')->after('info_dari');
            $table->decimal('harga', 10, 2)->after('program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_ppdb', function (Blueprint $table) {
            //
        });
    }
};
