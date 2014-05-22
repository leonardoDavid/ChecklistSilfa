<html>
	<head>
		<meta charset="UTF-8">	
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,700italic,300,700' rel='stylesheet' type='text/css'>
		<style rel="stylesheet" type="text/css">
			*{
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
				margin:.1em 0 0 0;
				width: 85%;
			}
			.content tbody tr td p span{
				display: block;
			}
			.footer tbody tr td{
				text-align: center;
			}
		</style>
	</head>
	<body style="width: 100%;position: relative;font-family: 'Open Sans', sans-serif;overflow: hidden;background: #eeeeee;color: #4C4C4C;">
		<table class="header" style="width: 90%;margin: 0 auto;border-spacing: 0px;text-align: center;margin-bottom: 1em;">
			<tr>
				<td>
					<img src="http://checklist.evolutionet.cl/img/silfa.png" alt="Silfa Logo" height="70" width="200">
					<span style="display: block;">Sistema de Checklist</span>
				</td>
			</tr>
		</table>
		<table class="content" style="width: 90%;margin: 0 auto;border-spacing: 0px;">
			<thead>
				<tr style="background: #008CBA;height: 3px;width: 100%;">
					<td></td>
				</tr>
			</thead>
			<tbody style="background: #ffffff;">
				<tr>
					<td style="padding: 0.5em 1em;">
						Han informado desde la plataforma de Checklist que existe un Bug, los detalles de la notificaión son:
					</td>
				</tr>
				<tr>
					<td style="padding: 0.5em 1em;">
						<img src="http://checklist.evolutionet.cl/img/emails/email.png" alt="Silfa Logo" height="48" width="48" style="display: inline-block;vertical-align: top;">
						<p style="display: inline-block;vertical-align: top;margin:.1em 0 0 0;width: 85%;">
							<span style="display: block;"><b>Nombre: </b>{{ $user }}</span>
							<span style="display: block;"><b>Correo: </b>{{ $email }}</span>
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding: 0.5em 1em;">
						<img src="http://checklist.evolutionet.cl/img/emails/notes.png" alt="Silfa Logo" height="48" width="48" style="display: inline-block;vertical-align: top;">
						<p style="display: inline-block;vertical-align: top;margin:.1em 0 0 0;width: 85%;">
							{{ $mensaje }}
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="footer" style="width: 90%;margin: 0 auto;border-spacing: 0px;">
			<thead>
				<tr style="background: #008CBA;height: 3px;width: 100%;">
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding: 0.5em 1em;text-align: center;">
						Con la tecnologia EvolutioNet Chile
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>