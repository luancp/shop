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
    {{ HTML::style('css/navbar.css'); }}
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
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-reorder fa-2x"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else </a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more </a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
			  <li class="">
		          <form class="navbar-form text-center" role="form">
		            <div class="form-group">
		              <input type="search" placeholder="Buscar..." class="form-control form-rounded"/>
		            </div>
		          </form>
			  </li>
			  <li class="">
			  	<a class="text-primary" href="{{ URL::route('login') }}">Ingresar</a>
			  </li>
			  <li class="">
			  	<a class="text-primary" href="">Registrarse</a>
			  </li>
			  <li class="">
	         	<a href=""><i class="fa fa-shopping-cart fa-2x"></i><span class="badge badge-cart">0</span></a>
	          </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Begin page content -->
    <div class="container">
    	<div class="row">
		  	<div class="col-md-3 col-sm-3">
				@yield('sidebar')
			</div>
			<div class="col-md-9 col-sm-9">
				@yield('content')
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
