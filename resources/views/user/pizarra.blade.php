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
@section('content')
<input id="fecha_inicio_sprint" class="hide" value="{{$sprint->fecha_inicio}}"/>
<script src="/adminlte/colores.js"></script>
<script type="text/javascript">
   function update(valor, id) {  
   
       document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.backgroundColor =valor;
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       
       $.post("/requisitoUsuario/colores", {
           columna: document.getElementById('cambiarColor').getAttribute('value'),
           color: document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.backgroundColor =  valor,
           cambiar: "fondo",
           sprint_id: id
       });
   
   }
</script>
<script type="text/javascript">
   function updateTexto(valor, id) {
       document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).firstElementChild.style.color = valor;
      
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.post("/requisitoUsuario/colores", {
           columna: document.getElementById('cambiarColor').getAttribute('value'),
           color: document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).firstElementChild.style.color = valor,
           cambiar: "texto",
           sprint_id: id
       });
   
   }
</script>
<script type="text/javascript">
   function updateRequisitoColor(valor, id) {
       //document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).css.backgroundTopColor = '#' + jscolor;
       document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.borderTopColor =valor;
       // $('document.getElementById(document.getElementById('cambiarColor').getAttribute('value'))')
   
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.post("/requisitoUsuario/colorRequisito", {
           color: document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.color = valor,
           requisito_id: id
       });
   }
</script>
<script>
   function allowDrop(ev) {
       ev.preventDefault();
   }
   
   function drag(ev) {
       ev.dataTransfer.setData("text", ev.target.id);
   }
   
   function drop(data, nuevoEstado) {
   
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   
       $.post("/pizarra", {
           id: data,
           estado: nuevoEstado
       });
   
   }
   
   function cambiarColor(recibido) {
   
       var a = document.getElementById('cambiarColor');
       a.setAttribute('value', recibido);
      
   }
</script>
<script>
   $('#exampleModal').on('show.bs.modal', function(event) {
       var button = $(event.relatedTarget)
       var recipient = button.data('whatever')
       var modal = $(this)
       modal.find('.modal-title').text('New message to ' + recipient)
       modal.find('.modal-body input').val(recipient)
   })
</script>
<script></script>
<input id="cambiarColor" style="display:none;" value="columna1">
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
   $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
<!-- bootstrap color picker -->
<script src="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminlte/dist/js/pages/dashboard.js"></script>
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css">
<!-- bootstrap color picker -->
<script src="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<section class="content-header">
   <h1>{{$proyecto->nombre}}
      <small>{{$sprint->nombre}}
      @if ($modificar_sprint)
      <a href="#" data-toggle="collapse" data-target="#selectorColores" ><i class="fa fa-gears"></i></a>
      @endif
      </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.inicio')</a></li>
      <li><a href="#">UI</a></li>
      <li class="active">@lang('messages.actividad')</li>
   </ol>
