@extends('main')

@section('special-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('title')
	Checklist - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('contenido')
    <section class="container site">
		
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<span class="icon-menu show-menu"></span>
				<div class="progress">
  					<div class="progress-bar progress-bar-danger" style="width: 0%">
  						<span class="porcent">0%</span>
  					</div>
				</div>
			</div>
		</div>
        <h1 class="title-page">Ingreso de Checklist</h1>
		<ul class="list-unstyled" id="need-data">
			<li><span class="icon-user"></span> <span class="text"> <strong>Usuario: </strong>	{{ Auth::user()->nombre." ".Auth::user()->ape_paterno; }}</span> </li>
			<li><span class="icon-flag"></span> <span class="text" id="area" data-id="{{ $AreaID }}"> <strong>Area: </strong>	{{ $Area }} </span></li>
			<li><span class="icon-store"></span> <span class="text" id="tienda" data-id="{{ $TiendaID }}"> <strong>Tienda: </strong>	{{ $Tienda }} </span></li>
			<li><span class="icon-tack"></span> <span class="text" id="sucursal" data-id="{{ $SucursalID }}"> <strong>Sucursal: </strong>	{{ $Sucursal }} </span></li>
		</ul>
		<form action="/ingresar/save" method="post">
			{{ $Form }}
            <textarea name="final-comment" id="final-comment" class="form-control comment-final" placeholder="Algun resumen general de tu visita?"></textarea>
		</form>
		<div class="center">
			<button class="btn btn-danger" id="cancel-checklist">Cancelar</button>
			<button class="btn btn-info" id="save-checklist">Enviar</button>
		</div>

        <!-- Modales -->
        <div class="modal fade" id="error-server" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        	<strong>Woou!</strong> Ha ocurrido un error mientras se realizaba la petición, los detalles del error son:
                        	<ul>
                        		<li>Motivo: <span id="error-motivo"></span></li>
                        		<li>Codigo: <span id="error-codigo"></span></li>
                        	</ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="error-client" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        	<strong>Woou!</strong> Esto es extraño, pero no reconocemos un valor para los siguientes campos:
                        	<ul id="unfields"></ul>
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
                        <p>
                            Ingrese un comentario para este item.
                        </p>
                        <textarea id="text-comment" class="text-comment" placeholder="Deja tu comentario con respecto a este item"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save-comment">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="sure" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Realmente desea no enviar este checklist ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="cancel-sure">Aceptar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="not-complete" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checklist Silfa</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Woou! </strong> Aún no completas un 70% minimo de aprovación, esto puede repercutir en tu evaluación de desemeño final
                            , ¿Realmente deseas enviar el checklist?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="send-complete">Si, enviar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">NO! CANCELAR!! :(</button>
                    </div>
                </div>
            </div>
        </div>

		<div class="overlay-disabled"></div>
    </section>
@stop

@section('scripts')
    var tmp_id;
    var total = {{ $Total }};
    var space = Math.round(100/total);

    $("input[type=checkbox]").on("click",refreshPorcent);
    $('input[type="text"]').keyup(refreshPorcent);

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function refreshPorcent(){
        tmp = $("input:checked").length;
        $("input[type='text']").each(function(index, el) {
            if($(this).val().trim() != "")
                tmp++;
        });
        space = (Math.round(100/total)+1)*tmp;
        if(space > 100)
            space = 100;
        $('.progress-bar').css('width',space+'%');
        $('.porcent').text(space+'%');
        if(space >= 70){
            $('.progress-bar').removeClass('progress-bar-danger');
            $('.progress-bar').addClass('progress-bar-success');
        }
        else{
            $('.progress-bar').addClass('progress-bar-danger');
            $('.progress-bar').removeClass('progress-bar-success');
        }
    }

    function sendData(){
        $('.overlay-loading').fadeIn();
        var answers = new Array();
        var valor;
        $('.question-container').each(function(index, el) {
            tmp = new Object();
            tmp.id = $(this).attr('id');
            tmp.comment = $(this).data('comment');
            if ($(this).data('type') == "checkbox"){
                valor = 0;
                var status = $('#'+$(this).attr("id")+' .question-check-container input[type="checkbox"]:checked').val();
                if(status == 'on')
                    valor = 1;
            }
            else if($(this).data('type') == "text"){
                valor = $('#'+$(this).attr("id")+' .question-input-container input[type="text"]').val();
            }  
            tmp.valor = valor;

            answers.push(tmp);
        });
        $.ajax({
            url: '/ingresar/save-checklist',
            type: 'post',
            data: { 
                'valores' : answers , 
                'final-comment' : $('#final-comment').val(),
                'area' : $('#area').data('id'),
                'sucursal' : $('#sucursal').data('id'),
                'tienda' : $('#tienda').data('id')
            },
            success : function(response){
                log = response;
                response = JSON.parse(response);
                if(!response['status']){
                    $('#error-motivo').text(response['motivo']);
                    $('#error-codigo').text(response['codigo']);
                    $('.overlay-loading').fadeOut('fast', function() {
                        $('#error-server').modal();                        
                    });
                }
                else
                    window.location = "/ingresar";
            },
            error : function(xhr){
                log = xhr;
                if(xhr.status == 500 || xhr.status == 404 || xhr.status == 403)
                    $('#error-motivo').text('Error del servidor :( , no te preocupes, es nuestra culpa y lo arreglaremos en breves.');
                else if(xhr.status == 404)
                    $('#error-motivo').text('Error de conexión');
                $('#error-codigo').text(xhr.status);
                $('.overlay-loading').fadeOut('fast', function() {
                    $('#error-server').modal();
                });
            }
        });        
    }

    $('.comment').click(function(){
        if($('#'+$(this).data('question')).data('comment') != "")
            $('#text-comment').val($('#'+$(this).data('question')).data('comment'));
        else{
            $('#text-comment').val('');
            $('#text-comment').text('');
        }
        $('#question-comment').modal();
        tmp_id = $(this).data('question');
    });

    $('#save-comment').click(function(){
        $('#'+tmp_id).data('comment',$('#text-comment').val());
        $('#question-comment').modal('hide');
    });

    $('#cancel-checklist').click(function(){
        $('#sure').modal();
    });

    $('#send-complete').click(function(){
        $('#not-complete').modal('hide');
        sendData();
    });

    $('#cancel-sure').click(function(){
        window.location = '/ingresar';
    });

    $('#save-checklist').click(function(){
        var complete = $('.porcent').text();
        var porcent = complete.substring(0,complete.length - 1);
        if(porcent < 70){
            $('#not-complete').modal();
        }
        else{
            sendData();
        }
    });
@stop