@extends('layouts.admin')

@section('css-header')
{{ HTML::style('css/croppic/croppic.css') }}
<style type="text/css">
	#imagen-imagen{
		width: 300px;  /* MANDATORY */
		height: 200px; /* MANDATORY */
		position: relative;  /* MANDATORY */
	
		border: 2px solid #ddd;
		box-sizing: content-box;
		-moz-box-sizing: content-box;
		border-radius: 2px;
		background-image: url('/img/productos/default/default.png');
		background-repeat: no-repeat;
		background-position: center;
	}
</style>
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Registrar Colegio
	    </h4>
	    <hr /><br />
    	<div class="col-md-5 col-sm-5">
    		<div id="imagen-imagen">
    			<button style="position:absolute;" id="button-upload" class="btn btn-success btn-sm pull-right">Subir Imagen</button>
    		</div>
    	</div>
    	<div class="col-md-7 col-sm-7">
    		<form class="form-vertical" role="form" action="{{ URL::route('admin_colegio_agregar') }}" method="post">
	    		<div class="form-group">
	    			<label>Nombre del Colegio</label>
	    			<div class="">
	    				<input class="form-control input-sm" type="text" name="nombre" />
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<button type="submit" class="btn btn-sm btn-success">Guardar</button>
				</div>
    		</form>
    	</div>
	  	<p class="col-md-12">&nbsp;<hr /></p>
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/croppic/croppic.js') }}
<script type="text/javascript">
	$(function(){
		var cropperOptions = {
			uploadUrl:	'{{ URL::route("admin_imagen_colegio_subir") }}',
			cropUrl:	'{{ URL::route("admin_imagen_colegio_cortar") }}',
			uploadData:{
				
			},
			cropData:{
				
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

