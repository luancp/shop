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
          <a class="navbar-toggle collapsed cart-movil pull-left" id="popoverCartMovil" href="javascript:;" data-placement="bottom" data-toggle="popover" data-content=""><i class="fa fa-shopping-cart fa-2x"></i><span class="badge badge-cart">{{ Cookie::get('carrito_cantidad')?Cookie::get('carrito_cantidad'):0 }}</span></a>
          <a class="navbar-toggle collapsed wish-movil pull-left" id="" href="{{ URL::route('mostrar_wishlist') }}" data-placement="" data-toggle="" data-content=""><i class="fa fa-heart fa-2x"></i><span class="badge badge-cart">{{ Session::has('wishlist')?count(Session::get('wishlist')):0 }}</span></a>
        </div>
        <div class="collapse navbar-collapse">
          {{--<ul class="nav navbar-nav">
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
          </ul>--}}
          <ul class="nav navbar-nav navbar-right">
			  <li class="">
		          <form class="navbar-form text-center" role="form">
		            <div class="form-group">
		              <input type="search" placeholder="Buscar..." class="form-control form-rounded input-sm"/>
		            </div>
		          </form>
			  </li>
			  <li class="hidden-xs">
	         	<a href="javascript:;" id="popoverCart" data-placement="bottom" data-toggle="popover" data-content="" data-trigger="focus" tabindex="0"><i class="fa fa-shopping-cart fa-2x" ></i><span class="badge badge-cart">{{ Cookie::get('carrito_cantidad')?Cookie::get('carrito_cantidad'):0 }}</span></a>
	          </li>
			  <li class="hidden-xs">
	         	<a href="{{ URL::route('mostrar_wishlist') }}" id="" data-placement="" data-toggle="" data-content="" data-trigger="" tabindex="0"><i class="fa fa-heart fa-2x" ></i><span class="badge badge-cart">{{ Session::has('wishlist')?count(Session::get('wishlist')):0 }}</span></a>
	          </li>
			  @if(!Session::has('usuario'))
			  <li class="">
			  	<a class="text-primary" href="{{ URL::route('login') }}">Ingresar</a>
			  </li>
			  <li class="">
			  	<a class="text-primary" href="">Registrarse</a>
			  </li>
			  @else
			  	<li class="dropdown">
				  	<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"><img class="img-circle" style="width:27px;" src="{{ Session::get('imagen_usuario') }}" />&nbsp;&nbsp;{{ Session::get('usuario')->usuario }}&nbsp;<i class="fa fa-chevron-down"></i></a>
				  	<ul class="dropdown-menu" role="menu">
				  		@if(Session::get('usuario')->es_admin == '1')
		                	<li><a href="{{ URL::route('admin') }}"><i class="fa fa-gear"></i>&nbsp;&nbsp;Administraci&oacute;n</a></li>
		                 @endif
		                <li><a href="{{ URL::route('perfil') }}"><i class="fa fa-dollar"></i>&nbsp;&nbsp;Mis Ordenes</a></li>
		                <li><a href="{{ URL::route('perfil') }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Perfil</a></li>
		                <li class="divider"></li>
		                <li class=""><a href="{{ URL::route('logout') }}"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
	              	</ul>
				</li>
			  @endif
          </ul>
        </div><!--/.nav-collapse -->
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
				@yield('bg-ventas')
		  	</div>
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
    
    <!-- para el carrito de compras -->
    <div id="cart-hover" class="hide">
    	@if(Cookie::get('carrito'))
    	<div id="content-cart-header">
	    	@foreach(Cookie::get('carrito') as $c)
	    	<div class="media">
			  <div class="pull-left">
				@if(array_get($c, 'imagen'))
					{{ HTML::image('img/productos/thumb_'.array_get($c, 'imagen'), '', array('class'=>'img-rounded', 'width'=>'55')) }}
				@else
					{{ HTML::image('img/productos/default/thumb_default.png', '', array('class'=>'img-rounded', 'width'=>'55')) }}
				@endif
			  </div>
			  <div class="media-body producto-carrito-header">
			    {{ str_limit(array_get($c, 'nombre'), $limit = 50, $end = '...') }}<br /><span class="text-mini-cart">Cant. {{ array_get($c, 'cantidad') }}</span>
			  </div>
			</div>
	    	@endforeach
	    </div>
    	<div class="text-center" style="padding-top:10px;"><a class="btn btn-info btn-xs" href="{{ URL::route('carrito') }}">Ver Carrito</a></div>
    	@else
    	<p class="text-muted" style="width:200px;padding-top:5px;">No has realizado compras aun.</p>
    	@endif
    </div>
	<!-- para la lista de deseos -->
    <div id="wish-hover" class="hide">
    	@if(Cookie::get('wishlist'))
    	<div id="content-cart-header">
	    	@foreach(Cookie::get('wishlist') as $c)
	    	<div class="media">
			  <div class="pull-left">
				@if(array_get($c, 'imagen'))
					{{ HTML::image('img/productos/thumb_'.array_get($c, 'imagen'), '', array('class'=>'img-rounded', 'width'=>'55')) }}
				@else
					{{ HTML::image('img/productos/default/thumb_default.png', '', array('class'=>'img-rounded', 'width'=>'55')) }}
				@endif
			  </div>
			  <div class="media-body producto-carrito-header">
			    {{ str_limit(array_get($c, 'nombre'), $limit = 50, $end = '...') }}<br /><span class="text-mini-cart">Cant. {{ array_get($c, 'cantidad') }}</span>
			  </div>
			</div>
	    	@endforeach
	    </div>
    	<div class="text-center" style="padding-top:10px;"><a class="btn btn-info btn-xs" href="{{ URL::route('carrito') }}">Ver Carrito</a></div>
    	@else
    	<p class="text-muted" style="width:200px;padding-top:5px;">No has deseado nada aun.</p>
    	@endif
    </div>

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}

    @yield('js-footer')
	<script type="text/javascript">
		$(function(){
			//popover para el carrito de compras
			$('#popoverCart, #popoverCartMovil').popover({
				html: true,
				content: $('#cart-hover').html()
			});
			$('#popoverCart, #popoverCartMovil').on('show.bs.popover', function(){
				$("body").addClass("modal-open");
			});
			$('#popoverCart, #popoverCartMovil').on('hide.bs.popover', function(){
				$("body").removeClass("modal-open");
			});
			
			//popover para la lista de deseos
			$('#popoverWish, #popoverWishMovil').popover({
				html: true,
				content: $('#wish-hover').html()
			});
			$('#popoverWish, #popoverWishMovil').on('show.bs.popover', function(){
				$("body").addClass("modal-open");
			});
			$('#popoverWish, #popoverWishMovil').on('hide.bs.popover', function(){
				$("body").removeClass("modal-open");
			});
		});
	</script>
	</body>
</html>
