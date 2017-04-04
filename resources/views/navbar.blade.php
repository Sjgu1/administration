<!DOCTYPE html>
<html>
<head>
    <!-- Versión compilada y comprimida del CSS de Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
    <!-- Tema opcional -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		
</head>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Crisantemo</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('users') }}">Listar usuarios</a></li>
                        <!-- <li><a href="{{ url('proyecto/new') }}">Crear usuario</a></li> -->
                        <!-- <li><a href="{{ url('proyectosusers') }}">Listar roles de usuarios en proyectos</a></li>-->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proyectos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('proyectos') }}">Listar proyectos</a></li>
                        <li><a href="{{ url('proyecto/new') }}">Crear proyecto</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sprints<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('sprints') }}">Listar sprints</a></li>
                        <li><a href="{{ url('sprint/new') }}">Crear sprint</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Requisitos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('requisitos') }}">Listar requisitos</a></li>
                        <li><a href="{{ url('requisito/new') }}">Crear requisito</a></li>
                        <!-- <li><a href="{{ url('requisito/new') }}">Listar dependencias entre requisitos</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rols<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('rols') }}">Listar rols</a></li>
                        <li><a href="{{ url('rol/new') }}">Crear rol</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Permisos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('permisos') }}">Listar permisos</a></li>
                        <li><a href="{{ url('permiso/new') }}">Crear permiso</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>