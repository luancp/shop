@extends('layouts.admin')

@section('css-header')
{{ HTML::style('css/croppic/croppic.css') }}
<style type="text/css">
	#imagen-imagen{
		width: 800px;  /* MANDATORY */
		height: 250px; /* MANDATORY */
		position: relative;  /* MANDATORY */
	
		border: 2px solid #ddd;
		box-sizing: content-box;
		-moz-box-sizing: content-box;
		border-radius: 2px;
		background-image: url(/img/productos/default/default.png);
		background-repeat: no-repeat;
		background-position: center;
	}
	#imagen-imagen2{
		width: 500px;  /* MANDATORY */
		height: 500px; /* MANDATORY */
		position: relative;  /* MANDATORY */
	
		border: 2px solid #ddd;
		box-sizing: content-box;
		-moz-box-sizing: content-box;
		border-radius: 2px;
/* 		background-image: url(/img/productos/default/default.png); */
		background-repeat: no-repeat;
		background-position: center;
	}
</style>
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4><i class="fa fa-gears"></i>&nbsp;&nbsp;Ajustes</h4>
	    <hr /><br />
    	<form class="row" role="form" action="{{ URL::route('admin_actualizar_ajustes') }}" method="post">
		    <div class="form-group">
		  		<label class="col-md-12">Imagen Popup Modal<hr /></label>
		  		<div class="col-md-12">
			    	<input id="popup_activo" name="popup_activo" type="checkbox" @if($empresa->popup_activo==1) checked="true" @endif /> Activar el Popup modal
			    </div>
			    <div class="col-md-12">
			    	<br />
			  		<label class="popup-empresa">Titulo Popup</label>
		      		<input class="form-control popup-empresa input-sm" type="text" id="popup_titulo" name="popup_titulo" placeholder="escribe el titulo del modal" value="@if($empresa->popup_activo){{ $empresa->popup_titulo }}@endif" />
		      	</div>
			    <div class="col-md-12">
			    	<br />
			    	<div id="imagen-imagen2" class="popup-empresa">
		    			<button type="button" style="position:absolute;" id="button-upload2" class="btn btn-success btn-sm pull-right">Subir Imagen Popup</button>
		    			@if($empresa->popup_imagen)
		    				<img class="croppedImg" src="{{ URL::asset('img/'.$empresa->popup_imagen) }}">
		    			@endif
		    		</div>
			    </div>
		  	</div>
		    <div class="form-group">
		  		<div class="col-md-12"><br /></div>
	    	</div>
		    <div class="form-group">
		  		<label class="col-md-12">Imagen Banner Principal<hr /></label>
			    <div class="col-md-12">
			    	<div id="imagen-imagen">
		    			<button type="button" style="position:absolute;" id="button-upload" class="btn btn-success btn-sm pull-right">Subir Imagen Banner</button>
		    			@if($empresa->imagen_banner)
		    				<img class="croppedImg" src="{{ URL::asset('img/'.$empresa->imagen_banner) }}">
		    			@endif
		    		</div>
			    </div>
		  	</div>
		    <div class="form-group">
		  		<div class="col-md-12"><br /></div>
	    	</div>
		    <div class="form-group">
		  		<label class="col-md-12">Facebook Plugin<hr /></label>
			    <div class="col-md-12">
			    	<input id="activa_facebook" name="activa_facebook" type="checkbox" @if($empresa->facebook_plugin_activo==1) checked="true" @endif /> Activar el plugin de Facebook
			    </div>
		      	<div class="col-md-12">
		      		<textarea id="script_facebook" name="script_facebook" class="form-control" placeholder="inserte aqui el codigo iframe de facebook" rows="5">@if($empresa->facebook_plugin_activo){{ $empresa->facebook_plugin_script }}@endif</textarea>
		      	</div>
		  	</div>
		    <div class="form-group">
		  		<div class="col-md-12"><br /></div>
	    	</div>
		    <div class="form-group">
		  		<label class="col-md-12">Google Ads Plugin<hr /></label>
			    <div class="col-md-12">
			    	<input id="activa_google" name="activa_google" type="checkbox" @if($empresa->google_plugin_activo==1) checked="true" @endif /> Activar el plugin de Google Ads
			    </div>
		      	<div class="col-md-12">
		      		<textarea id="script_google" name="script_google" class="form-control" placeholder="inserte aqui el codigo iframe de google ads" rows="5">@if($empresa->google_plugin_activo){{ $empresa->google_plugin_script }}@endif</textarea>
		      	</div>
		  	</div>
		    <div class="form-group">
		  		<div class="col-md-12">&nbsp;<hr /><br /></div>
	    	</div>
		    <div class="form-group">
		    	<div class="col-md-12">
		    		<button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
		    	</div>
		  	</div>		  
		</form>
		<br />
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/croppic/croppic.js') }}
<script type="text/javascript">
	$(function(){
		//para cortar la imagen del banner principal
		var cropperOptions = {
			uploadUrl:	'{{ URL::route("admin_banner_subir", $empresa->id) }}',
			cropUrl:	'{{ URL::route("admin_banner_cortar", $empresa->id) }}',
			uploadData:{
				"id": "{{ $empresa->id }}"
			},
			cropData:{
				"id": "{{ $empresa->id }}"
			},
			modal: true,
			onAfterImgCrop:	function(){
				location.reload(true);
			},
			customUploadButtonId: 'button-upload',
			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
		};
		var cropperHeader = new Croppic('imagen-imagen', cropperOptions);

		//para cortar la imagen del popup modal
		var cropperOptions = {
			uploadUrl:	'{{ URL::route("admin_popup_subir", $empresa->id) }}',
			cropUrl:	'{{ URL::route("admin_popup_cortar", $empresa->id) }}',
			uploadData:{
				"id": "{{ $empresa->id }}"
			},
			cropData:{
				"id": "{{ $empresa->id }}"
			},
			modal: true,
			onAfterImgCrop:	function(){
				location.reload(true);
			},
			customUploadButtonId: 'button-upload2',
			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
		};
		var cropperHeader = new Croppic('imagen-imagen2', cropperOptions);
	});
