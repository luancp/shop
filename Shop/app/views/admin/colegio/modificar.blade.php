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
    			@if($colegio->imagen)
    				<img class="croppedImg" src="{{ URL::asset('img/colegios/'.$colegio->imagen) }}">
    			@endif
    		</div>
    	</div>
    	<div class="col-md-7 col-sm-7">
    		@if(Session::has('errors'))
    		<div class="alert alert-danger">
    			<button type="button" class="close" data-dismiss="alert">
				  	<span aria-hidden="true">&times;</span>
				  	<span class="sr-only">Close</span>
				</button>
    			<ul>
		        @foreach($errors->all('<li>:message</li>') as $message)
		            {{ $message }}
		        @endforeach
		        </ul>
    		</div>
    		@endif
    		<form class="form-vertical" role="form" action="{{ URL::route('admin_colegio_actualizar', $colegio->id) }}" method="post">
	    		<div class="form-group">
	    			<label>Nombre del Colegio</label>
	    			<div class="">
	    				<input class="form-control input-sm" type="text" required="required" name="nombre" value="@if(Input::old('nombre')){{Input::old('nombre')}}@else{{$colegio->nombre}}@endif" />
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-floppy-o"></i>&nbsp;Guardar</button>
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
