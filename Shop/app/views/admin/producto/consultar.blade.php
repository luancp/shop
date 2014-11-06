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
	#imagen-imagen{
		width: 420px;
		height: 500px;
		position: relative; /* or fixed or absolute */
	}
</style>
{{ HTML::style('css/jasny-bootstrap.min.css') }}
{{ HTML::style('css/croppic/croppic.css') }}
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Producto
	    </h4>
	    <hr /><br />
    	<div class="col-md-7 col-sm-7" style="overflow:hidden">
    		<div id="imagen-imagen">
    			@if($producto->imagen)
    				<img class="croppedImg" src="{{ URL::asset('img/productos/'.$producto->imagen) }}">
    			@endif
    		</div>
    	</div>
    	<div class="col-md-5 col-sm-5">
    		<h4>{{ $producto->nombre }}</h4>
    		<p><hr /></p>
    		<p>{{ $producto->descripcion }}</p>
    		<p><hr /></p>
    		<p><h4><small>precio: </small>${{ number_format($producto->precio, 2) }}</h4></p>
    		<p><hr /></p>
    	</div>
  	</div>
  	<div class="col-md-12"><hr /></div>
@endsection

@section('js-footer')
{{ HTML::script('js/jasny-bootstrap.min.js') }}
{{ HTML::script('js/croppic/croppic.js') }}
<script type="text/javascript">
	$(function(){
		$('#usuario-imagen').fileinput({'name':'imagen'});
		
		@if($producto->imagen)
			$('#seleccionar-imagen').hide();
			$('#cambiar-imagen').show();
			//$('#quitar-imagen').show();
		@endif

		//para cortar la imagen
		var cropperOptions = {
			uploadUrl:	'{{ URL::route("admin_producto_subir", $producto->id) }}',
			cropUrl:	'{{ URL::route("admin_producto_cortar", $producto->id) }}',
			uploadData:{
				"id": "{{ $producto->id }}"
			},
			cropData:{
				"id": "{{ $producto->id }}"
			},
			zoomFactor: 5,
			doubleZoomControls: true,
			imgEyecandy: true,
			imgEyecandyOpacity: 0.4,
			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
		};
		var cropperHeader = new Croppic('imagen-imagen', cropperOptions);		
		
	});
</script>
@endsection

