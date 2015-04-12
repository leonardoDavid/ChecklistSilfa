@extends('main')

@section('title')
	Dashboard - Sistema de Checklist
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

		<h1 class="title-page">Dashboard</h1>

        <!-- Resumen de Estadisticas -->
        <div class="statics statics-user">
            <span class="icon-user"></span>
            <span class="number">{{ $Users }}</span>
            <span class="text">Usuarios</span>
        </div>
        <div class="statics statics-report">
            <span class="icon-excel"></span>
            <span class="number">{{ $Reportes }}</span>
            <span class="text">Reportes</span>
        </div>
        <div class="statics statics-local">
            <span class="icon-store"></span>
            <span class="number">{{ $Tiendas }}</span>
            <span class="text">Clientes</span>
        </div>
    </section>
@stop