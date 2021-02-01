<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengurus2_id')->constrained('users');
            $table->string('pembeli');
            $table->integer('gudang_id');
            $table->decimal('berat');
            $table->integer('pendapatan');
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
        Schema::dropIfExists('penjualans');
    }
}
