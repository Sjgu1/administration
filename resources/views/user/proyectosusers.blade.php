@extends('layouts.privada')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#proyectosusers tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    })

})
$(document).ready(function() {
	var firstName = $('.firstName').text();
	var intials = $('.firstName').text().charAt(0);
	var profileImage = $('.profileImage').text(intials);
	});
</script>

<style>
	.centrate{
		padding: 25%;
	}
</style>

	@section('content')
	<section class="content-header">
        <h1> @lang('messages.proyectos')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Timeline</li>
        </ol>
    </section>
	<div class="row">
		<section class="content connectedSortable">
			@foreach($proyectosusers as $proyectouser)
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box bg-aqua">
							<span class="info-box-icon"><div class="profileImage"></div></span>
							<div class="info-box-content">
								<span class="info-box-text firstName">{{ $proyectouser->proyecto->nombre }}</span>
								
							</div><!-- /.info-box-content -->
						</div><!-- /.info-box -->
					</div>
					@endforeach
		</section>
	</div>
	

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
