@extends('main')

@section('title')
	Reportes - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('contenido')
    <section class="container site">
		@if(Session::has('error-report'))
		<div class="row">
        	<div class="col-xs-12 col-md-12 alert alert-dismissable alert-danger">
	            <button type="button" class="close" data-dismiss="alert">×</button>
            	<strong>Woou! </strong> {{ Session::get('error-report') }}
        	</div>
        </div>
        @endif  
		<h1 class="title-page">Reportes</h1>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<span class="icon-menu show-menu"></span>
				<span class="icon-excel show-menu-left-second" id="export"></span>
				<span class="icon-question-circle show-menu-left" id="help"></span>
			</div>
		</div>	

		<div class="row filters center">
			<div class="col-xs-12">
				<span>Area</span>
				<span>Tienda</span>
				<span>Sucursal</span>
				<span>Supervisor</span>
			</div>
			<div class="col-xs-12">
				<select id="area" class="form-control">
					<option value="0">Todas</option>
					{{ $AreaOptions }}
				</select>

				<select id="tienda" class="form-control">
					<option value="0">Todas</option>
					{{ $LocalOptions }}
				</select>

				<select id="sucursal" class="form-control" disabled>
					<option value="0">Todas</option>
				</select>

				<select id="user" class="form-control">
					<option value="0">Todos</option>
					{{ $UserOptions }}
				</select>
			</div>
			<div class="col-xs-12 center space-bottom">
				<button class="btn btn-info btn-sm" id="filter">
					Filtrar
					<span class="icon-filter"></span>
				</button>
			</div>
		</div>

		<table class="table table-hover table-local">
		  	<thead>
			    <tr>
			      	<th>Area</th>
			      	<th>Tienda</th>
			      	<th>Sucursal</th>
			      	<th>Supervisor</th>
			      	<th>Fecha</th>
		    	</tr>
		  	</thead>
		  	<tbody>
		  		{{ $checklists }}
		  	</tbody>
		</table>

		<div class="row center">
			{{ $links }}
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
                        <p>
                        	Con los filtros que se encuentran en el encabezado puede seleccionar de manera detallada los checklist que desea ver, una vez seleccionados puede exportar la lista resultante, o seleccionar un checklist especifico y ver los detalles del seleccionado.
                        </p>
                        <p>
                        	Todo es exportable a excel, y los documentos se envian al correo que tiene registrado dentro del sistema.
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
        <div class="modal fade" id="type-report" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        	Que datos desea exportar?
                        </p>
                    </div>
                    <div class="modal-footer">
                    	<button class="btn btn-primary btn-sm" id="all-export">Todo el Reporte</button>
                    	<button class="btn btn-primary btn-sm" id="only-page">Solo esta Página</button>
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
		$('#sucursal').html('<option value="0">Todas</option>');
		$('#sucursal').attr('disabled', true);
		if($('#tienda').val() != '0'){
			$('.loading-box').text('Cargando ...');
			$('.loading-box').fadeIn();
			$.ajax({
	            type: 'post',
	            url: '/ingresar/tienda',
	            data: {	tienda:$('#tienda').val() },
	            success: function (response){
	            	log = response;
	            	$('.loading-box').fadeOut();
	                if(response['status']){
	                	$('#sucursal').html('<option value="0">Todas</option>');
	                	$('#sucursal').append(response['html']);
						$('#sucursal').attr('disabled', false);
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

	$('#export').click(function(event) {
		if($('ul.pagination').length > 0){
			$('#type-report').modal();
		}
		else{
			exportOnlyThisPage();
		}
	});

	$('#all-export').click(function(){
		$('#type-report').modal('hide');
		var filters = {
			'area' : $('#area').val(),
			'tienda' : $('#tienda').val(),
			'sucursal' : $('#sucursal').val(),
			'user' : $('#user').val()
		};
		$('.loading-box').text('Exportando ...');
		$('.loading-box').fadeIn();
		$.ajax({
            type: 'post',
            url: '/reportes/exportar/filters',
            data: filters,
            success: function (response){
            	$('.loading-box').fadeOut();
                if(response['status']){
                	$('.loading-box').html('<span class="icon-check"><span> Enviado');
                    setTimeout(function() {
                        $('.loading-box').fadeOut();
                    }, 3000);
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
	});

	$('#only-page').click(function(){
		$('#type-report').modal('hide');
		exportOnlyThisPage();
	});

	$('tr').click(function(){
		window.location = $(this).data('location');
	});

	$('#filter').click(function(event) {
		var filters = {
			'area' : $('#area').val(),
			'tienda' : $('#tienda').val(),
			'sucursal' : $('#sucursal').val(),
			'user' : $('#user').val()
		};
		var url = "/reportes"
		$.redirectWithPost(url, filters);
	});

	function exportOnlyThisPage(){
		var data = new Array();
		$('tbody tr').each(function(index, el) {
			log = this;
			data[index] = {
				'area' : $($(this).children()[0]).data('area'),
				'tienda' : $($(this).children()[1]).data('tienda'),
				'sucursal' : $($(this).children()[2]).data('sucursal'),
				'supervisor' : $($(this).children()[3]).data('user'),
				'fecha' : $($(this).children()[4]).data('fecha'),
				'ruta' : $(this).data('location')
			};
		});
		$('.loading-box').text('Exportando ...');
		$('.loading-box').fadeIn();
		$.ajax({
            type: 'post',
            url: '/reportes/exportar/lista',
            data: {	'datos' : data },
            success: function (response){
            	$('.loading-box').fadeOut();
                if(response['status']){
                	$('.loading-box').html('<span class="icon-check"><span> Enviado');
                    setTimeout(function() {
                        $('.loading-box').fadeOut();
                    }, 3000);
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

	@if (Session::has('error-report'))
		setTimeout(function() {
            $('.alert').slideUp();
        }, 3000);
	@endif
@stop