@extends('layouts.privada')

<script>
function allowDrop(ev) {
    ev.preventDefault();
}
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev, nuevoEstado) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
    $.post("/pizarra", { id: data, estado: nuevoEstado });
}
function hola(){
	console.log("hola");
}
</script>

<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>

 @section('content')

<div class="row">
	<h1 style="text-align: center;">{{$proyecto->nombre}} </h1>
	<h3 style="text-align: center;"> {{$sprint->nombre}} </h3>
</div>
<div class="modal fade" id="crearRequisito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="requisito_form" action="{{ url('requisito/create') }}" method="POST" role="form" data-toggle="validator">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<label for="message-text" class="control-label">Tarea:</label>
					<input type="text" id="nombre" name="nombre" class="form-control" data-minlength="3" maxlength="20" required>
				</div>
				<div class="modal-body">
					<div class="form-group has-feedback">
						<label for="descripcion" class="control-label">Descripción:</label>
						<textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required></textarea>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="control-label">Proyecto - Sprint:</label><br/>
						<input type="hidden" name="sprint_id" value="{{$sprint->id }}" /> {{ $proyecto->nombre . ' - ' . $sprint->nombre }}
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Fecha estimada de finalización:</label>
						<div class="form-group">
							<div class='input-group date' id='datetimepicker6'>
								<input type='text' class="form-control" name="fecha_estimada_fin" id="fecha_estimada_fin"/>
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<script>
           					$('#datetimepicker6').datetimepicker({format: "DD/MM/YYYY"});                
            			</script>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
 @foreach ($requisitos as $requisito )
<div class="modal fade" id="exampleModal{{$requisito->
	 id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="requisito_form_modificar" action="{{ url('requisito/modificar') }}" method="POST" role="form" data-toggle="validator">
				<input type="hidden" name="sprint_id" value="{{$sprint->id }}" /> <input type="hidden" name="id" value="{{$requisito->id }}" /> <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
				<input type="hidden" name="estado" value="{{$requisito->estado }}"/>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<label for="recipient-name" class="control-label">Nombre:</label>
					<input type="text" class="form-control modal-title" name="nombre" value="{{$requisito->nombre}}">
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="recipient-name" class="control-label">Descripción:</label>
						<input type="text" class="form-control" name="descripcion" value="{{$requisito->descripcion}}">
					</div>
					<div class="form-group">
						<label for="recipient-name" class="control-label">Fecha de inicio: </label> {{$requisito->fecha_inicio}}
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Fecha estimada de finalizacion:</label>
						<div class="form-group">
							<div class='input-group date' id='fecha_fin_{{$requisito->
								 id}}'> <input type='text' class="form-control" name="fecha_estimada_fin" value="{{$requisito->fecha_fin_estimada}}"/> <span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<script>
            				$('#fecha_fin_{{$requisito->id}}').datetimepicker({format: "DD/MM/YYYY"});                
           				 </script>
					</div>
				</div>
				
				<div class="well">
				Usuarios Asignados Actualmente:
				<br>
					@foreach($usuarios as $usuario) 
							@foreach($requisitosAsignados as $reqAsig ) 
							@if($requisito->id == $reqAsig->requisito->id)
								@if($usuario->user->id == $reqAsig->user->id ) 
										<!--<option selected="selected" value="{{$usuario->user->id}}">{{$usuario->user->name}}</option>-->
										<label value="{{$usuario->user->name}}">{{$usuario->user->name}}</label>	
										<br>
								@endif 
							@endif 
							@endforeach 
						@endforeach
						<br>
				Selecciona nuevos usuarios:<br/>
					<select name="basic" id="ex-data-multiple-{{$requisito->id}}" multiple style="display: none;" > 					
						
						@foreach($usuarios as $usuario) 
							<option  value="{{$usuario->user->id}}">{{$usuario->user->name}}</option>
						@endforeach
					</select>

					<script type="text/javascript">
						$('#ex-data-multiple-{{$requisito->id}}').picker();
						
						$('#ex-data-multiple-{{$requisito->id}}').on('sp-change', function(){
    						console.log($('#ex-data-multiple-{{$requisito->id}}'));


						$.ajaxSetup({
   							 headers: {
        						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        					}
    					});
						var array = [];
						for(var i=0; i<$('#ex-data-multiple-{{$requisito->id}}')["0"].selectedOptions.length; i++)
						{
							
							array.push($('#ex-data-multiple-{{$requisito->id}}')["0"].selectedOptions[i].value);
						}
			
							$.post("/requisitoUsuario", {
								opciones: array,
								id_requisito: "{{$requisito->id}}"
							});
						});
           			 </script>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Modificar</button>
				</div>
			</form>
		</div>
	</div>
