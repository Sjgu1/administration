
@extends('layouts.app')


  @section('seleccion')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<ul class="nav navbar-nav">
  <li><a href="{{ url('/home') }}">@lang('messages.inicio')</a></li>
  <li  class="active"><a href="{{ url('/proyecto') }}">@lang('messages.proyecto')</a></li>
  <li><a href="{{ url('/contacto') }}">@lang('messages.contacto')</a></li>
</ul>
<body>
@endsection
@section('content')
<!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">
                <h1>@lang('messages.proyecto') Crisantemo</h1>
                <h2>@lang('messages.gestiona')</h2>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="about">
            <img class="featurette-image img-circle img-responsive pull-right" src="images/grupoTrabajo.jpg">
            <h2 class="featurette-heading">@lang('messages.crear un proyecto').
                <span class="text-muted">@lang('messages.agrega a tus compañeros de equipo')</span>
            </h2>
            <p class="lead">@lang('messages.empieza')</p>
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="services">
            <img class="featurette-image img-circle img-responsive pull-left" src="images/estadisticas2.png">
            <h2 class="featurette-heading">@lang('messages.graficos').
                <span class="text-muted">@lang('messages.todo').</span>
            </h2>
            <p class="lead">@lang('messages.realiza').</p>
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <img class="featurette-image img-circle img-responsive pull-right" src="images/easybutton.jpg">
            <h2 class="featurette-heading">@lang('messages.sencillez').
                <span class="text-muted">@lang('messages.facil manejo').</span>
            </h2>
            <p class="lead">@lang('messages.ebtra').</p>
        </div>

        <hr class="featurette-divider">


    </div>


</body>
@endsection
