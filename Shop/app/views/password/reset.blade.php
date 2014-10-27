<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>{{ Config::get('app.titulo_pagina') }} - {{ $title or '' }}</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans'); }}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/sticky-footer-navbar.css'); }}
    {{ HTML::style('css/bootstrap.min.css'); }}
    
    {{ HTML::style('css/font-awesome.min.css'); }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{ HTML::style('css/main.css') }}

    <!-- css header -->
    @yield('css-header')
    <!-- css header -->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::route('principal') }}"></a>
        </div>
      </div>
    </div>

    <!-- Begin page content -->
    <div class="container">
    	@if(Session::has('error_mensaje'))
    	<div class="row">
    		<div class="col-sm-12">
    			<div class="alert alert-danger alert-dismissible" role="alert">
    				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true" style="font-size: 18px;">&times;</span><span class="sr-only">Close</span></button>
    				<strong><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Error</strong>&nbsp;{{ Session::get('error_mensaje') }}
    			</div>
	    	</div>
    	</div>
    	@endif
    	@if(Session::has('success_mensaje'))
    	<div class="row">
    		<div class="col-sm-12">
    			<div class="alert alert-success alert-dismissible" role="alert">
    				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true" style="font-size: 18px;">&times;</span><span class="sr-only">Close</span></button>
    				<strong><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Exito,</strong>&nbsp;{{ Session::get('success_mensaje') }}
    			</div>
	    	</div>
    	</div>
    	@endif
    	<div class="row">
			<div class="col-md-12 col-sm-12">
				<form action="{{ URL::route('resetear_password_token_post') }}" method="POST">
				    <input type="hidden" name="token" value="{{ $token }}">
				    <input type="email" name="email">
				    <input type="password" name="password">
				    <input type="password" name="password_confirmation">
				    <input type="submit" value="Reset Password">
				</form>
			</div>
		</div>
    </div>

	<!-- footer -->
    <!-- <div class="footer">
      <div class="container">
        <p class="text-muted">Todos los derechos reservados.</p>
      </div>
    </div> -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}

    @yield('js-footer')

	</body>
</html>
