<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Sistema de Checklist para supervisores Silfa">
    <meta name="author" content="Evolutionet Chile">
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
    </section>

    <div class="overlay-loading">
        <span class="loading"></span>
        <span class="loading-text">Cargando ...</span>
    </div>

    <span class="loading-box">Cargando ...</span>

    <!-- Scripts -->
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield('libjs')
    <script>
        var log;
        $(document).on('ready',function(){
            $('.overlay-loading').fadeOut();
            $('.show-menu').click(function(event) {
            	$('.menu').addClass('active');
            	$('.container').addClass('disabled');
            	$('.overlay-disabled').addClass('active');  	
            	$('.navbar').addClass('active');  	
            });
            $('.overlay-disabled').click(function(event){
            	$('.menu').removeClass('active');
            	$('.overlay-disabled').removeClass('active');
            	$('.navbar').removeClass('active');  	
            	$('.container').removeClass('disabled');  
            });
            @yield('scripts')
        });
    </script>
</body>
</html>