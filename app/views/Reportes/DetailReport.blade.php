@extends('main')

@section('title')
	Detalle de Checklist - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('contenido')
    <section class="container site">
		<h1 class="title-page">Detalle del Checklist</h1>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<span class="icon-menu show-menu"></span>
				<span class="icon-excel show-menu-left" id="export"></span>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<ul class="list-unstyled">
					<li><span><strong>ID Checklist: </strong>#{{ $IDReport }}</span></li>
					<li><span><strong>Fecha de Ingreso: </strong>{{ $fechaIngreso }}</span></li>
					<li><span><strong>Hora de Ingreso: </strong>{{ $horaIngreso }}</span></li>
					<li><span><strong>Evaluador: </strong>{{ $evaluador }}</span></li>
					<li><span><strong>Área: </strong>{{ $area }}</span></li>
					<li><span><strong>Tienda: </strong>{{ $tienda }}</span></li>
					<li><span><strong>Sucursal: </strong>{{ $sucursal }}</span></li>
				</ul>	
				<div class="calificate">
					<span class="icon-certificate icon-back"></span>
					<span class="icon-certificate"></span>
					<span class="icon-bookmark"></span>
					<span class="text" id="porcent">{{ $Porcent }}%</span>
				</div>
			</div>
		</div>
		{{ $Form }}
        <h3>Comentario Final</h3>
		<textarea id="comment.final" class="form-control comment-final" disabled>{{ $comentario }}</textarea>

        <!-- Modales -->
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
        <div class="modal fade" id="question-comment" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <blockquote>
						  	<p id="text-comment">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
						  	<small>{{ $evaluador }}</small>
						</blockquote>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
	$('.has-comment').click(function(event) {
		var comment = $('#'+$(this).data('question')).data('comment');
		$('#text-comment').text(comment);
		$('#question-comment').modal();
	});

    $('#export').click(function(){
        $('.loading-box').text('Exportando ...');
        $('.loading-box').fadeIn();
        var id = location.pathname.split('/');
        id = id[2];
        $.ajax({
            type: 'post',
            url: '/reportes/exportar/id/'+id,
            success: function (response){
                log = response;
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
                    $('.loading-box').fadeOut();
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
@stop