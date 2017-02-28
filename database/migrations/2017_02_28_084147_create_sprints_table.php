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
        //Schema::enableForeignKeyConstraints();

        Schema::create('sprints', function (Blueprint $table) {
           
            $table->integer('idProyecto');
            $table->integer('id');
            $table->foreign('idProyecto')->references('id')->on('proyectos');
            $table->primary(['id','idProyecto']);
            $table->timestamp('fechaInicio');
            $table->timestamp('fechaFin');
            $table->string('nombre');
            $table->string('descripcion');
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
