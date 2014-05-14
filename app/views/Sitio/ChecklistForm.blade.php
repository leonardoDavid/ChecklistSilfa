@extends('main')

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
        <h1 class="center">Ingreso de Checklist</h1>
		<ul class="list-unstyled" id="need-data">
			<li><span class="icon-user"></span> <span class="text"> <strong>Usuario: </strong>	{{ Auth::user()->nombre." ".Auth::user()->ape_paterno; }}</span> </li>
			<li><span class="icon-flag"></span> <span class="text"> <strong>Area: </strong>	{{ $Area }} </span></li>
			<li><span class="icon-store"></span> <span class="text"> <strong>Tienda: </strong>	{{ $Tienda }} </span></li>
			<li><span class="icon-tack"></span> <span class="text"> <strong>Sucursal: </strong>	{{ $Sucursal }} </span></li>
		</ul>
		<form action="/ingresar/save" method="post">
			{{ $Form }}
		</form>
		<div class="center">
			<button class="btn btn-danger">Cancelar</button>
			<button class="btn btn-info">Enviar</button>
		</div>

        <!-- Modales -->
        <div class="modal fade" id="error-server">
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
        <div class="modal fade" id="error-client">
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
        <div class="modal fade" id="question-comment">
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
                        <textarea name="" class="text-comment" placeholder="Deja tu comentario con respecto a este item"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

		<div class="overlay-disabled"></div>
    </section>
@stop

@section('scripts')
    $('.comment').click(function(){
        $('#question-comment').modal();
    });
@stop