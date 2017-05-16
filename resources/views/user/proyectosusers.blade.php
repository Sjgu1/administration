@extends('layouts.privada')
<script type="text/javascript">
$(document).ready(function() {

    $('#proyectosusers tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    })

})
</script>
<body>
	@section('content')
	<table id="proyectosusers" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
		<h1> @lang('messages.proyectos')</h1>
			<tr>
        		<th>@lang('messages.nombre')</th>
				<th>@lang('messages.descripcion')</th>
				<th>@lang('messages.repositorio')</th>
				<th>@lang('messages.fecha de inicio')</th>
			</tr>
		</thead>
			<tbody>
				@foreach($proyectosusers as $proyectouser)
				<tr>
					<td><a href="user/proyectosusers" >{{ $proyectouser->proyecto->nombre }}</a></td>
					<td>{{ $proyectouser->nombre }}</td>
					<td></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</form>
	<hr>
@endsection
</body>
