<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Starter Template for Bootstrap</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">
        
    </head>
    <body>
        @include('navbar')
        <form action="{{ url('requisito/create') }}" method="POST">
            {{ csrf_field() }
            <div class="form-group">
                <label for="id">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
            </div>
            <label for="descripcion">Descripción:</label>
            <br>
            <input type="text" name="descripcion" id="descripcion">
            <br>
            <br>
            <label for="sprint_id">Sprint:</label>
            <br>
            <select id="sprint_id" name="sprint_id">
                @foreach ($sprints as $sprint)
                    <option value="{{ $sprint->id }}">{{ $sprint->nombre }}</option>
                @endforeach
            </select>
            <br>
            <br>
            <label for="fecha_inicio">Fecha inicio:</label>
            <br>
            <input type="text" name="fecha_inicio" id="fecha_inicio">
            <br>
            <br>
            <label for="fecha_fin_estimada">Fecha fin estimada:</label>
            <br>
            <input type="text" name="fecha_fin_estimada" id="fecha_fin_estimada">
            <br>
            <br>
            <button type="submit">Crear</button>
        </form>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>