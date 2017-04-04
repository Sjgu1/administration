@include('navbar')
<script type="text/javascript">
$(document).ready(function() {

    $('#proyectos tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js">
	</script>

	<script type="text/javascript" class="init">	
        $(document).ready(function() {
            $('#proyectos').DataTable();
        } );
    </script>
</head>
<body>

	<table id="proyectos" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
				<th>Repositorio</th>
				<th>Fecha de inicio</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($proyectos as $proyecto)
			<tr>
				<td><a href="proyecto/{{ $proyecto->id }}">{{ $proyecto->nombre }}</a></td>
    			<td>{{ $proyecto->descripcion }}</td>
				<td>{{ $proyecto->repositorio }}</td>
				<td>{{ $proyecto->fecha_inicio }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>