<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('mensaje');
            $table->timestamp('fecha');
            $table->integer('requisito_id');
            $table->foreign('requisito_id')->references('id')->on('requisitos')->onDelete('cascade');
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
        Schema::dropIfExists('modificacions');
    }
}
