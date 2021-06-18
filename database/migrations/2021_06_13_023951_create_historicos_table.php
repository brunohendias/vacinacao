<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();
            $table->date('data_vacinacao');
            $table->date('data_prox_vaci');
            $table->foreignId('cod_paciente')->references('id')->on('pacientes');
            $table->foreignId('cod_vacina')->references('id')->on('vacinas');
            $table->string('id_dose');
            $table->integer('dose_atual');
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
        Schema::dropIfExists('historicos');
    }
}
