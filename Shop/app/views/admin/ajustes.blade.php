@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4><i class="fa fa-gears"></i>&nbsp;&nbsp;Ajustes</h4>
	    <hr /><br />
    	<form class="row" role="form" action="{{ URL::route('admin_actualizar_ajustes') }}" method="post">
		    <div class="form-group">
		  		<label class="col-md-12">Facebook Plugin<hr /></label>
			    <div class="col-md-12">
			    	<input id="activa_facebook" name="activa_facebook" type="checkbox" @if($empresa->facebook_plugin_activo==1) checked="true" @endif /> Activar el plugin de Facebook
			    </div>
		      	<div class="col-md-12">
		      		<textarea id="script_facebook" class="form-control" placeholder="inserte aqui el codigo iframe de facebook" rows="5">@if($empresa->facebook_plugin_activo){{ $empresa->facebook_plugin_script }}@endif</textarea>
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
		      		<textarea id="script_google" class="form-control" placeholder="inserte aqui el codigo iframe de google ads" rows="5">@if($empresa->google_plugin_activo){{ $empresa->google_plugin_script }}@endif</textarea>
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
<script type="text/javascript">
	var script_face = $('#script_facebook').text();
	var script_goog = $('#script_google').text();
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
		
		//activa o desactiva el plugin de facebook
		$('#activa_facebook').change(function(){
			if($(this).is(':checked')){
				$('#script_facebook').show();
				if(script_face){
					$('#script_facebook').text(script_face);
				}
			}else{
				$('#script_facebook').text('');
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
				$('#script_google').text('');
				$('#script_google').hide();
			}
		});
	});
</script>
@endsection
