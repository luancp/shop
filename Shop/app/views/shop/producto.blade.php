@extends('layouts.default')

@section('css-header')

@endsection

@section('sidebar')
	<ul class="list-group">
		@if($categorias)
		  	<a class="list-group-item @if($cat == '-1') active @endif" href="{{ URL::route('principal') }}">Todas las Categorias</a>
			@foreach($categorias as $c)
		  		@if($c->tieneHijos())
		  		<a class="list-group-item tiene-hijos @if($cat == $c->id) active @endif" data-toggle="collapse" href="#{{ $c->id }}" data-id="{{ $c->id }}">{{ $c->nombre }}<span class="icon-padre fa fa-angle-down pull-right"></span></a>
	  			<div id="{{ $c->id }}" class="hijo-tiene-hijos collapse">
	  				@foreach($c->getHjios as $h)
			  			<a class="list-group-item list-group-item-success list-group-item-submenu @if($cat == $h->id) active item-desplegado @endif" data-padre="{{ $c->id }}" href="{{ URL::route('principal') }}?categoria={{ $h->id }}">{{ $h->nombre }}</a>
				  	@endforeach
	  			</div>
		  		@else
		  		<a class="list-group-item @if($cat == $c->id) active @endif" href="{{ URL::route('principal') }}?categoria={{ $c->id }}">{{ $c->nombre }}</a>
		  		@endif
		  	@endforeach
	  	@endif
	</ul>
	@if(Session::has('empresa'))
		<hr />
		<br />
		<div class="text-center">
		@if(Session::get('empresa')->facebook_plugin_activo)
			{{ Session::get('empresa')->facebook_plugin_script }}
		@endif
		</div>
	@endif
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white" style="padding-top:30px;padding-bottom:30px;">
    	<div class="col-md-6 col-sm-6">
    		<div>
    			@if(!$producto->imagen)
    			<img class="img-rounded" src="{{ URL::asset('img/productos/default/default.png') }}" width="100%" />
    			@else    			
    			<img class="img-rounded" src="{{ URL::asset('img/productos/'.$producto->imagen) }}" width="100%" />
    			@endif
    		</div>
    	</div>
    	<div class="col-md-6 col-sm-6">
    		<h4>{{ $producto->nombre }}</h4>
    		<p><hr /></p>
    		<p>{{ $producto->descripcion }}</p>
    		<p><hr /></p>
    		<p><h4><small>Stock: </small>{{ $producto->stock }}</h4></p>
    		<p><hr /></p>
    		<p><h4><small>precio: </small>${{ number_format($producto->precio, 2) }}</h4></p>
    		<p><hr /></p>
    		<div class="row">
    			<form class="" role="form" action="{{ URL::route('agregar_carrito') }}" method="post">
	    			<p class="col-md-4 col-sm-12 col-xs-12">
	    				<input type="hidden" name="id" value="{{ $producto->id }}" />
	    				<input type="hidden" name="nombre" value="{{ $producto->nombre }}" />
	    				<input type="hidden" name="precio" value="{{ $producto->precio }}" />
	    				<input type="hidden" name="imagen" value="{{ $producto->imagen }}" />
	    				<input class="form-control input-sm" type="number" name="cantidad" value="1" min="1" />
	    			</p>
	    			<p class="col-md-12 col-sm-12 col-xs-12">
	    				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Agregar al Carrito</button>
	    			</p>
    			</form>
				<form role="form" action="{{ URL::route('agregar_wishlist') }}" method="post">
					<p class="col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" name="producto_id" value="{{ $producto->id }}" />
						<button class="btn btn-info btn-sm" type="submit"><i class="fa fa-heart"></i>&nbsp;&nbsp;Agregar a la Lista</button>
					</p>
				</form>
    		</div>
    		<p><hr /></p>
    	</div>
		<br />
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/shop.js') }}
@endsection
