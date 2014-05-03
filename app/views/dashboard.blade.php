<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Sistema de Checklist para supervisores Silfa">
    <meta name="author" content="Evolutionet Chile">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <title>Sistma de Checklist</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <section class="container">

		<h1>Bienvenido {{ Auth::user()->nombre; }}</h1>
    	<a href="/logout">Cerrar sesión.</a>        

        <!-- Modales -->
        <div class="modal fade" id="forgot-password">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
        $(document).on('ready',function(){
            $("a").click(function(event) {
                $("#forgot-password").modal();
            });
            $('.overlay-loading').fadeOut();
        });
    </script>
</body>
</html>