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
        @endif
        
        <h1 class="title-page">Mi Perfil</h1>
		<p>Bienvenido {{ Auth::user()->id; }}</p>

		<div class="overlay-disabled"></div>
    </section>
@stop

@section('scripts')
    @if (Session::has('error_url'))
        setTimeout(function() {
            $('.alert').slideUp();
        }, 3000);
    @endif
@stop