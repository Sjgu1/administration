
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
            <img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">
            <h2 class="featurette-heading">Crea un proyecto.
                <span class="text-muted">Agrega a tus compañeros de equipo</span>
            </h2>
            <p class="lead">Empieza creando un proyecto. Si quieres, puedes agregar compañeros a este proyecto y asignarle los niveles de moficiación que tienen sobre el mismo. Puedes gestionar tus proyectos desde el menú de entrada</p>
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="services">
            <img class="featurette-image img-circle img-responsive pull-left" src="http://placehold.it/500x500">
            <h2 class="featurette-heading">The Second Heading
                <span class="text-muted">Is Pretty Cool Too.</span>
            </h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <img class="featurette-image img-circle img-responsive pull-right" src="http://placehold.it/500x500">
            <h2 class="featurette-heading">The Third Heading
                <span class="text-muted">Will Seal the Deal.</span>
            </h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
@endsection
