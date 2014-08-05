@extends('main')

@section('title')
	Administración - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('styles')
	<link rel="stylesheet" href="/css/plugins/icheck/line/black.css">
    <link rel="stylesheet" href="/css/plugins/icheck/line/grey.css">
    <link rel="stylesheet" href="/css/plugins/icheck/flat/grey.css">
	<link rel="stylesheet" href="/css/plugins/dataTables.bootstrap.min.css">
@stop

@section('contenido')
    <section class="container site">		
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<span class="icon-menu show-menu"></span>
			</div>
		</div>
        @if (Session::has('error_request'))
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Woou! </strong> {{ Session::get('error_request') }}
            </div>
        </div>
        @elseif(Session::has('success_request'))
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Yeah! </strong> {{ Session::get('success_request') }}
            </div>
        </div>
        @elseif(Session::has('warning_request'))
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Atencion! </strong> {{ Session::get('warning_request') }}
            </div>
        </div>
        @endif
		<h1 class="title-page">Administración</h1>
        <div class="row">
        	<div class="col-xs-12 col-md-7">
        		<div class="panel panel-default">
        		  	<div class="panel-heading">
	        		    <h3 class="panel-title">
	        		    	<span class="icon-user"></span>
	        		    	Agregar Usuario
	        		    </h3>
	        		    <button class="btn btn-default btn-xs btn-head" data-toggle="collapse" data-target="#addUser">
							<span class="icon-up" data-collapse-target="addUser"></span>
						</button>
        		  	</div>
        			{{ Form::open(array('method' => 'post' , 'url' => '/admin/users/add')) }}
        		  	<div id="addUser" class="panel-collapse collapse in">
	        		  	<div class="panel-body collapse in">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 alert alert-dismissable alert-warning alert-in-panel">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Recurde! </strong>
                                    <ul>
                                        <li>La contraseña debe tener al menos 6 caracteres</li>
                                        <li>El nombre y el apellido deben tener al menos 3 caracteres</li>
                                    </ul>                                    
                                </div>
                            </div>
	        		  		<div class="input-group">
			                    <span class="input-group-addon"><span class="icon-email"></span></span>
			                    <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electronico" data-requiered="1">
			                </div>
			                <div class="input-group">
			                    <span class="input-group-addon"><span class="icon-lock"></span></span>
			                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" data-requiered="1">
			                </div>
		        		    <div class="input-group">
                                <span class="input-group-addon"><span class="icon-user"></span></span>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nombres" data-requiered="1">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="icon-user"></span></span>
                                <input type="text" id="paterno" name="paterno" class="form-control" placeholder="Apellido Paterno" data-requiered="1">
                            </div>
                            <div class="row">
                            	<div class="col-xs-12 col-md-12">
                            		<h4>Permisos del Usuario</h4>
                            	</div>
                            	<div class="col-xs-12 col-md-12">
                    		        <input type="checkbox" class="icheck-input" name="dashboard">
                    				<div>
                    					<h4 class="list-group-item-heading">Dashboard</h4>
                    		    		<p class="list-group-item-text">Acceso directo a estadisticas y graficos del Sistema de Checklist</p>
                    				</div>
                    				<input type="checkbox" class="icheck-input" name="ingresar">
                    				<div>
                    					<h4 class="list-group-item-heading">Ingresar</h4>
                    		    		<p class="list-group-item-text">Este permiso otorga privilegios al usuario para poder hacer ingreso de checklist en el Sistema</p>
                    				</div>
                    				<input type="checkbox" class="icheck-input" name="reportes">
                    				<div>
                    					<h4 class="list-group-item-heading">Reportes</h4>
                    		    		<p class="list-group-item-text">En esta sección el usuario podra generar reportes de todos los checklist ingresados en el sistema</p>
                    				</div>
                    				<input type="checkbox" class="icheck-input" name="lista">
                    				<div>
                    					<h4 class="list-group-item-heading">Lista de Reportes</h4>
                    		    		<p class="list-group-item-text">Otorgando este permiso el usuario tendra acceso a ver y descargar todos los reportes que se han generado en la plataforma.</p>
                    				</div>
                    				<input type="checkbox" class="icheck-input" name="admin">
                    				<div>
                    					<h4 class="list-group-item-heading">Administración</h4>
                    		    		<p class="list-group-item-text">Con esto el usuario podra realizar opciones como agregar usuarios, gestionarlos o dejar la aplicación en un modo de mantención</p>
                    				</div>
                            	</div>
                            </div>
	        		  	</div>
	        		  	<div class="panel-footer clearfix">
	        		  		<button id="addUserButton" class="btn btn-default pull-right">Agregar <span class="icon-right"></span></button>
	        		  	</div>
	        		</div>
        			{{ Form::close() }}
        		</div>
        	</div>
            <div class="col-xs-12 col-md-5">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="panel panel-default">
                            <div class="overlay" data-autohide="1" id="over-edit"></div>
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="icon-tack"></span>
                                    Edicion de Usuarios
                                </h3>
                                <button class="btn btn-default btn-xs btn-head" data-toggle="collapse" data-target="#editUsers">
                                    <span class="icon-up" data-collapse-target="editUsers"></span>
                                </button>
                                <button class="btn btn-default btn-xs btn-head" id="refresh">
                                    <span class="icon-refresh"></span>
                                </button>
                            </div>
                            <div id="editUsers" class="panel-collapse collapse in">
                                <div class="panel-body collapse in">
                    				<table id="employes" class="table table-bordered table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Email</th>
                                                <th>Estado</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @foreach($empleadosListTable as $employed)
                                            <tr>
                                                <td>{{ ucwords($employed->nombre) }}</td>
                                                <td>{{ ucwords($employed->ape_paterno)." ".ucwords($employed->ape_materno) }}</td>
                                                <td>{{ $employed->email }}</td>
                                                @if($employed->active == 1)
                                                    <td>Activo</td>
                                                @else
                                                    <td>Deshabilitado</td>
                                                @endif
                                                <td>
                                                    <input type="checkbox" class="flat-grey" name="employedIdOperating" value="{{ $employed->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer clearfix">
                                    <p class="pull-left">
                                        A los marcados
                                    </p>
                                    <button class="btn btn-default btn-sm pull-right"><span class="icon-wrong"></span> Deshabilitar</button>
                                    <button class="btn btn-default btn-sm pull-right"><span class="icon-check"></span> Habilitar</button>
                                    <button class="btn btn-default btn-sm pull-right"><span class="icon-search"></span> Editar</button>
                                </div>
                            </div>
                        </div>
        			</div>
                    <div class="col-xs-12 col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="icon-gear"></span>
                                    Herramientas
                                </h3>
                                <button class="btn btn-default btn-xs btn-head" data-toggle="collapse" data-target="#utilities">
                                    <span class="icon-up" data-collapse-target="utilities"></span>
                                </button>
                            </div>
                            <div id="utilities" class="panel-collapse collapse in">
                                <div class="panel-body collapse in">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 space-bottom">
                                            <button id="masiveLoad" class="btn btn-primary btn-sm col-xs-12 col-sm-4 col-md-6">Carga Masiva <span class="icon-excel"></span></button>
                                            <button id="exportUsers" class="btn btn-primary btn-sm col-xs-12 col-sm-4 col-md-6">Exportar Usuarios <span class="icon-group"></span></button>                    
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <span>Modo Mantención</span> 
                                    <div class="question-check-container">
                                        <div class="question-check">
                                            <input type="checkbox" name="question-check" class="question-check-checkbox" id="status">
                                            <label class="question-check-label" for="status">
                                                <div class="question-check-inner"></div>
                                                <div class="question-check-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </section>

    <div class="modal fade" id="edit-users" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edición de Usuarios - Checklist Silfa</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="icon-user"></span>
                                    Agregar Usuario
                                </h3>
                                <button class="btn btn-default btn-xs btn-head" data-toggle="collapse" data-target="#addUser">
                                    <span class="icon-up" data-collapse-target="addUser"></span>
                                </button>
                            </div>
                            {{ Form::open(array('method' => 'post' , 'url' => '/admin/adduser')) }}
                            <div id="addUser" class="panel-collapse collapse in">
                                <div class="panel-body collapse in">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 alert alert-dismissable alert-warning alert-in-panel">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Recurde! </strong>
                                            <ul>
                                                <li>La contraseña debe tener al menos 6 caracteres</li>
                                                <li>El nombre y el apellido deben tener al menos 3 caracteres</li>
                                            </ul>                                    
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="icon-email"></span></span>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electronico" data-requiered="1">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="icon-lock"></span></span>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" data-requiered="1">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="icon-user"></span></span>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombres" data-requiered="1">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="icon-user"></span></span>
                                        <input type="text" id="paterno" name="paterno" class="form-control" placeholder="Apellido Paterno" data-requiered="1">
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h4>Permisos del Usuario</h4>
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <input type="checkbox" class="icheck-input" name="dashboard">
                                            <div>
                                                <h4 class="list-group-item-heading">Dashboard</h4>
                                                <p class="list-group-item-text">Acceso directo a estadisticas y graficos del Sistema de Checklist</p>
                                            </div>
                                            <input type="checkbox" class="icheck-input" name="ingresar">
                                            <div>
                                                <h4 class="list-group-item-heading">Ingresar</h4>
                                                <p class="list-group-item-text">Este permiso otorga privilegios al usuario para poder hacer ingreso de checklist en el Sistema</p>
                                            </div>
                                            <input type="checkbox" class="icheck-input" name="reportes">
                                            <div>
                                                <h4 class="list-group-item-heading">Reportes</h4>
                                                <p class="list-group-item-text">En esta sección el usuario podra generar reportes de todos los checklist ingresados en el sistema</p>
                                            </div>
                                            <input type="checkbox" class="icheck-input" name="lista">
                                            <div>
                                                <h4 class="list-group-item-heading">Lista de Reportes</h4>
                                                <p class="list-group-item-text">Otorgando este permiso el usuario tendra acceso a ver y descargar todos los reportes que se han generado en la plataforma.</p>
                                            </div>
                                            <input type="checkbox" class="icheck-input" name="admin">
                                            <div>
                                                <h4 class="list-group-item-heading">Administración</h4>
                                                <p class="list-group-item-text">Con esto el usuario podra realizar opciones como agregar usuarios, gestionarlos o dejar la aplicación en un modo de mantención</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer clearfix">
                                    <button id="addUserButton" class="btn btn-default pull-right">Agregar <span class="icon-right"></span></button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-sm" id="next-edit">Siguiente</button>
                    <button class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('libjs')
    <script src="/js/plugins/icheck.min.js"></script>
	<script src="/js/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap.js"></script>
