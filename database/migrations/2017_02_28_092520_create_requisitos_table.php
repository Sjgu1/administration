<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();

        Schema::create('requisitos', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('idProyecto');
            $table->integer('idSprint');
            $table->foreign('idProyecto')->references('idProyecto')->on('sprints');
            $table->foreign('idSprint')->references('id')->on('sprints');
            $table->primary(['id', 'idProyecto', 'idSprint']);
            $table->boolean('finalizado')->default(0);
            $table->string('tiempoFinEstimado')->nulleable();
            $table->enum('estado', ['Pendiente','En Desarrollo', 'Finalizado'])->default('Pendiente');
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
        Schema::dropIfExists('requisitos');
    }
}
