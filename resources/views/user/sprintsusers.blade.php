@extends('layouts.privada')
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
<body>
	@section('content')
	<table id="sprints" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
		<h1> Sprints </h1>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
				<th>Repositorio</th>
				<th>Fecha de inicio</th>
			</tr>
		</thead>
			<tbody>
				@foreach($sprints as $sprint)
				<tr>
					<td><a href="user/{{$user->id}}/sprintsusers" >{{ $sprint->proyecto->nombre }}</a></td>
					<td>{{ $sprint->nombre }}</td>
					<td></td>
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
