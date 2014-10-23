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
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white" style="padding-top:30px;padding-bottom:30px;">
    	<div class="col-md-6 col-sm-6">
    		<div>
    			@if(!$producto->imagen)
    			<img class="img-rounded" src="{{ URL::asset('img/productos/default.png') }}" width="100%" />
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
    		<div class="row">
    			<form role="form" action="{{ URL::route('agregar_carrito') }}" method="post">
	    			<p class="col-md-3 col-sm-5 col-xs-6">
	    				<input type="hidden" name="id" value="{{ $producto->id }}" />
	    				<input class="form-control input-sm" type="number" name="cantidad" value="1" />
	    			</p>
	    			<p class="col-md-3 col-sm-5 col-xs-6">
	    				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Agregar</button>
	    			</p>
    			</form>
    		</div>
    		<p><hr /></p>
    	</div>
		<br />
  	</div>
@endsection

