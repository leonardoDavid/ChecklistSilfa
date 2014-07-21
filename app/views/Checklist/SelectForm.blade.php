@extends('main')

@section('title')
	Checklist - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('contenido')
    <section class="container site">
		
		@if(Session::has('save_success'))
		<div class="row">
        	<div class="col-xs-12 col-md-12 alert alert-dismissable alert-success">
	            <button type="button" class="close" data-dismiss="alert">×</button>
	            <?php $val = Session::get('save_success') ?>
            	<strong>Yeah! </strong> {{ $val[0] }}
        	</div>
        </div>
        @endif        
		
		<h1 class="title-page">Ingreso de Checklist</h1>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<span class="icon-menu show-menu"></span>
				<span class="icon-question-circle show-menu-left" id="help"></span>
			</div>
		</div>

		<form action="/ingresar" method="post" id="select-checklist">
			<div class="container-input">
				<label for="area" class="col-xs-12 label-control">Area</label>
				<select name="area" id="area" class="form-control">
					<option value="0">Seleccione un Area</option>
					{{ $Areas }}
				</select>
			</div>

			<div class="container-input">
				<label for="tienda" class="col-xs-12 label-control">Tienda</label>
				<select name="tienda" id="tienda" class="form-control">
					<option value="0">Seleccione una Tienda</option>
					{{ $Tiendas }}
				</select>
			</div>

			<div class="container-input">
				<label for="sucursal" class="col-xs-12 label-control">Sucursal</label>
				<select name="sucursal" id="sucursal" class="form-control" disabled>
					<option value="0">Seleccione una Sucursal</option>
					
				</select>
			</div>
		</form>

		<div class="center">
			<button class="btn btn-primary" id="begin" disabled>¡Empezar!</button>
		</div>

        <!-- Modales -->
        <div class="modal fade" id="how-work">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">¿Cómo funciona? - Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <h4>¡Es muy facil!</h4>
                        <p>
                        	Solo debe seleccionar los datos que se presentan, indique que area desea evaluar, en que tienda y en que sucursal de dicha tienda se va realizar el checklist.
                        </p>
                        <p>
                        	Una vez seleccionado los campos, presione en el boton <cite>Empezar</cite> y cargara automaticamente el formulario correspondiente al area que selecciono.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="error-valid" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        	<strong>Woou!</strong> Esto es extraño, pero encontramos los siguientes errores:
                        	<ul id="unfields-valid"></ul>
                        </p>
                        <p>
                        	Te recomendamos revisar estos campos, si estan seteados por favor envianos un feed/reclamo, puedes realizar la acción desde el menu.
                        </p>
                    </div>
                </div>
            </div>
        </div>

		<div class="overlay-disabled"></div>
    </section>
@stop

@section('scripts')
	$('#help').click(function(){
		$('#how-work').modal();
	});
	$('#tienda').change(function(event) {
		$('#sucursal').html('<option value="0">Seleccione una Sucursal</option>');
		$('#begin').attr('disabled', true);
		$('#sucursal').attr('disabled', true);
		if($('#tienda').val() != '0'){
			$('.loading-box').text('Cargando ...');
			$('.loading-box').fadeIn();
			$.ajax({
	            type: 'post',
	            url: '/ingresar/tienda',
	            data: {	tienda:$('#tienda').val() },
	            success: function (response) {
	            	log = response;
	            	$('.loading-box').fadeOut();
	                if(response['status']){
	                	$('#sucursal').html('<option value="0">Seleccione una Sucursal</option>');
	                	$('#sucursal').append(response['html']);
						$('#sucursal').attr('disabled', false);
						$('#begin').attr('disabled', false);
	                }
	                else{
	                	$('#error-motivo').text(response['motivo']);
	                	$('#error-codigo').text(response['codigo']);
	                	$('#error-server').modal();
	                }
	            },
	            error: function(xhr,errors){
	            	log = xhr;
	            	$('.loading-box').fadeOut();
	            	if(xhr.status == 500 || xhr.status == 404 || xhr.status == 403)
	                	$('#error-motivo').text('Error del servidor :( , no te preocupes, es nuestra culpa y lo arreglaremos en breves.');
	                else if(xhr.status == 404)
	                	$('#error-motivo').text('Error del servidor :(');
	                $('#error-codigo').text(xhr.status);
	                $('#error-server').modal();
	            }
	        });
	    }
	});
	$('#sucursal').change(function(event) {
		if($(this).val() > 0){
			$('#begin').attr('disabled', false);
		}
		else{
			$('#begin').attr('disabled', true);
		}
	});
	$('#begin').click(function(event) {
		var status = true;
		var msj = "";
		if($('#area').val() == 0){
			msj = msj + "<li>Area</li>"
			status = false;			
		}
		if($('#tienda').val() == 0){
			msj = msj + "<li>Tienda</li>"
			status = false;			
		}
		if($('#sucursal').val() == 0){
			msj = msj + "<li>Sucursal</li>"
			status = false;
		}
		if(status){
			$('#select-checklist').submit();
		}
		else{
			$('#unfields').html(msj);
			$('#error-client').modal();
		}
	});
	@if (Session::has('resquest_error'))
		(function(){
			var errors = {{ Session::get('resquest_error') }};
			var msj_errors = "";
			for(var x = 0;x < errors.length; x++){
				msj_errors = msj_errors + "<li>"+errors[x]+"</li>";
			}
			$('#unfields-valid').html(msj_errors);
			$('#error-valid').modal();
		})();
	@endif
	@if (Session::has('save_success'))
		setTimeout(function() {
            $('.alert').slideUp();
        }, 3000);
        <?php Session::forget('save_success', '0'); ?>
	@endif
@stop