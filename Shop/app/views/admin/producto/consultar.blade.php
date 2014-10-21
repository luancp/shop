@extends('layouts.admin')

@section('css-header')
<style type="text/css">
	.thumbnail{
		margin-bottom: 10px;
	}
	.titulo-producto{
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}
</style>
{{ HTML::style('css/jasny-bootstrap.min.css') }}
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Producto
	    </h4>
	    <hr /><br />
    	<div class="col-md-6 col-sm-6">
    		<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-new thumbnail">
    			@if(!$producto->imagen)
    			<img src="{{ URL::asset('img/productos/default.png') }}" width="100%" />
    			@else    			
    			<img src="{{ URL::asset('img/productos/'.$producto->imagen) }}" width="100%" />
    			@endif
			  </div>
			  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:100%;">
			  	@if($producto->imagen)
    			<img src="{{ URL::asset('img/productos/'.$producto->imagen) }}" width="100%" />
			  	@endif
			  </div>
			  <div>
			  	<form method="post" action="{{ URL::route('admin_producto_actualizar') }}" class="form-inline" enctype="multipart/form-data">
			  		<input type="hidden" name="id" value="{{ $producto->id }}" />
				    <span class="btn btn-info btn-file">
				    	<span class="fileinput-new">Seleccionar Imagen</span>
				    	<span class="fileinput-exists">Cambiar</span>
				    	<input type="file" name="imagen">
				    </span>
				    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
				    <button class="btn btn-success fileinput-exists pull-right" type="submit">Guardar</button>
				</form>
			  </div>
			</div>
    	</div>
    	<div class="col-md-6 col-sm-6">
    		<h4>{{ $producto->nombre }}</h4>
    		<p>{{ $producto->descripcion }}</p>
    	</div>
		<br />
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/jasny-bootstrap.min.js') }}
<script type="text/javascript">
	$(function(){
		$('#usuario-imagen').fileinput();
	});
</script>
@endsection

