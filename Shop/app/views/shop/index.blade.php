@extends('layouts.default')

@section('css-header')

@endsection

@section('sidebar')
	<ul class="list-group">
		@if($categorias)
		  	<a class="list-group-item @if($cat == '-1') active @endif" href="{{ URL::route('principal') }}">Todas las Categorias</a>
			@foreach($categorias as $c)
		  		<a class="list-group-item @if($cat == $c->id) active @endif" href="{{ URL::route('principal') }}?categoria={{ $c->id }}">{{ $c->nombre }}<span class="fa fa-angle-right pull-right"></span></a>
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
	<div class="row">
		@foreach($productos as $p)
		<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		    	@if($p->imagen)
		      	<a href="{{ URL::route('producto_venta', $p->id) }}"><img src="{{ URL::asset('img/productos/'.$p->imagen) }}" alt="{{ $p->nombre }}" /></a>
		      	@else
		      	<a href="{{ URL::route('producto_venta', $p->id) }}"><img src="{{ URL::asset('img/productos/default/venta_default.png') }}" alt="{{ $p->nombre }}" /></a>
		      	@endif
		      	<div class="caption">
		        	<a href="{{ URL::route('producto_venta', $p->id) }}"><h5>{{ $p->nombre }}<strong class="pull-right text-success">${{ number_format($p->precio, 2) }}</strong></h5></a>
		      	</div>
		    </div>
	  	</div>
	  	@endforeach
	</div>
@endsection

@section('js-footer')

@endsection