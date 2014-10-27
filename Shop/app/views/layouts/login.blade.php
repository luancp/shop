
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login - {{ Config::get('app.titulo_pagina') }}</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.min.css'); }}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/login.css'); }}
   
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="post" action="{{ URL::route('login_user') }}">
      	<div class="text-center"><p>{{ HTML::image('img/logo.min.png') }}</p></div>
      	@if(Session::has('error_login'))
      	<div class="alert alert-danger">Usuario o Clave incorrectos.</div>
      	@endif
        <input type="text" name="usuario" class="form-control input-sm" placeholder="Usuario" required autofocus />
        <input type="password" name="password" class="form-control input-sm" placeholder="Contrase&ntilde;a" required />

        <button class="btn btn-success btn-block" type="submit">Ingresar</button><br>
        <a href="{{ URL::route('resetear_password') }}">&iquest;Olvido su contrase&ntilde;a? </a>
      </form>

    </div> <!-- /container -->
  </body>
</html>
