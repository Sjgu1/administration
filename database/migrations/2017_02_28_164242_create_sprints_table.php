<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->timestamp('fecha_fin_estimada')->nullable();
            $table->string('color1')->nullable()->default('#B0B5B5');
            $table->string('colorTexto1')->nullable();
            $table->string('color2')->nullable()->default('#B0B5B5');;
            $table->string('colorTexto2')->nullable();
            $table->string('color3')->nullable()->default('#B0B5B5');;
            $table->string('colorTexto3')->nullable();
            $table->integer('proyecto_id');
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
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
        Schema::dropIfExists('sprints');
    }
}
