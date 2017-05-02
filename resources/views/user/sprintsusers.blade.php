@extends('layouts.privada')
<script type="text/javascript">
$(document).ready(function() {

    $('#sprintsusers tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@section('content')
	<table id="sprintsusers" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
                <th>Proyecto</th>
				<th>Fecha de inicio</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($sprintsusers as $sprint)
			<tr>
				<td><a href="sprint/{{ $sprint->id }}">{{ $sprint->nombre }}</a></td>
    			<td>{{ $sprint->descripcion }}</td>
				<td><a href="proyecto/{{ $sprint->proyecto->id }}">{{ $sprint->proyecto->nombre }}</a></td>
				<td>{{ $sprint->fecha_inicio }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>		
	</form>
	<hr>
	<!--<form action="{{ url('proyecto/new') }}" method="GET">
	<button type="submit">Crear</button>	
	</button>-->
@endsection
</body>
