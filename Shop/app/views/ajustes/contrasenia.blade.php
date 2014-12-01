@extends('layouts.ajustes')

@section('css-header')
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
@endsection

@section('content')
	@if ($errors->has())
	<div class="alert alert-danger">
		<ul>
		@foreach ($errors->all('<li class="text-danger">:message</li>') as $error)
			{{ $error }}		
		@endforeach
		</ul>
    </div>
	@endif
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>Contrase&ntilde;a</h4>
	    <hr /><br />
	    <form class="form-horizontal" role="form" action="" method="post">
		  	<div class="form-group">
				<label class="col-sm-2 control-label">Contrase&ntilde;a Actual</label>
				<div class="col-sm-4">
			  		<input class="form-control" type="password" name="current_password" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Contrase&ntilde;a Nueva</label>
				<div class="col-sm-4">
			  		<input class="form-control" type="password" name="new_password" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Confirmar Contrase&ntilde;a</label>
				<div class="col-sm-4">
			  		<input class="form-control" type="password" name="confirm_password" />
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
