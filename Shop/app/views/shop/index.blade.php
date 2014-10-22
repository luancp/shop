@extends('layouts.default')

@section('css-header')

@endsection

@section('sidebar')
<ul class="list-group">
  	<a class="list-group-item @if($cat == '-1') active @endif" href="{{ URL::route('principal') }}">Todas las Categorias</a>
	@foreach($categorias as $c)
  		<a class="list-group-item @if($cat == $c->id) active @endif" href="{{ URL::route('principal') }}?categoria={{ $c->id }}"><span class="badge">{{ $c->getCantidadProductos() }}</span>{{ $c->nombre }}</a>
  	@endforeach
</ul>
@endsection

@section('content')
	<div class="row">
		@foreach($productos as $p)
		<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		    	@if($p->imagen)
		      	<img src="{{ URL::asset('img/productos/venta_'.$p->imagen) }}" alt="{{ $p->nombre }}" />
		      	@else
		      	<img src="{{ URL::asset('img/productos/default.png') }}" alt="{{ $p->nombre }}" />
		      	@endif
		      	<div class="caption">
		        	<a href=""><h5>{{ $p->nombre }}<strong class="pull-right text-success">${{ $p->precio }}</strong></h5></a>
		      	</div>
		    </div>
	  	</div>
	  	@endforeach
	</div>
@endsection

