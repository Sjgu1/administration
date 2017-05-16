
@extends('layouts.app')

@section('head')
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
      max-height:400px;

  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
  @endsection
  @section('seleccion')
<ul class="nav navbar-nav">
  <li class="active"><a href="{{ url('/home') }}">@lang('messages.inicio')</a></li>
  <li ><a href="{{ url('/proyecto') }}">@lang('messages.proyecto')</a></li>
  <li><a href="{{ url('/contacto') }}">@lang('messages.contacto')</a></li>
</ul>
<body>
@endsection
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/metodologiaRecortada.png"  alt="Image">
        <div class="carousel-caption">
          <h3>@lang('messages.trabaja en equipo')</h3>
          <p>Organiza tus proyectos de forma sencilla.</p>
        </div>      
      </div>

      <div class="item">
        <img src="images/estadisticas.jpg"  alt="Image">
        <div class="carousel-caption">
          <h3>@lang('messages.estadisticas').</h3>
          <p>Comprueba el estado de tu proyecto en todo momento</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>@lang('messages.metodologias agiles')</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="images/reunion.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Organiza tus sprints</p>
    </div>
    <div class="col-sm-4"> 
      <img src="images/tareas.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Crea tareas</p>    
    </div>
    <div class="col-sm-4"> 
      <img src="images/programar.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Comienza a trabajar</p>    
    </div>
  </div>
  <div class="row">
      El desarrollo ágil de software envuelve un enfoque para la toma de decisiones en los proyectos de software, que se refiere a métodos de ingeniería del software basados en el desarrollo iterativo e incremental, donde los requisitos y soluciones evolucionan con el tiempo según la necesidad del proyecto. Así el trabajo es realizado mediante la colaboración de equipos auto-organizados y multidisciplinarios, inmersos en un proceso compartido de toma de decisiones a corto plazo.
      <br/><br/>
      Cada iteración del ciclo de vida incluye: planificación, análisis de requisitos, diseño, codificación, pruebas y documentación. Teniendo gran importancia el concepto de "Finalizado" (Done), ya que el objetivo de cada iteración no es agregar toda la funcionalidad para justificar el lanzamiento del producto al mercado, sino incrementar el valor por medio de "software que funciona" (sin errores).
  </div>
</div><br>

@endsection
