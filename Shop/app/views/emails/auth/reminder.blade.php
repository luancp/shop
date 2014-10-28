<!DOCTYPE html>
<html lang="es-EC">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div style="text-align:center;">
			<img src="{{ URL::asset('img/logo.png') }}" alt="" />
		</div>
		<h3>Cambiar Contrase&ntilde;a</h3>
		<div>
			Para cambiar su contrase&ntilde;a por favor dirigase al siguiente enlace: <a href="{{ URL::route('resetear_password_token', array($token)) }}">Cambiar Contrase&ntilde;a</a>.<br/>
			<br>Si el link de arriba no funciona, copie y pegue en el navegador la siguiente direcci&oacute;n:<br>{{ URL::route('resetear_password_token', array($token)) }}<br >
			<br>
			<p style="color:#777;font-size:12px;">Este link expira en {{ Config::get('auth.reminder.expire', 60) }} minutos.</p>
		</div>
	</body>
</html>
