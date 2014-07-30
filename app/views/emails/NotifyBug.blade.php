<html>
	<head>
		<meta charset="UTF-8">	
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,700italic,300,700" rel="stylesheet" type="text/css">
	</head>
	<body style="width: 100%;position: relative;font-family: 'Open Sans', sans-serif !important;overflow: hidden;background: #eeeeee;color: #4C4C4C;">
		<table class="header" style="width: 90%;margin: 0 auto;border-spacing: 0px;text-align: center;margin-bottom: 1em;font-family: 'Open Sans', sans-serif !important;">
			<tr>
				<td>
					<img src="http://checklist.evolutionet.cl/img/silfa.png" alt="Silfa Logo" height="70" width="200">
					<span style="display: block;">Sistema de Checklist</span>
				</td>
			</tr>
		</table>
		<table class="content" style="width: 90%;margin: 0 auto;border-spacing: 0px;font-family: 'Open Sans', sans-serif !important;">
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
						<p style="display: inline-block;vertical-align: top;margin: 1em 0 0 0;width: 85%;font-family: 'Open Sans', sans-serif !important;">
							<span style="display: block;"><b>Nombre: </b>{{ $user }}</span>
							<span style="display: block;"><b>Correo: </b>{{ $email }}</span>
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding: 0.5em 1em;">
						<img src="http://checklist.evolutionet.cl/img/emails/notes.png" alt="Silfa Logo" height="48" width="48" style="display: inline-block;vertical-align: top;">
						<p class="ultimo" style="margin-bottom: 1em;display: inline-block;vertical-align: top;margin: 1em 0 0 0;width: 85%;font-family: 'Open Sans', sans-serif !important;">
							{{ $mensaje }}
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="footer" style="width: 90%;margin: 0 auto;border-spacing: 0px;font-family: 'Open Sans', sans-serif !important;">
			<thead>
				<tr style="background: #008CBA;height: 3px;width: 100%;">
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding: 0.5em 1em;text-align: center;">
						Con la tecnologia Swert Chile
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>