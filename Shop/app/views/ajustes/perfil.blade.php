@extends('layouts.ajustes')

@section('css-header')
{{ HTML::style('css/jasny-bootstrap.min.css') }}
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>Perfil</h4>
	    <hr /><br />
    	@if ($errors->has())
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all('<li class="text-danger">:message</li>') as $error)
				{{ $error }}		
			@endforeach
			</ul>
	    </div>
		@endif
	    <form class="form-horizontal" role="form" method="post" action="{{ URL::route('perfil_actualizar') }}" enctype="multipart/form-data">
		  	<div class="form-group">
				<label class="col-sm-2 control-label">Foto<br><small>Tam.(150x150)</small></label>
				<div class="col-sm-6">
					<div class="fileinput fileinput-new" data-provides="fileinput">
					  <div class="fileinput-new thumbnail">
					    <img src="{{ Session::get('imagen_usuario') }}" alt="foto" style="max-height:150px;" />
					  </div>
					  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
					  	@if($usuario->imagen)
					  	<img src="{{ URL::asset('img/avatars/'.$usuario->imagen) }}" alt="foto" style="max-height:150px;" />
					  	@endif
					  </div>
					  <div>
					    <span class="btn btn-info btn-file">
					    	<span class="fileinput-new">Seleccionar Imagen</span>
					    	<span class="fileinput-exists">Cambiar</span>
					    	<input type="file" name="imagen">
					    </span>
					    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
					  </div>
					</div>
				</div>
			</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">Nombres</label>
				<div class="col-sm-6">
			  		<input class="form-control" type="text" name="nombres" value="{{ Input::old('nombres')?Input::old('nombres'):$usuario->nombres }}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Apellidos</label>
				<div class="col-sm-6">
			  		<input class="form-control" type="text" name="apellidos" value="{{ Input::old('apellidos')?Input::old('apellidos'):$usuario->apellidos }}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">C&eacute;dula/RUC</label>
				<div class="col-md-3 col-sm-4">
			  		<input class="form-control" type="text" name="cedula" value="{{ Input::old('cedula')?Input::old('cedula'):$usuario->cedula }}" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">G&eacute;nero</label>
				<div class="col-md-3 col-sm-4">
					{{ Form::select('genero', 
						array(
							'-' => '',
							'H' => 'Hombre',
							'M' => 'Mujer',
							'I' => 'Indefinido'
							), Input::old('genero')?Input::old('genero'):$usuario->genero, array('class'=>'form-control', 'id'=>'genero'))
					}}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Ubicaci&oacute;n</label>
				<div class="col-md-3 col-sm-5">
					<select class="form-control" name="ubicacion" id="ubicacion">
						<option value="Azuay">Azuay</option>
						<option value="Bolívar">Bolívar</option>
						<option value="Carchi">Carchi</option>
						<option value="Cañar">Cañar</option>
						<option value="Chimborazo">Chimborazo</option>
						<option value="Cotopaxi">Cotopaxi</option>
						<option value="El Oro">El Oro</option>
						<option value="Esmeraldas">Esmeraldas</option>
						<option value="Galápagos">Galápagos</option>
						<option value="Guayas" selected="selected">Guayas</option>
						<option value="Imbabura">Imbabura</option>
						<option value="Loja">Loja</option>
						<option value="Los Ríos">Los Ríos</option>
						<option value="Manabí">Manabí</option>
						<option value="Morona Santiago">Morona Santiago</option>
						<option value="Napo">Napo</option>
						<option value="Orellana">Orellana</option>
						<option value="Pastaza">Pastaza</option>
						<option value="Pichincha ( Quito )">Pichincha ( Quito )</option>
						<option value="Santa Elena">Santa Elena</option>
						<option value="Santo Domingo de los Tsáchilas">Santo Domingo de los Tsáchilas</option>
						<option value="Sucumbíos">Sucumbíos</option>
						<option value="Tungurahua">Tungurahua</option>
						<option value="Zamora Chinchipe">Zamora Chinchipe</option>
			  		</select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-2">
					<button class="btn btn-success" type="submit">Guardar Cambios</button>
				</div>
			</div>
		 </form>
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
