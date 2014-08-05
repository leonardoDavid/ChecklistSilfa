<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Sistema de Checklist para supervisores Silfa">
    <meta name="author" content="Evolutionet Chile">
    @yield('special-meta')
    <link rel="shortcut icon" href="/img/favicon.ico">
    <title>@yield('title','Sistema de Checklist')</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">
    @yield('styles')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<section class="main-contend">
		<!-- Menu -->
		@yield('menu')

		<!-- Contenido -->
	    @yield('contenido')

        <div class="overlay-disabled"></div>
        <!-- Modal de Bug -->        
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
        <div class="modal fade" id="bug-detected" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Reporte de Error</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            De antemano muchisimas gracias por notificarnos este error/felicitación, te responderemos a la brebedad.
                        </p>
                        <div class="form-group">
                            <textarea id="text-bug" class="form-control comment-bug" placeholder="Que nos quieres notificar?"></textarea>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info btn-sm" id="send-bug">Enviar</button>
                        <button class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="overlay-loading">
        <span class="loading"></span>
        <span class="loading-text">Cargando ...</span>
    </div>

    <span class="loading-box">Cargando ...</span>

    <!-- Scripts -->
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/libs.js"></script>
    @yield('libjs')
    <script>
        var log;
        var values = new Array();
        $(document).on('ready',function(){
            $('.overlay-loading').fadeOut();
            $('.show-menu').click(function(event) {
                showMenu();
            });
            $('.overlay-disabled').click(function(event){
            	hideMenu();
            });
            $('#bug').click(function(event) {
                hideMenu();
                $('#text-bug').val("");
                setTimeout(function() {
                    $('#bug-detected').modal();
                }, 300);
            });
            $('a').click(function(event){
                var url = $(this).attr('href');
                if(url[0] != "#"){
                    var tmpURL = $(this).attr('href');
                    event.preventDefault();
                    $('.overlay-loading').fadeIn();
                    setTimeout(function() {
                        window.location = tmpURL;
                    }, 800);
                }
            });
            @yield('scripts')
        });

        $('#text-bug').focus(function(event) {
            $('.form-group').removeClass('has-error');
        });

        $('#send-bug').click(function(event) {
            if($('#text-bug').val() != ""){
                $('.loading-box').text('Enviando ...');
                $('.loading-box').fadeIn();
                $('#bug-detected').modal('hide');
                $.ajax({
                    url: '/send-bug',
                    type: 'post',
                    data: { mensajes: $('#text-bug').val() },
                    success : function(response){
                        log = response;
                        if(response['status']){
                            $('.loading-box').html('<span class="icon-check"><span> Enviado');
                            setTimeout(function() {
                                $('.loading-box').fadeOut();
                            }, 3000);
                        }
                        else{
                            $('.loading-box').fadeOut();
                            if( ('motivos' in response) && response['motivos'].length > 0){
                                var msjErrors = "<ul>";
                                for (var i = 0; i < response['motivo'].length; i++) {
                                    msjErrors = msjErrors + "<li>" + response['motivo'][i] + "</li>";                                
                                };
                                msjErrors = msjErrors + "</ul";
                            }
                            else
                                msjErrors = response['motivo'];
                            $('#error-motivo').html(msjErrors);
                            $('#error-codigo').text(response['codigo']);
                            $('#error-server').modal();
                        }
                    },
                    error : function(xhr){
                        log = xhr;
                        console.log("MyError!");
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
            else{
                $('.form-group').addClass('has-error');
            }
        });

        function showMenu(){
            $('.menu').addClass('active');
            $('.container').addClass('disabled');
            $('.overlay-disabled').addClass('active');      
            $('.navbar').addClass('active');
        }
        function hideMenu(){
            $('.menu').removeClass('active');
            $('.overlay-disabled').removeClass('active');
            $('.navbar').removeClass('active');     
            $('.container').removeClass('disabled');
        }
    </script>
</body>
</html>