@extends('layouts.privada')

@section('content')

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminlte/dist/js/pages/dashboard.js"></script>

    <!-- Header -->
    <section class="content-header">
        <h1>Requisitos<small>Proyecto X</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Timeline</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content connectedSortable">
        <div class="callout callout-info">
            <h4>{{ $sprint->nombre }}</h4>

        <p>{{ $sprint->fecha_inicio }} <i class="fa fa-minus"></i> {{ $sprint->fecha_fin_estimada }}</p>
      </div>
        <div class="row">
            <div id="requisitos_no_finalizados" class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Requisitos en proceso</h3>

                        <!--<div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Nombre</th>
                                <th>Progreso estimado</th>
                                <th>%</th>
                                <th>Finalización</th>
                                <th>Usuarios</th>
                            </tr>

                            @foreach ($requisitos_no_finalizados as $requisito)
                                <tr data-toggle="modal" data-target="#exampleModal{{ $requisito->id }}">
                                    <td>{{ $requisito->nombre }}</td>
                                    <td>
                                        <div class="progress progress-xs {{ $requisito->stripped }} active">
                                            <div class="progress-bar progress-bar-{{ $requisito->color }}" style="width: {{ $requisito->progreso }}"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-{{ $requisito->color }}">{!! $requisito->porcentaje !!}</span></td>
                                    <td>{{ $requisito->finalizacion }}</td>
                                    <td><img src="/images/cara.jpg" class="user-image" alt="User Image" width="25" height="25"></td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <!-- Requisitos finalizados -->
        <div class="row">
            <div id="requisitos_finalizados" class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Requisitos finalizados</h3>

                        <!--<div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin estimada</th>
                                <th>Fecha fin</th>
                                <th>Duración</th>
                            </tr>

                            @foreach ($requisitos_finalizados as $requisito)
                                <tr data-toggle="modal" data-target="#exampleModal{{ $requisito->id }}">
                                    <td><strike>{{ $requisito->nombre }}</strike></td>
                                    <td>{{ $requisito->fecha_inicio }}</td>
                                    <td>{{ $requisito->fecha_fin_estimada }}</td>
                                    <td>{{ $requisito->fecha_fin }}</td>
                                    <td>{{ $requisito->duracion }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- Fin requisitos finalizados -->
    </section>


<!-- Formularios modificación -->
@foreach ($requisitos as $requisito)
<div class="modal fade" id="exampleModal{{$requisito->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                    <!-- FALTA TRABAJO DE SERGIO PARA QUE ESTO VAYA -->
                    {{--@foreach($usuarios as $usuario) 
							@foreach($requisitosAsignados as $reqAsig ) 
							@if($requisito->id == $reqAsig->requisito->id)
								@if($usuario->user->id == $reqAsig->user->id ) 
										<!--<option selected="selected" value="{{$usuario->user->id}}">{{$usuario->user->name}}</option>-->
										<label value="{{$usuario->user->name}}">{{$usuario->user->name}}</label>	
										<br>
								@endif 
							@endif 
							@endforeach 
						@endforeach--}
						<br>
				Selecciona nuevos usuarios:<br/>
					<select name="basic" id="ex-data-multiple-{{$requisito->id}}" multiple style="display: none;" > 					
						
                        <!-- FALTA TRABAJO DE SERGIO PARA QUE ESTO VAYA -->
						{{--@foreach($requisito->users as $usuario) 
							<option  value="{{$usuario->user->id}}">{{$usuario->user->name}}</option>
						@endforeach--}}
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

<!-- FIN Formularios modificación -->
@endforeach

@endsection