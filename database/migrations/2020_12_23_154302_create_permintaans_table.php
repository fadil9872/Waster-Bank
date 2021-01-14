<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateString();
        Schema::create('permintaans', function (Blueprint $table) use($tanggal) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('pengurus_id')->contrained('users')->nullable();
            $table->foreignId('alamat_id')->constrained('alamats');
            $table->string('nama');
            $table->string('lokasi');
            $table->integer('wilayah_id');
            $table->string('no_telpon');
            $table->string('keterangan');
            $table->integer('status')->default('1');
            $table->date('tanggal')->default($tanggal);
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
        Schema::dropIfExists('permintaans');
    }
}