</div>
 @endforeach
<div class="row">
	<div class="col-sm-3 container" style="background-color: lightyellow;margin-top: 40px; margin-right: 40px; margin-left: 40px;">
	<h4>Por hacer</h4>
		<div ondrop="drop(event,'Por hacer')" ondragover="allowDrop(event)">
			<!-- /.box-header -->
			<div class="box-body">		
				<div class="box-group" id="accordion1">
					
					<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
					 @foreach ($requisitos as $requisito ) 
					 @if ($requisito->estado == 'Por hacer')
					<div draggable="true" ondragstart="drag(event)" id="{{$requisito->
						 id}}">
						<div class="panel box box-primary" id="{{$requisito->
							 id}}" draggable="true" ondragstart="drag(event)" >
							<div class="box-header with-border">
								<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion1" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
								<i class="fa fa-fw fa-edit btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}" ></i>
								</h4>
							</div>
							<div id="desplegar{{$requisito->
								 id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
								<div class="box-body">
									 {{$requisito->descripcion}}
								</div>
							</div>
						</div>
					</div>
					 @endif 
					 @endforeach
				</div>
			</div>
			<span class="glyphicon glyphicon-plus btn pull-right" data-toggle="modal" data-target="#crearRequisito"></span>
		</div>
		<!-- /.box-body -->
	</div>
	<div class="col-sm-3 container " style="background-color: lightgreen; margin-top: 40px; margin-right: 40px; margin-left: 40px;">
		<!-- /.box-header -->

		<h4>En trámite</h4>
		<div ondrop="drop(event,'En trámite')" ondragover="allowDrop(event)" >
		<div class="box-body">
			<div class="box-group" id="accordion2">
				
				<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				 @foreach ($requisitos as $requisito ) 
				 @if ($requisito->estado == 'En trámite')
				<div draggable="true" ondragstart="drag(event)" id="{{$requisito->
					 id}}">
					<div class="panel box box-primary" id="{{$requisito->
						 id}}" draggable="true" ondragstart="drag(event)" >
						<div class="box-header with-border">
							<h4 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion2" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
							<i class="fa fa-fw fa-edit btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}" ></i>
							</h4>
						</div>
						<div id="desplegar{{$requisito->
							 id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							<div class="box-body">
								 {{$requisito->descripcion}}
							</div>
						</div>
					</div>
				</div>
				 @endif 
				 @endforeach
			</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<div class="col-sm-3 container "  style="background-color: lightblue; margin-top: 40px; margin-right: 40px; margin-left: 40px;">
		<!-- /.box-header -->
		<h4>Hecho</h4>
		<div ondrop="drop(event, 'Hecho')" ondragover="allowDrop(event)">
		<div class="box-body">
			<div class="box-group" id="accordion3">
				
				<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				 @foreach ($requisitos as $requisito ) 
				 @if ($requisito->estado == 'Hecho')
				<div draggable="true" ondragstart="drag(event)" id="{{$requisito->
					 id}}">
					<div class="panel box box-primary" id="{{$requisito->
						 id}}" draggable="true" ondragstart="drag(event)" >
						<div class="box-header with-border">
							<h4 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion3" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
							<i class="fa fa-fw fa-edit btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}" ></i>
							</h4>
						</div>
						<div id="desplegar{{$requisito->
							 id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							<div class="box-body">
								 {{$requisito->descripcion}}
							</div>
						</div>
					</div>
				</div>
				 @endif 
				 @endforeach
			</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
</div>
<div class="col-sm-1">
</div>
</div>
 @endsection
