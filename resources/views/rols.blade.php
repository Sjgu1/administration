@include('navbar')
<script type="text/javascript">
$(document).ready(function() {

    $('#rols tr').click(function() {
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
            $('#rols').DataTable();
        } );
    </script>
</head>
<body>

	<table id="rols" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
                <th>Permisos</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($rols as $rol)
			<tr>
				<td><a href="rol/{{ $rol->id }}">{{ $rol->nombre }}</a></td>
    			<td>{{ $rol->descripcion }}</td>
                <td>
                @foreach ($rol->permisos as $permiso)
					<span class="label label-default">{{ $permiso->nombre }}</span>
                @endforeach
                </td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>
