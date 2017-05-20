@extends('layouts.privada')
@section('cabecera')
@if(session()->has('message'))
    @if(session()->has('exito'))
    <div id="event-modal" class="callout callout-success" style="position: fixed;">
        <p>{{ session()->get('message') }}</p>
    </div>
    @else
    <div id="event-modal" class="callout callout-danger" style="position: fixed;">
        <p>{{ session()->get('message') }}</p>
    </div>
    @endif
@endif
@endsection
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
/*$(document).ready(function() {
	var firstName = $('.firstName').text();
	var intials = $('.firstName').text().charAt(0);
	var profileImage = $('.profileImage').text(intials);
	});*/
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
            <li><a href="#"><i class="fa fa-dashboard"></i>@lang('messages.inicio')</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">@lang('messages.actividad')</li>
        </ol>
    </section>
	<div class="row">
		<section class="content connectedSortable">
			@foreach($proyectosusers as $proyectouser)
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-aqua">
						<span class="info-box-icon btn" onclick="sesionProyecto({{$proyectouser->proyecto}})"><div class="profileImage"></div></span>
						<div class="info-box-content">
							<span class="info-box-text firstName">{{ $proyectouser->proyecto->nombre }}</span>
							
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div>
				<script>$('.profileImage').text($('.firstName').text().charAt(0));</script>
				@endforeach
				<a href="{{ url('user/proyecto/new') }}">
				<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box bg-aqua">
							<span class="info-box-icon"><div>+</div></span>
							<div class="info-box-content">
								<span class="info-box-text">@lang('messages.nuevo proyecto')</span>
								
							</div><!-- /.info-box-content -->
						</div><!-- /.info-box -->
					</div>
				</a>
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
	<script>
function sesionProyecto(elmnt) {
     console.log(elmnt);

    $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       

       $.post("/setSession", {
           selected_project: elmnt
       });

	    window.location.href = "/userspublic";
}
	</script>
	<script>
$(document).ready(function(){
   setTimeout(function(){
         $('#event-modal').fadeOut(200);
   },1000);
});
</script>
@endsection
