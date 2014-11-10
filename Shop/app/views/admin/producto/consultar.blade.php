@extends('layouts.admin')

@section('css-header')
{{ HTML::style('css/croppic/croppic.css') }}
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
		width: 420px;  /* MANDATORY */
		height: 500px; /* MANDATORY */
		position: relative;  /* MANDATORY */
	
		border: 2px solid #ddd;
		box-sizing: content-box;
		-moz-box-sizing: content-box;
		border-radius: 2px;
		background-image: url(/img/productos/default/default.png);
		background-repeat: no-repeat;
		background-position: center;
	}
</style>
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Producto
	    </h4>
	    <hr /><br />
    	<div class="col-md-7 col-sm-7">
    		<div id="imagen-imagen">
    			<button style="position:absolute;" id="button-upload" class="btn btn-success btn-sm pull-right">Subir Imagen</button>
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
	  	<p class="col-md-12">&nbsp;<hr /></p>
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/croppic/croppic.js') }}
<script type="text/javascript">
	$(function(){
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
			modal: true,
			onAfterImgCrop:	function(){
				location.reload(true);
			},
			customUploadButtonId: 'button-upload',
			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
		};
		var cropperHeader = new Croppic('imagen-imagen', cropperOptions);
		
	});
</script>
@endsection

