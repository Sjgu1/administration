<!DOCTYPE html>
<html>
<head>
    <!-- Versión compilada y comprimida del CSS de Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
    <!-- Tema opcional -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
 
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	
	

	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js">
	</script>

	<script type="text/javascript" class="init">	
        $(document).ready(function() {
            $('#rols').DataTable();
        } );
    </script>
</head>
<body>
	@include('navbar')
	<table id="rols" class="table table-striped table-bordered" cellspacing="0" width="100%">
    	<thead>
			<tr>
    			<!--<th>Id</th>-->
        		<th>Nombre</th>
				<th>Descripción</th>
			</tr>
		</thead>
		<!--<tfoot>
    		<tr>
    			<th>ID</th>
        		<th>Nombre</th>
				<th>Descripción</th>
			</tr>
        </tfoot>-->
		<tbody>
            @foreach ($rols as $rol)
			<tr>
				<!--<td>{{ $rol->id }}</td>-->
				<td>{{ $rol->nombre }}</td>
    			<td>{{ $rol->descripcion }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>
</html>