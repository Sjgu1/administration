@include('navbar')
<script type="text/javascript">
$(document).ready(function() {

    $('#requistos tr').click(function() {
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
            $('#requisitos').DataTable();
        } );
    </script>
</head>
<body>

	<table id="requisitos" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
                <th>Sprint</th>
				<th>Fecha de inicio</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($requisitos as $requisito)
			<tr>
				<td><a href="requisito/{{ $requisito->id }}">{{ $requisito->nombre }}</a></td>
    			<td>{{ $requisito->requisito }}</td>
				<td><a href="sprint/{{ $requisito->sprint->id }}">{{ $requisito->sprint->nombre }}</a></td>
				<td>{{ $requisito->fecha_inicio }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>