</section>
<div class="content">
   <div class="content">
      <div class="row">
         <div class="col-md-12 container">
            <div class="collapse fade" id="selectorColores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
               <div class="col-md-12 well-sm">
                  <div class="box box-default">
                     <div class="box-header with-border">
                        <h3 class="box-title">@lang('messages.ajustes de diseño')</h3>
                        <div class="box-tools pull-right">
                           <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#selectorColores"><i class="fa fa-remove"></i></button>
                        </div>
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" onchange="cambiarColor(this.value);">
                                       <option value="columna1">@lang('messages.por hacer')</option>
                                       <option value="columna2">@lang('messages.en tramite')</option>
                                       <option value="columna3">@lang('messages.hecho')</option>
                                    </select>
                                 </div>
                              </div>
                              <!-- /.col -->
                              <div class="col-md-3">
                                 <label>@lang('messages.color del fondo')</label>
                                 <div class="input-group my-colorpicker-col colorpicker-element">
                                    <input type="text" name="input_color_col" id="input_color_col"  class="form-control" style="background-color: #fff;" />
                                    <div class="input-group-addon">
                                       <i style="background-color: rgb(130, 124, 124);"></i>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.col -->
                              <div class="col-md-3">
                                 <label>@lang('messages.color del texto')</label>
                                 <div class="input-group my-colorpicker-text colorpicker-element">
                                    <input type="text" name="input_color_text" id="input_color_text"  class="form-control" style="background-color: #fff;" changeColor="updateTexto(this.value,{{$sprint->id}})"/>
                                    <div class="input-group-addon">
                                       <i style="background-color: rgb(130, 124, 124);"></i>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.col -->
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="col-md-12 box box-primary well-sm" id="columna1" style="background-color:{{$sprint->color1}}; color:{{$sprint->colorTexto1}};">
               <div class="box-header with-border" >
                  <h3 class="box-title">@lang('messages.por hacer')</h3>
                  @if ($crear_requisito)
                  <span class=" pull-right glyphicon glyphicon-plus" data-toggle="modal" data-target="#crearRequisito" style="cursor: pointer; cursor: hand;">
                  @endif
                  </span>
               </div>
               <div id="accordion1" class="@if ($modificar_requisito) connectedSortable @endif box-body">
                  @foreach ($requisitos as $requisito ) @if ($requisito->estado == 'Por hacer')
                  <div class="panel box box-primary" style="border-top-width:7px; border-top-color:{{$requisito->color}}" id="modal{{$requisito->id}}" onclick="cambiarColor(modal{{$requisito->id}}.id)">
                     <div class="box-header with-border" id="{{$requisito->id}}">
                        <h4 class="box-title">
                           <a  data-toggle="collapse" data-parent="#accordion1" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
                        </h4>
                        <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}"></i>
                     </div>
                     <div id="desplegar{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div style="color:#000" class="box-body">
                           {{$requisito->descripcion}}
                        </div>
                     </div>
                  </div>
                  <script>
                     $("#{{$requisito->id}}").sortable({
                         connectWith: "connectedSortable",
                         forcePlaceholderSize: true,
                         opacity: 0.5
                     });
                  </script>
                  @endif @endforeach
               </div>
               <script>
                  $('#accordion1').on("sortreceive", function(event, ui) {
                      // console.log(ui);
                      drop(ui.item["0"].firstElementChild.id, 'Por hacer');
                  
                  });
               </script>
            </div>
         </div>
         <div class="col-md-4">
            <div class="col-md-12 box box-primary well-sm" id="columna2" style="background-color:{{$sprint->color2}}; color:{{$sprint->colorTexto2}};">
               <div class="box-header with-border">
                  <h3 class="box-title">@lang('messages.en tramite') 
                  </h3>
               </div>
               <div id="accordion2" class="@if ($modificar_requisito) connectedSortable @endif box-body">
                  @foreach ($requisitos as $requisito ) @if ($requisito->estado == 'En trámite')
                  <div class="panel box box-primary" style="border-top-width:7px; border-top-color:{{$requisito->color}}" id="modal{{$requisito->id}}" onclick="cambiarColor(modal{{$requisito->id}}.id)">
                     <div class="box-header with-border" id="{{$requisito->id}}">
                        <h4 class="box-title">
                           <a data-toggle="collapse" data-parent="#accordion2" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
                        </h4>
                        <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}"></i>
                     </div>
                     <div id="desplegar{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div style="color:#000" class="box-body">
                           {{$requisito->descripcion}}
                        </div>
                     </div>
                  </div>
                  <script>
                     $("#{{$requisito->id}}").sortable({
                         connectWith: "connectedSortable",
                         forcePlaceholderSize: true,
                         opacity: 0.5
                     });
                  </script>
                  @endif @endforeach
               </div>
               <script>
                  $('#accordion2').on("sortreceive", function(event, ui) {
                  
                      drop(ui.item["0"].firstElementChild.id, 'En trámite');
                  });
               </script>
            </div>
         </div>
         <div class="col-md-4">
            <div class="col-md-12 box box-primary well-sm" id="columna3" style="background-color:{{$sprint->color3}}; color:{{$sprint->colorTexto3}};">
               <div class="box-header with-border">
                  <h3 class="box-title">@lang('messages.hecho')
                  </h3>
               </div>
               <div id="accordion3" class="@if ($modificar_requisito) connectedSortable @endif box-body">
                  @foreach ($requisitos as $requisito ) @if ($requisito->estado == 'Hecho')
                  <div class="panel box box-primary" style="border-top-width:7px; border-top-color:{{$requisito->color}}" id="modal{{$requisito->id}}" onclick="cambiarColor(modal{{$requisito->id}}.id)">
                     <div class="box-header with-border" id="{{$requisito->id}}">
                        <h4 class="box-title">
                           <a data-toggle="collapse" data-parent="#accordion3" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
                        </h4>
                        <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}"></i>
                     </div>
                     <div id="desplegar{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div style="color:#000" class="box-body">
                           {{$requisito->descripcion}}
                        </div>
                     </div>
                  </div>
                  <script>
                     $("#{{$requisito->id}}").sortable({
                         connectWith: "connectedSortable",
                         forcePlaceholderSize: true,
                         opacity: 0.5
                     });
                  </script>
                  @endif @endforeach
               </div>
               <script>
                  $('#accordion3').on("sortreceive", function(event, ui) {
                      drop(ui.item["0"].firstElementChild.id, 'Hecho');
                  });
               </script>
               <!-- /.box-body -->
            </div>
         </div>
      </div>
      <!-- FORMULARIO CREACIÓN NUEVO REQUISITO -->
      <div class="modal fade" id="crearRequisito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form id="requisito_form" action="{{ url('requisito/create') }}" method="POST" role="form" data-toggle="validator">
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                  <div class="modal-header form-group has-feedback">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <label for="message-text" class="control-label">@lang('messages.tarea'):</label>
                     <input type="text" id="nombre" name="nombre" class="form-control" data-minlength="3" maxlength="20" required>
                  </div>
                  <div class="modal-body">
                     <div class="form-group has-feedback">
                        <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required></textarea>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="control-label">@lang('messages.P-S'):</label>
                        <br/>
                        <input type="hidden" name="sprint_id" value="{{$sprint->id }}" />
                        <select class="form-control" disabled>
                            <option>{{ $proyecto->nombre . ' - ' . $sprint->nombre }}</option>
                        </select>
                     </div>
                     <div class="form-group has-feedback">
                        <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>
                        <div class="form-group has-feedback">
                            <div class='input-group date has-feedback' id="datetimepicker6">
                                <input required name="fecha_estimada_fin" id="fecha_estimada_fin"  type='text' readonly class="form-control"  style="background-color: #fff; "/> <span class="input-group-addon">
                                    <span  id="datepicker_fecha_estimada_fin"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                       
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cerrar')</button>
                     <button type="submit" class="btn btn-primary">@lang('messages.guardar')</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- FIN FORMULARIO CREACIÓN NUEVO REQUISITO -->

      <!-- Modificar requisitos////////////////////////////// -->
      @foreach ($requisitos as $requisito )
      <div class="modal fade" id="exampleModal{{$requisito->
         id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form id="requisito_form_modificar" action="{{ url('requisito/modificar_public') }}" method="POST" role="form" data-toggle="validator">
                  <input type="hidden" name="sprint_id" value="{{$sprint->id }}" />
                  <input type="hidden" name="input_id" value="{{$requisito->id }}" />
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                  <input type="hidden" name="estado" value="{{$requisito->estado }}" />
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <label for="recipient-name" class="control-label">@lang('messages.nombre'):</label>
                     <div class="form-group has-feedback">
                        <input type="text" class="form-control modal-title" name="input_nombre" value="{{ $requisito->nombre }}"  data-minlength="3" maxlength="20" required>
                     </div>
                     <div class="modal-body" style="margin-bottom: 0px;">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="box box-default box-solid collapsed-box" style="background-color: #fff;">
                                 <div class="box-header with-border" style="background-color: #fff;">
                                    <h3 class="box-title">Log</h3>
                                    <div class="box-tools pull-right">
                                       <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                       </button>
                                    </div>
                                    <!-- /.box-tools -->
                                 </div>
                                 <!-- /.box-header -->
                                 <div class="box-body" style="display: none;">
                                    @foreach ($modificacions as $clave => $valor)
                                    @if ($clave == $requisito->id)
                                    @foreach ($valor as $modificacion)
                                    <p>{!! '-' . $modificacion['mensaje'] !!}<span class="pull-right">{{ $modificacion['dia_concreto'] }}</span></p>
                                    <hr>
                                    @endforeach
                                    @endif
                                    @endforeach
                                 </div>
                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="col-md-6" style="padding-left: 0%">
                                 <label for="message-text" class="control-label">@lang('messages.fecha estimada de inicio'):</label>
                                 <div class="input-group form-group has-feedback">
                                    <input type='text' class="form-control" id="fecha_inicio{{ $requisito->id }}" name="fecha_inicio"readonly value="{{ $requisito->fecha_inicio }}" disabled />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                 </div>
                              </div>
                              <div class="form-group col-md-6 has-feedback">
                                 <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>
                                 <div class="form-group has-feedback">
                                    <div class='input-group date has-feedback' id='fecha_fin_{{$requisito->id}}'>
                                       <input type='text' class="form-control" id='input_fecha_estimada_fin{{$requisito->id}}' name="input_fecha_estimada_fin" value="{{$requisito->fecha_fin_estimada}}" /> <span id="datepicker{{ $requisito->id }}"class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                        <div class="form-group has-feedback">
                           <textarea id="input_descripcion" name="input_descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required>{{ $requisito->descripcion }}</textarea>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="col-md-6" style="padding-left: 0%">
                                 <label for="message-text" class="control-label">Usuario asignado:</label>
                                 <select name="input_user" class="form-control">
                                    <option value="null">@lang('messages.selecciona nuevos usuarios')</option>
                                    @if (count($requisito->users) > 0)
                                    @foreach ($users as $userB)
                                    @if ($userB->id == $requisito->users[0]->id)
                                    <option value="{{ $userB->id }}" selected>{{ $userB->name . ' ' . $userB->apellidos }}</option>
                                    @else
                                    <option value="{{ $userB->id }}">{{ $userB->name . ' ' . $userB->apellidos }}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach ($users as $userB)
                                    <option value="{{ $userB->id }}">{{ $userB->name }}</option>
                                    @endforeach
                                    @endif
                                 </select>
                              </div>
                              <div class=" col-md-6 ">
                                 <label style="color:#000">@lang('messages.color de la tarjeta'):
                                 <div class="input-group my-colorpicker-{{$requisito->id}} colorpicker-element">
                                    <input type="text" name="input_color" id="input_color"  class="form-control" style="background-color: #fff;" />
                                    <div class="input-group-addon">
                                       <i style="background-color: rgb(130, 124, 124);"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        @if ($borrar_requisito)
                        <button id="confirmacion{{ $requisito->id }}" type="button" class="btn btn-danger pull-left">@lang('messages.eliminar')</button>
                        @endif
                        <button class="btn btn-default" data-dismiss="modal" aria-label="Close">@lang('messages.proyectos')</button>
                        @if ($modificar_requisito)
                        <button type="submit" class="btn btn-success">@lang('messages.modificar')</button>
                        @endif
                     </div>
                  </div>
                  <script>
                     $('#fecha_fin_{{$requisito->id}}').datetimepicker({
                         format: "DD/MM/YYYY"
                     });
                  </script>
            </div>
         </div>
         <script>
            $('.my-colorpicker-{{$requisito->id}}').colorpicker().on('changeColor', function(ev){
                var a=  ev.color.toHex();
              
               updateRequisitoColor(a, {{$requisito->id}});
            });
         </script>
         <script type="text/javascript">
            $('#ex-data-multiple-{{$requisito->id}}').picker();
            
            $('#ex-data-multiple-{{$requisito->id}}').on('sp-change', function() {
               
            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var array = [];
                for (var i = 0; i < $('#ex-data-multiple-{{$requisito->id}}')["0"].selectedOptions.length; i++) {
            
                    array.push($('#ex-data-multiple-{{$requisito->id}}')["0"].selectedOptions[i].value);
                }
            
                $.post("/requisitoUsuario", {
                    opciones: array,
                    id_requisito: "{{$requisito->id}}"
                });
            });
         </script>
      </div>
      </form>
   </div>
