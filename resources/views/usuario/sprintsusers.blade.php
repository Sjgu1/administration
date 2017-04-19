@include('navbar')
<script type="text/javascript">
$(document).ready(function() {

    $('#sprints tr').click(function() {
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
            $('#sprints').DataTable();
        } );
    </script>
</head>
<body>
	<table id="sprints" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
                <th>Proyecto</th>
				<th>Fecha de inicio</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($sprints as $sprint)
			<tr>
				<td><a href="sprint/{{ $sprint->id }}">{{ $sprint->nombre }}</a></td>
    			<td>{{ $sprint->descripcion }}</td>
				<td><a href="proyecto/{{ $sprint->proyecto->id }}">{{ $sprint->proyecto->nombre }}</a></td>
				<td>{{ $sprint->fecha_inicio }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>