</script>
<script type="text/javascript">
	var script_face = $('#script_facebook').text();
	var script_goog = $('#script_google').text();
	var titulo_pop = $('#popup_titulo').text();
	$(function(){
		//varifica si esta activo el plugin de facebook
		if($('#activa_facebook').is(':checked')){
			$('#script_facebook').show();
		}else{
			$('#script_facebook').hide();
		}
		//varifica si esta activo el plugin de google
		if($('#activa_google').is(':checked')){
			$('#script_google').show();
		}else{
			$('#script_google').hide();
		}
		//varifica si esta activo el plugin de google
		if($('#popup_activo').is(':checked')){
			$('.popup-empresa').show();
		}else{
			$('.popup-empresa').hide();
		}
		
		//activa o desactiva el plugin de facebook
		$('#activa_facebook').change(function(){
			if($(this).is(':checked')){
				$('#script_facebook').show();
				if(script_face){
					$('#script_facebook').text(script_face);
				}
			}else{
				$('#script_facebook').hide();
			}
		});

		//activa o desactiva el plugin de google
		$('#activa_google').change(function(){
			if($(this).is(':checked')){
				$('#script_google').show();
				if(script_face){
					$('#script_google').text(script_goog);
				}
			}else{
				$('#script_google').hide();
			}
		});

		//activa o desactiva el plugin del popup
		$('#popup_activo').change(function(){
			if($(this).is(':checked')){
				$('.popup-empresa').show();
				if(titulo_pop){
					$('#popup_titulo').text(titulo_pop);
				}
			}else{
				$('.popup-empresa').hide();
			}
		});
	});
</script>

@endsection
