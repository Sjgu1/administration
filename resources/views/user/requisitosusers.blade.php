@extends('layouts.privada')
<script type="text/javascript">
$(document).ready(function() {

    $('#requisitosusers tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@section('content')
	<table id="requisitosusers" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
		<h1> @lang('messages.requisitos') </h1>
			<tr>
        		<th>@lang('messages.nombre')</th>
				<th>@lang('messages.descripcion')</th>
				<th>@lang('messages.sprint')</th>
				<th>@lang('messages.fecha de inicio')</th>
			</tr>
		</thead>
			<tbody>
				@foreach($requisitosusers as $requisitouser)
				<tr>
					<td><a href="user/requisitosusers" >{{ $requisitouser->requisito->nombre }}</a></td>
					<td>{{ $requisitouser->nombre }}</td>
					<td></d>
				</tr>
				@endforeach
			</tbody>
		</table>
@endsection
</body>