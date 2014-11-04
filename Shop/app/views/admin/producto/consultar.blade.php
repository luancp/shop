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
{{ HTML::style('css/jcrop/jquery.Jcrop.min.css') }}
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Producto
	    </h4>
	    <hr /><br />
    	<div class="col-md-8 col-sm-8">
    		<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-new thumbnail">
    			@if(!$producto->imagen)
    			<img class="img-select" src="{{ URL::asset('img/productos/default.png') }}" width="500" />
    			@else    			
    			<img class="img-select" src="{{ URL::asset('img/productos/'.$producto->imagen) }}" width="500" />
    			@endif
			  </div>
			  <div id="fileinput-preview" class="fileinput-preview fileinput-exists thumbnail" >
			  	@if($producto->imagen)
    			<img class="img-select" src="{{ URL::asset('img/productos/'.$producto->imagen) }}" width="500" />
			  	@endif
			  </div>
			  <div>
			  	<form method="post" action="{{ URL::route('admin_producto_actualizar') }}" class="form-inline" enctype="multipart/form-data">
			  		<input type="hidden" name="id" value="{{ $producto->id }}" />
				    <span class="btn btn-info btn-file">
				    	<span class="fileinput-new" id="seleccionar-imagen">Seleccionar Imagen</span>
				    	<span class="fileinput-exists" id="cambiar-imagen">Cambiar</span>
				    	<input id="usuario-imagen" type="file" name="imagen">
				    </span>
				    <a href="#" id="quitar-imagen" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
				    <button class="btn btn-success fileinput-exists pull-right" type="submit">Guardar</button>
				</form>
			  </div>
			</div>
    	</div>
    	<div class="col-md-4 col-sm-4">
    		<h4>{{ $producto->nombre }}</h4>
    		<p><hr /></p>
    		<p>{{ $producto->descripcion }}</p>
    		<p><hr /></p>
    		<p><h4><small>precio: </small>${{ number_format($producto->precio, 2) }}</h4></p>
    		<p><hr /></p>
    	</div>
		<br />
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/jasny-bootstrap.min.js') }}
{{ HTML::script('js/jcrop/jquery.color.js') }}
{{ HTML::script('js/jcrop/jquery.Jcrop.min.js') }}
<script type="text/javascript">
	function selectImagen(c){
		console.log(c);
	}
	
	$(function(){
		$('#usuario-imagen').fileinput({'name':'imagen'});
		
		@if($producto->imagen)
			$('#seleccionar-imagen').hide();
			$('#cambiar-imagen').show();
			//$('#quitar-imagen').show();
		@endif
		
		//para cortar la imagen
		$('#fileinput-preview').bind('click', function(){
			$('#img-preview').Jcrop({
				onSelect:    selectImagen,
	            bgColor:     'green',
	            bgOpacity:   .6,
	            boxWidth: 	 500,
	            boxHeight: 	 500,
	            minSize:	 [420, 498],
	            maxSize:	 [420, 498],
			});
		});
	});
</script>
@endsection

