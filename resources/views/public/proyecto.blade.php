
@extends('layouts.app')


  @section('seleccion')
<ul class="nav navbar-nav">
  <li><a href="{{ url('/home') }}">Home</a></li>
  <li  class="active"><a href="{{ url('/proyecto') }}">Proyecto</a></li>
  <li><a href="{{ url('/contacto') }}">Contacto</a></li>
</ul>
<body>
@endsection
@section('content')
<!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">
                <h1>Proyecto Crisantemo</h1>
                <h2>Gestiona tus proyectos de manera sencilla</h2>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="about">
            <img class="featurette-image img-circle img-responsive pull-right" src="images/grupoTrabajo.jpg">
            <h2 class="featurette-heading">Crea un proyecto.
                <span class="text-muted">Agrega a tus compañeros de equipo</span>
            </h2>
            <p class="lead">Empieza creando un proyecto. Si quieres, puedes agregar compañeros a este proyecto y asignarle los niveles de moficiación que tienen sobre el mismo. Puedes gestionar tus proyectos desde el menú de entrada</p>
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="services">
            <img class="featurette-image img-circle img-responsive pull-left" src="images/estadisticas2.png">
            <h2 class="featurette-heading">Gráficas.
                <span class="text-muted">Todo lo que quieres saber.</span>
            </h2>
            <p class="lead">Realiza un seguimiento de tus proyectos. Analiza la colaboración de cada participante, observa el progreso y lo que falta para terminar, obtén feedback para mejorar futuros proyetos.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <img class="featurette-image img-circle img-responsive pull-right" src="images/easybutton.jpg">
            <h2 class="featurette-heading">Sencillez.
                <span class="text-muted">Fácil manejo.</span>
            </h2>
            <p class="lead">Entra en las metodologías ágiles de una forma sencilla, aprende a manejar tus incidencias y a trabajar en grupo sin necesidad de horas de aprendizaje.</p>
        </div>

        <hr class="featurette-divider">


    </div>


</body>
@endsection
