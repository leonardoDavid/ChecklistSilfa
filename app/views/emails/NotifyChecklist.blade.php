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
						<h2>Estimado {{ $user }}</h2>
						<p style="display: inline-block;vertical-align: top;margin: 1em 0 0 0;width: 85%;font-family: 'Open Sans', sans-serif !important;">
							Se ha ingrado correctamente el checklist en nuestra plataforma el día {{ $dia }} a las {{ $hora }}.
						</p>
						<p class="ultimo" style="margin-bottom: 1em;display: inline-block;vertical-align: top;margin: 1em 0 0 0;width: 85%;font-family: 'Open Sans', sans-serif !important;">
							Si necesita algún dato del checklist generado lo pueden ubicar bajo número ID <strong>{{ $ID }}</strong>
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
						Con la tecnologia EvolutioNet Chile
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>