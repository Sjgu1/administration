<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Proyecto;
use App\Sprint;
use App\Requisito;

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
        $this->assertEquals($resultado, 'Proyecto número 1');
    }

    public function testConsultarID()
    {
        $proyecto = Proyecto::where('id', '=', '3')->first();
        $resultado = $proyecto->nombre;
        $this->assertEquals($resultado, 'Proyecto número 3');
    }

    public function testInsertar()
    {
        $proyecto = new Proyecto();
        $proyecto->nombre = 'Proyecto Insertado';
        $proyecto->save();

        $proyecto = Proyecto::where('nombre', '=', 'Proyecto Insertado')->first();
        $resultado = $proyecto->nombre;
        $this->assertEquals($resultado, 'Proyecto Insertado');
    }

    // Test de inserción de proyecto vacío. De acuerdo al diagrama UML, debería insertarse
    public function testInsertarProyectoC1(){

        $proyecto = new Proyecto();
        $proyecto->save();

        $count = Proyecto::where('nombre', null)->get()->count();

        $proyecto->delete();

        $this->assertGreaterThanOrEqual('0', $count);

    }

    // Test de inserción de sprint sin estar asociado a un proyecto. De acuerdo al diagrama UML, debería fallar
    public function testInsertarSprintC1(){

        try {

            $sprint = new Sprint();
            $sprint->save();

            $this->fail();

        }
        catch (\PDOException $exception){

            $this->assertTrue(true);

        }

    }

    // Test de inserción y asociación de múltiples sprints a un mismo proyecto
    public function testAsociarMultiplesSprintsAProyecto(){

        $proyecto = new Proyecto(['nombre' => 'Proyecto de prueba 96']);
        $proyecto->save();

        $proyecto = Proyecto::where('nombre', 'Proyecto de prueba 96')->first();

        $proyecto->sprints()->saveMany([
            new Sprint(['nombre' => 'Sprint de prueba 1']),
            new Sprint(['nombre' => 'Sprint de prueba 2']),
            new Sprint(['nombre' => 'Sprint de prueba 3'])
        ]);

        $counts = Sprint::where('proyecto_id', $proyecto->id)->get()->count();

        $this->assertEquals($counts, 3);

        $proyecto->delete();

    }

    // Test de inserción de requisito sin estar asociado a un sprint. De acuerdo al diagrama UML, debería fallar
    public function testInsertarRequisitoC1(){

        try {

            $requisito = new Requisito();
            $requisito->save();

            $this->fail();

        }
        catch (\PDOException $exception){

            $this->assertTrue(true);

        }
        
    }

    // Test de inserción y asociación de múltiples requisitos a un mismo sprint
    public function testAsociarMultiplesRequisitosASprint(){

        $proyecto = new Proyecto(['nombre' => 'Proyecto de prueba 256']);
        $proyecto->save();

        $sprint = new Sprint();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $proyecto = Proyecto::where('nombre', 'Proyecto de prueba 256')->first();
        $sprint = Sprint::where('proyecto_id', $proyecto->id)->first();

        $sprint->requisitos()->saveMany([
            new Requisito(['nombre' => 'Sprint de prueba 1']),
            new Requisito(['nombre' => 'Sprint de prueba 2']),
            new Requisito(['nombre' => 'Sprint de prueba 3'])
        ]);

        $counts = Requisito::where('sprint_id', $sprint->id)->get()->count();

        $this->assertEquals($counts, 3);

        $proyecto->delete();
        
    }

    //Se borra un proyecto y se comprueba que los sprints asociado también se borran.
    public function testBorrarProyectoC1()
    {

        $proyecto = Proyecto::where('nombre', 'Proyecto Insertado')->first();
        $idInsertado = $proyecto->id;
        $proyecto->delete();

       //$sprint= new Sprint();
        $sprints = Sprint::where('proyecto_id', $idInsertado)->get();
        $sprintsCount = $sprints->count();
        $this->assertEquals($sprintsCount, '0');
    }
    //Se crea un proyecto con un sprint asociado y un requisito asociado a este sprint. 
    //Se borra un proyecto y se comprueba el borrado en cascada.
    public function testBorrarProyectoC2()
    {

        //Creacion de Proyecto, sprint y requisitos asociados entre si
        $proyecto = new Proyecto();
        $proyecto->nombre = 'Proyecto test insertado';
        $proyecto->save();

        $sprint = new Sprint();
        $sprint->proyecto()->associate($proyecto->id);
        $sprint->descripcion = 'Sprint asociado a testBorrarProyecto2';
        $sprint->save();

        $requisito = new Requisito();
        $requisito->sprint()->associate($sprint->id);
        $requisito->descripcion='Requisito asociado a testBorrarProyecto2';
        $requisito->save();

        //Guardar identificadores para comprar si siguen existiendo
        $idProyecto = $proyecto->id;
        $idSprint = $sprint->id;
        $idRequisito = $requisito->id;

        //Comprobamos que se han relacionado
        $sprints = Sprint::where('proyecto_id', $idProyecto)->get();
        $sprintsCount = $sprints-> count();
        $this->assertEquals($sprintsCount, '1');

        $requisitos = Requisito::where('sprint_id', $idSprint)->get();
        $requisitosCount = $requisitos-> count();
        $this->assertEquals($requisitosCount, '1');
        
        //Borrado de proyecto
        $proyecto = Proyecto::find($idProyecto);
        $proyecto->delete();

       //Comprobación de borrado en cascada.
        $sprints = Sprint::where('proyecto_id', $idProyecto)->get();
        $sprintsCount = $sprints-> count();
        $this->assertEquals($sprintsCount, '0');

        $requisitos = Requisito::where('sprint_id', $idSprint)->get();
        $requisitosCount = $requisitos-> count();
        $this->assertEquals($requisitosCount, '0');
        
    }
}
