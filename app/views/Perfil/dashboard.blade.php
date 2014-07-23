@extends('main')

@section('title')
	Mi Perfil - Sistema de Checklist
@stop

@section('menu')
	{{ $MainMenu }}
@stop

@section('contenido')
    <section class="container site">
		
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<span class="icon-menu show-menu"></span>
			</div>
		</div>
        @if (Session::has('error_url'))
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Woou! </strong> {{ Session::get('error_url') }}
            </div>
        </div>
        @elseif(Session::has('error_chage'))
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Woou! </strong> {{ Session::get('error_chage') }}
            </div>
        </div>
        @elseif(Session::has('success_chage'))
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Woou! </strong> {{ Session::get('success_chage') }}
            </div>
        </div>
        @else 
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4>Atención!</h4>
                <p>Todos los cambios realizados (a exepción de la foto de perfil) deben guardarse con el boton de <cite>Guardar Cambios</cite> ubicado al final de la página.</p>
            </div>
        </div>
        @endif
        
        <h1 class="title-page">Mi Perfil</h1>
        <div class="row">
            <div class="col-xs-12">
                <div class="content-profile-edit">
                    <figure class="profile">
                        <img src="/assets/images/profile">
                        <figcaption>
                            <span class="label label-profile">{{ Auth::user()->username }}</span>
                        </figcaption>
                    </figure>
                </div>                
            </div>
            <div class="col-xs-12">
                <input type="text" class="form-control" placeholder="Correo Electronico" value="{{ Auth::user()->email }}">
            </div>
        </div>
    </section>
@stop

@section('scripts')
    setTimeout(function() {
        $('.alert').slideUp();
    }, 5000);
@stop