@extends('layouts.default')

@section('css-header')

@endsection

@section('sidebar')
	<ul class="list-group">
	  <a class="list-group-item active" href="{{ URL::route('perfil') }}">Perfil<span class="fa fa-chevron-right pull-right"></span></a>
	  <a class="list-group-item" href="">Cuenta<span class="fa fa-chevron-right pull-right"></span></a>
	  <a class="list-group-item" href="">Contrase&ntilde;a<span class="fa fa-chevron-right pull-right"></span></a>
	</ul>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-12 bg-white">
		    <h4>Perfil</h4>
		    <hr /><br />
		    <form class="form-horizontal" role="form">
			  	<div class="form-group">
					<label class="col-sm-2 control-label">Foto</label>
					<div class="col-sm-6">
						@if($usuario->imagen)
						<img src="{{ public_path().'/'.$usuario->imagen }}" alt="foto" class="img-thumbnail" />
						@else
						<img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" alt="foto" class="img-thumbnail" />
						@endif
				  		<input class="form-control" type="file" name="imagen" />
					</div>
				</div>
			  	<div class="form-group">
					<label class="col-sm-2 control-label">Nombres</label>
					<div class="col-sm-6">
				  		<input class="form-control" type="text" name="nombres" value="{{ $usuario->nombres }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Apellidos</label>
					<div class="col-sm-6">
				  		<input class="form-control" type="text" name="apellidos" value="{{ $usuario->apellidos }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-6">
				  		<input class="form-control" type="text" name="email" value="{{ $usuario->email }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">G&eacute;nero</label>
					<div class="col-sm-3">
				  		<select class="form-control" name="genero">
				  			<option value="-"></option>
				  			<option value="M">Masculino</option>
				  			<option value="F">Femenino</option>
				  			<option value="I">Indefinido</option>
				  		</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Ubicaci&oacute;n</label>
					<div class="col-sm-5">
				  		<input class="form-control" type="text" name="ubicacion" value="{{ $usuario->ubicacion }}" />
					</div>
				</div>
			 </form>
	  	</div>
	</div>
@endsection

