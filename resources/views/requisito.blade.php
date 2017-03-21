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
        <form action="{{ url('requisito/modificar') }}" method="POST">
            {{ csrf_field() }}
            <label for="id">ID:</label>
            <br>
            <input type="text" name="id" id="id" value="{{ $requisito->id }}">
            <br>
            <br>
            <label for="nombre">Nombre:</label>
            <br>
            <input type="text" name="nombre" id="nombre" value="{{ $requisito->nombre }}">
            <br>
            <br>
            <label for="descripcion">Descripción:</label>
            <br>
            <input type="text" name="descripcion" id="descripcion" value="{{ $requisito->descripcion }}">
            <br>
            <br>
            <button type="submit">Modificar</button>
        </form>
        <a href="/requisito/borrar/{{ $requisito->id }}">Borrar</a>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>