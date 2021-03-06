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
        Schema::create('requisitos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color')->nullable();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->timestamp('fecha_fin_estimada')->nullable();
            $table->integer('sprint_id');
            $table->foreign('sprint_id')->references('id')->on('sprints')->onDelete('cascade');
            $table->enum('estado', ['Por hacer', 'En trámite' , 'Hecho']);
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
