<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitosRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisito_requisito', function (Blueprint $table) {
            $table->integer('requisito_id');
            $table->integer('requisito_precedente_id');
            $table->foreign('requisito_id')->references('id')->on('requisitos')->onDelete('cascade');
            $table->foreign('requisito_precedente_id')->references('id')->on('requisitos')->onDelete('cascade');
            $table->primary(['requisito_id', 'requisito_precedente_id']);
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
        Schema::dropIfExists('requisito_requisito');
    }
}