</div>
<script>
@foreach ($requisitos as $requisito)
    $('#datepicker{{ $requisito->id }}').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: $("#fecha_inicio{{ $requisito->id }}").val()
    })
    .on('changeDate', function(e) {
        // Set the value for the date input
        $("#input_fecha_estimada_fin{{ $requisito->id }}").val($("#datepicker{{ $requisito->id }}").datepicker('getFormattedDate'));

        // Revalidate it
        //$('#eventForm').formValidation('revalidateField', 'selectedDate');
    });

@endforeach
</script>
<script>
   $(".my-colorpicker-col").colorpicker();
   $("#confirmacion{{ $requisito->id }}").click(function() {
   
       swal({
           title: "¿Estás seguro?",
           text: "Vas a eliminar {{ $requisito->nombre}}.",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "Sí, adelante",
           cancelButtonText: "Cancelar",
           closeOnConfirm: false,
           allowOutsideClick: true
       },
       function(){
           window.location.href = "/requisito/borrar/{{ $requisito->id }}";            
       });
   });
   
</script>
@endforeach
<script>
   $(function() {
       $("#accordion1, #accordion2", "#accordion3").sortable({
           connectWith: "connectedSortable",
           opacity: 0.5
       }).disableSelection();
   });
</script>
<script>
   $('.my-colorpicker-col').colorpicker().on('changeColor', function(ev){
       var a=  ev.color.toHex();
       update(a, {{$sprint->id}});
   });
   $('.my-colorpicker-text').colorpicker().on('changeColor', function(ev){
       var a=  ev.color.toHex();
       updateTexto(a, {{$sprint->id}});
   });
</script>
<script>
$(document).ready(function(){
   setTimeout(function(){
         $('#event-modal').fadeOut(200);
   },1000);
});
</script>
 <script>
    $('#datepicker_fecha_estimada_fin').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
    startDate: $("#fecha_inicio_sprint").val()
    })
    .on('changeDate', function(e) {
        $("#fecha_estimada_fin").val($("#datepicker_fecha_estimada_fin").datepicker('getFormattedDate'));
    });
</script>
@endsection