<html>
	<head>
		<meta charset="UTF-8">	
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,700italic,300,700' rel='stylesheet' type='text/css'>
		<style rel="stylesheet" type="text/css">
			body,p,.header,.footer,.content{
				font-family: 'Open Sans', sans-serif !important;
			}
			body{
				width: 100%;
				position: relative;
				font-family: 'Open Sans', sans-serif;
				overflow: hidden;
				background: #eeeeee;
				color: #4C4C4C;
			}
			.header,
			.content,
			.footer{
				width: 90%;
				margin: 0 auto;
				border-spacing: 0px;
			}
			.header{
				text-align: center;
				margin-bottom: 1em;
			}
			.header span{
				display: block;
			}
			.content thead tr,
			.footer thead tr{
				background: #008CBA;
				height: 3px;
				width: 100%;
			}
			.content tbody tr td,
			.footer tbody tr td{
				padding: 0.5em 1em;
			}
			.content tbody{
				background: #ffffff;
			}
			.content tbody tr td img,
			.content tbody tr td p{
				display: inline-block;
				vertical-align: top;
			}
			.content tbody tr td p{
				margin:1em 0 0 0;
				width: 85%;
			}
			.content tbody tr td p span{
				display: block;
			}
			.footer tbody tr td{
				text-align: center;
			}
			.ultimo{
				margin-bottom: 1em;
			}
		</style>
	</head>
	<body>
		<table class="header">
			<tr>
				<td>
					<img src="http://checklist.evolutionet.cl/img/silfa.png" alt="Silfa Logo" height="70" width="200">
					<span>Sistema de Checklist</span>
				</td>
			</tr>
		</table>
		<table class="content">
			<thead>
				<tr>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<h2>Estimado {{ $user }}</h2>
						<p>
							Se ha ingrado correctamente el checklist en nuestra plataforma el día {{ $dia }} a las {{ $hora }}.
						</p>
						<p class="ultimo">
							Si necesita algún dato del checklist generado lo pueden ubicar bajo número ID <strong>{{ $ID }}</strong>
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="footer">
			<thead>
				<tr>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Con la tecnologia EvolutioNet Chile
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>