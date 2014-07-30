@extends('main')

@section('title')
	Administración - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('styles')
	<link rel="stylesheet" href="/css/icheck/line/black.css">
	<link rel="stylesheet" href="/css/icheck/line/grey.css">
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
					<div class="col-xs-12 col-md-12 space-bottom">
						<button class="btn btn-primary btn-sm col-xs-12 col-sm-4 col-md-4">Carga Masiva <span class="icon-excel"></span></button>
						<button class="btn btn-primary btn-sm col-xs-12 col-sm-4 col-md-4">Exportar Usuarios <span class="icon-group"></span></button>
						<button class="btn btn-primary btn-sm col-xs-12 col-sm-4 col-md-4">Editar Usuarios <span class="icon-tack"></span></button>						
					</div>
					<div class="col-xs-12 col-md-12 well text-center">
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
    </section>
@stop

@section('libjs')
	<script src="/js/icheck.min.js"></script>
@stop

@section('scripts')
    var notSend = true;

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