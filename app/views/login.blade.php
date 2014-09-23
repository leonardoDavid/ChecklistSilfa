<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Sistema de Checklist para supervisores Silfa">
    <meta name="author" content="Evolutionet Chile">
    <link rel="shortcut icon" href="/img/icono.png">
    <title>Sistma de Checklist</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <section class="container">

        <!-- Login -->
        <section class="row" id="login">
            @if(Session::has('error_login'))
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Woou! </strong> {{ Session::get('error_login') }}
            </div>
            @endif
            @if(Session::has('info_login'))
            <div class="alert alert-dismissable alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Yeah! </strong> {{ Session::get('info_login') }}
            </div>
            @endif
            <figure class="col-xs-12 col-md-4 logo center-block">
                <img src="/img/logo.png">
            </figure>
            <section class="contenedor col-xs-12 center-block">
                <h2>Sistema de Checklist</h2>
                {{ Form::open(array('url' => '/login')) }}
                <div class="input-login">
                    {{ Form::text('username', $value = null , $attributes = array(
                        'placeholder' => 'Usuario' ,
                        'class' => 'form-control'
                    )) }}
                </div>
                <div class="input-login">
                    {{ Form::password('password' ,  $attributes = array(
                        'placeholder' => 'Contraseña' ,
                        'class' => 'form-control'
                    )) }}
                </div>
                <div class="submit">
                    <div class="remember-me">
                        <div class="onoffswitch">
                            {{ Form::checkbox('remember', "1" , false , $attributes = array(
                                'id' => 'remember',
                                'class' => 'onoffswitch-checkbox'
                            )) }}
                            <label class="onoffswitch-label" for="remember">
                                <div class="onoffswitch-inner"></div>
                                <div class="onoffswitch-switch"></div>
                            </label>
                        </div>
                        <span class="text">Recordarme</span>
                    </div>
                    {{ Form::submit('Enviar',$attributes = array(
                        'id' => 'submit-form',
                        'class' => 'btn btn-primary pull-right'
                    )) }}
                </div>
                {{ Form::close() }}
                <div class="restore-pass">
                    <a href="#fogot-password" data-toggle="modal">Olvide mi Contraseña</a>
                </div>
            </section>
        </section>

        <!-- Modales -->
        <div class="modal fade" id="forgot-password">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Silfa Checklist</h4>
                    </div>
                    <div class="modal-body">
                        <p>Este modulo se encuentra en construcción, de momento debes recuperar o solicitar una nueva contraseña con tu jefe directo.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="overlay-loading">
        <span class="loading"></span>
        <span class="loading-text">Cargando ...</span>
    </div>

    <!-- Scripts -->
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
        $(document).on('ready',function(){
            var stat = 0;
            $("a").click(function(event) {
                $("#forgot-password").modal();
            });
            $('.overlay-loading').fadeOut();
            setTimeout(function() {
                $('.alert').slideUp();
            }, 3000);
            $('form').submit(function(event){
                if(stat == 0){
                    event.preventDefault();
                    console.log("cancelado ...");
                    $('.overlay-loading').fadeIn(function(){
                        stat = 1;
                        setTimeout(function(){
                            $('form').submit();
                        }, 500);
                    });
                }
            });
        });
    </script>
</body>
</html>