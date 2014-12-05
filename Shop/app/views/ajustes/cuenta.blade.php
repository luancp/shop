@extends('layouts.ajustes')

@section('css-header')
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>Cuenta</h4>
	    <hr /><br />
	    <form class="form-horizontal" role="form" action="{{ URL::route('cuenta_actualizar') }}" method="post">
		  	<div class="form-group">
				<label class="col-sm-2 control-label">Usuario</label>
				<div class="col-sm-5">
			  		<input class="form-control" type="text" name="nombres" value="{{ $usuario->usuario }}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Email</label>
				<div class="col-sm-5">
			  		<input class="form-control" type="text" name="email" value="{{ $usuario->email }}" />
				</div>
			</div>
			<br /><hr /><br />
			<div class="form-group">
				<div class="col-sm-2">&nbsp;</div>
				<label class="col-sm-6" for="boletin">
					<input type="checkbox" id="boletin" name="boletin" />&nbsp;Recibir boletines informativos.
				</label>
			</div>
			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-2">
					<button class="btn btn-success" type="submit">Guardar Cambios</button>
				</div>
			</div>
		 </form>
  	</div>
@endsection
