<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('apellidos')->nullable();
            $table->timestamp('username')->nullable();
            $table->timestamp('password')->nullable();
            $table->timestamp('fecha_registro')->nullable();
            // provisional
            $table->integer('rol_id')->nullable();
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
            // fin provisional
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
        Schema::dropIfExists('users');
    }
}
