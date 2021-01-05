<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendataansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendataans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('pengurus1_id')->constrained('users');
            $table->foreignId('permintaan_id')->contrained('permintaans')->onDelete('cascade');
            $table->foreignId('sampah_id')->constrained('sampahs');
            $table->string('berat');
            $table->integer('keterangan');
            $table->integer('debit')->default(0);
            $table->integer('kredit')->default(0);
            $table->integer('saldo');
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
        Schema::dropIfExists('pendataans');
    }
}