@stop

@section('scripts')
    var notSend = true;
    var tableDataEmployes;

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('*[data-autohide="1"]').hide();
        tableDataEmployes = $("#employes").DataTable({
            "oLanguage": {
                "sEmptyTable": "Sin Datos",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sLoadingRecords": "Cargando...",
                "sProcessing": "Procesando...",
                "sSearch": "Buscar:",
                "sSearchPlaceholder": "Search...",
                "sZeroRecords": "No se encontraron coincidencias",
                "oPaginate": {
                    "sFirst": "Primera",
                    "sLast": "Última",
                    "sNext": "",
                    "sPrevious": "",
                },
                "sLengthMenu": 'Mostrar <select class="form-control">'+
                    '<option value="5">5</option>'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="-1">Todos</option>'+
                    '</select>'+' regsitros'
            }
        });
    });

	$('input.icheck-input').each(function(){
    	var self = $(this),
      	label = self.next(),
      	label_text = label.text();
    	log = label;
    	label.remove();
    	self.iCheck({
      		checkboxClass: 'icheckbox_line-grey',
      		radioClass: 'iradio_line-grey',
      		insert: '<div class="icheck_line-icon"></div>' + $(log).html()
    	});
  	});

    $('input.flat-grey').each(function(){
        $(this).iCheck({
            checkboxClass: 'icheckbox_flat-grey'
        });
    });

  	$('input.icheck-input').on('ifChecked',function(){
		$(this).parent().removeClass('icheckbox_line-grey');
		$(this).parent().addClass('icheckbox_line-black');
  	});

  	$('input.icheck-input').on('ifUnchecked',function(){
		$(this).parent().removeClass('icheckbox_line-black');
		$(this).parent().addClass('icheckbox_line-grey');
  	});

  	$('#addUser').on('hidden.bs.collapse',function(){
		$('span[data-collapse-target="addUser"]').removeClass('icon-up');
		$('span[data-collapse-target="addUser"]').addClass('icon-down');
	});

	$('#addUser').on('shown.bs.collapse',function(){
		$('span[data-collapse-target="addUser"]').addClass('icon-up');
		$('span[data-collapse-target="addUser"]').removeClass('icon-down');
	});

    $('form').submit(function(event){
        $('#addUserButton').attr('disabled',true);
        if(notSend){
            event.preventDefault();
            if(validate()){
                notSend = false;
                $('form').submit();
            }
            else
                $('#addUserButton').attr('disabled',false);
        }
    });

    $('*[data-requiered="1"]').focus(function(event){
        $(this).parent().removeClass('has-error');
    });

    $('#exportUsers').click(function(){
    	$('#exportUsers').attr('disabled',true);
    	$('.loading-box').html('Enviando ...');
    	$('.loading-box').fadeIn();
    	$.ajax({
    		url: '/reportes/exportar/users',
    		type: 'post',
    		success : function(response){
    			//var response = JSON.parse(data);
    			if(response['status']){
    				$('.loading-box').html('<span class="icon-check"><span> Enviado');
    				$('#exportUsers').attr('disabled',false);
	    			setTimeout(function() {
	    			    $('.loading-box').fadeOut();
	    			}, 3000);
	    		}
    			else{
    				$('#error-motivo').html(response['motivo']);
                    $('#error-codigo').text((response['codigo']) ? response['codigo'] : 501);
                    $('.loading-box').fadeOut('fast', function() {
	                    $('#error-server').modal();
	                	$('#exportUsers').attr('disabled',false);
	                });
    			}
    		},
    		error : function(xhr){
    			if(xhr.status == 500 || xhr.status == 404 || xhr.status == 403)
                    $('#error-motivo').text('Error del servidor :( , no te preocupes, es nuestra culpa y lo arreglaremos en breves.');
                $('#error-codigo').text(xhr.status);
                $('.loading-box').fadeOut('fast', function() {
                    $('#error-server').modal();
                	$('#exportUsers').attr('disabled',false);
                });
    		}
    	});    	
    });

    $('#refresh').click(function(event){
        refreshTable();
    });

    function validate(){
        var hasError = true;
        $('*[data-requiered="1"]').each(function(index, el){
            if( ($(this).attr('id') == "password" &&  $(this).val().length < 6 ) ){
                $(this).parent().addClass('has-error');
                hasError = false;
            }
            if( ($(this).attr('name') == "password" &&  $(this).val().length < 6 ) ){
                hasError = false;
            }
            else if($(this).val() == "" || $(this).val() == "0"){
                $(this).parent().addClass('has-error');
                hasError = false;
            }
        });

        return hasError;
    }

    function refreshTable(){
        tableDataEmployes._fnClearTable();
        $.ajax({
            url: '/admin/users/refresh',
            type: 'post',
            beforeSend : function(){
                tableDataEmployes._fnClearTable();
                $('#over-edit').show();
            },
            success : function(response){
                $.each(response, function(index, val) {
                    var tmp = new Array();
                    tmp.push(response[index]['name']);
                    tmp.push(response[index]['lastname']);
                    tmp.push(response[index]['email']);
                    tmp.push(response[index]['active']);
                    tmp.push(response[index]['checkbox']);
                    tableDataEmployes._fnAddData(tmp);
                    tableDataEmployes._fnReDraw();
                });
                $('#over-edit').fadeOut();
                trackSelected();
            },
            error : function(xhr){
                $('#msj-error').text('Error de conexión al momento de recuperar los datos, intentelo más tarde.');
                $('#over-edit').fadeOut();
                $('#error-server').modal();
            }
        });  
        tableDataEmployes._fnReDraw();    
    }

    function trackSelected(){
        $('input[type="checkbox"].flat-gray, input[type="radio"].flat-gray').iCheck({
            checkboxClass: 'icheckbox_flat-gray',
            radioClass: 'iradio_flat-gray'
        });
        $('input[type="checkbox"].flat-gray').attr('checked',false);
        values = [];
        $('input[type="checkbox"].flat-gray').on('ifChecked', function(event){
            values.push($(this).val());
        });
        $('input[type="checkbox"].flat-gray').on('ifUnchecked', function(event){
            values.pop($(this).val());
        });        
    }

    @if (Session::has('error_request') || Session::has('success_request'))
        setTimeout(function() {
            $('.alert').slideUp();
        }, 5000);
    @endif
    @if(Session::has('error_mensajes'))
        $('#unfields').html("{{ Session::get('error_mensajes') }}");
        $('#error-client').modal();
    @endif
@stop