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
	@section('content')
	<h1> @lang('messages.proyectos')</h1>
		@foreach($proyectosusers as $proyectouser)
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-calendar"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">{{ $proyectouser->proyecto->nombre }}</span>
							
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div>
				@endforeach

	<!--<table id="proyectosusers" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
		
			<tr>
        		<th>@lang('messages.nombre')</th>
				<th>@lang('messages.descripcion')</th>
				<th>@lang('messages.repositorio')</th>
				<th>@lang('messages.fecha de inicio')</th>
			</tr>
		</thead>
				
			
		</table>
	</form>
	<hr>-->
@endsection
