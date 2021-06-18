<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('cod_fabricante')->references('id')->on('fabricantes');
            $table->string('lote');
            $table->date('data_validade');
            $table->integer('qtd_recebida');
            $table->integer('qtd_atual');
            $table->integer('intervalo_min');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacinas');
    }
}
