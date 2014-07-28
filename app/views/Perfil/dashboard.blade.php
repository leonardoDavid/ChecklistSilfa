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
                <strong>Yeah! </strong> {{ Session::get('success_chage') }}
            </div>
        </div>
        @else 
        <div class="row">
            <div class="col-xs-12 col-md-12 alert alert-dismissable alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p> <strong><span class="icon-warning"></span> Atención!</strong> Todos los cambios realizados deben guardarse con el boton de <cite>Guardar Cambios</cite> ubicado al final de la página.</p>
            </div>
        </div>
        @endif
        
        <h1 class="title-page">Mi Perfil</h1>
        {{ Form::open( array('url' => '/perfil','method' => 'post','enctype' => 'multipart/form-data') ) }}
        <div class="row">
            <div class="col-xs-6">
                <div class="content-profile-edit">
                    <figure class="profile">
                        <img src="/assets/images/profile">
                        <figcaption>
                            <span class="label label-profile">{{ Auth::user()->username }}</span>
                        </figcaption>
                    </figure>
                </div> 
                <div class="file-input-wrapper">
                    <button class="btn btn-primary">Cambiar Foto</button>
                    <input type="file" name="photo" id="photo" class="btn" />
                </div>
                <p class="name-file"></p>
            </div>
            <div class="col-xs-6">
                <h5 class="title-page">Permisos</h5>
                <ul class="list-check">
                    <li>Modificar mi Perfil</li>
                    {{ $permisos }}
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon-email"></span></span>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electronico" value="{{ Auth::user()->email }}">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon-lock"></span></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                </div>

                <div class="panel-group" id="moreInfo">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#moreInfo" href="#campos">
                                    Más Información
                                </a>
                            </h4>
                        </div>
                        <div id="campos" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon-user"></span></span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nombres" value="{{ Auth::user()->nombre }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon-user"></span></span>
                                    <input type="text" id="paterno" name="paterno" class="form-control" placeholder="Apellido Paterno" value="{{ Auth::user()->ape_paterno }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon-user"></span></span>
                                    <input type="text" id="materno" name="materno" class="form-control" placeholder="Apellido Materno" value="{{ Auth::user()->ape_materno }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon-user"></span></span>
                                    <input type="text" id="fijo" name="fijo" class="form-control" placeholder="Telefono Fijo" value="{{ Auth::user()->tel_movil }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon-user"></span></span>
                                    <input type="text" id="movil" name="movil" class="form-control" placeholder="Telefono Móvil" value="{{ Auth::user()->tel_fijo }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary center-block">Guardar <span class="icon-right"></span></button>
                <span class="label label-warning center-block">Última vez actualizado el {{ Auth::user()->updated_at }}</span>
            </div>
        </div>
        {{ Form::close() }}
    </section>
@stop

@section('scripts')
    setTimeout(function() {
        $('.alert').slideUp();
    }, 5000);
    $('#photo').change(function(){
        var tmp = $('#photo').val().split('.');
        var ext = (tmp[tmp.length-1] != undefined) ? tmp[tmp.length-1] : '';
        if(ext == 'jpg' || ext == 'jpeg' || ext == 'png'){
            tmp = $('#photo').val().split('\\');
            var nameFile = (tmp[tmp.length-1] != undefined) ? tmp[tmp.length-1] : '';
            $('.name-file').text(nameFile);
        }
        else{
            $('#error-motivo').text('La imagenes de perfil solo pueden ser del tipo JPG( o JPEG) o PNG');
            $('#error-codigo').text('101');
            $('#error-server').modal();
            $('#photo').val();
        }
    });
    $('.collapse').collapse();

    @if(Session::has('error_mensajes'))
        $('#unfields').html("{{ Session::get('error_mensajes') }}");
        $('#error-client').modal();
    @endif
@stop