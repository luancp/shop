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
		background-image: url('/img/colegios/default/default.png');
		background-repeat: no-repeat;
		background-position: center;
	}
</style>
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Colegio
	    </h4>
	    <hr /><br />
    	<div class="col-md-7 col-sm-7">
    		<div id="imagen-imagen">
    			<button style="position:absolute;" id="button-upload" class="btn btn-success btn-sm pull-right">Subir Imagen</button>
    			@if($colegio->imagen)
    				<img class="croppedImg" src="{{ URL::asset('img/colegios/'.$colegio->imagen) }}">
    			@endif
    		</div>
    	</div>
    	<div class="col-md-5 col-sm-5">
    		<h4>{{ $colegio->nombre }}</h4>
    		<p><hr /></p>
    		<p>{{ $colegio->descripcion }}</p>
    		<p><hr /></p>
    	</div>
	  	<p class="col-md-12">&nbsp;<hr /></p>
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/croppic/croppic.js') }}
<script type="text/javascript">
	$(function(){
		var cropperOptions = {
			uploadUrl:	'{{ URL::route("admin_imagen_colegio_subir", $colegio->id) }}',
			cropUrl:	'{{ URL::route("admin_imagen_colegio_cortar", $colegio->id) }}',
			uploadData:{
				"id": "{{ $colegio->id }}"
			},
			cropData:{
				"id": "{{ $colegio->id }}"
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

