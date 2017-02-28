<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Proyecto;

class ProyectoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testLeerNombre()
    {
        $proyecto = Proyecto::find(1);
        $resultado = $proyecto->nombre;
        $this->assertEquals($resultado, 'proyecto1');
    }

     public function testConsultarID()
    {
        $proyecto = Proyecto::where('id','=','3')->first();
        $resultado = $proyecto->nombre;
        $this->assertEquals($resultado, 'proyecto3');
    }

    public function testInsertar()
    {
        $proyecto = new Proyecto();
        $proyecto->nombre = 'proyectoInsertado';
        $proyecto->fechaInicio = time();
        $proyecto->fechaFin = time();
        $proyecto->save();

        $proyecto = Proyecto::where('nombre','=','proyectoInsertado')->first();
        $resultado = $proyecto->nombre;
        $this->assertEquals($resultado, 'proyectoInsertado');
    }
    
}
