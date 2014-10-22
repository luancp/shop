@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4><i class="fa fa-users"></i>&nbsp;&nbsp;Usuario</h4>
	    <hr /><br />
    	<div class="col-md-3 col-sm-4">
    		@if($usuario->imagen)
    		{{ HTML::image('img/avatars/'.$usuario->imagen, 'avatar', array('class'=>'thumbnail')) }}
    		@else
    		{{ HTML::image('img/avatars/default.png', 'avatar', array('class'=>'thumbnail')) }}
    		@endif
    	</div>
    	<div class="col-md-9 col-sm-8">
    		<form role="form" action="{{ URL::route('admin_usuario_actualizar') }}" method="post">
    			<input type="hidden" name="id" value="{{ $usuario->id }}" />
	    		<div class="row">
	    			<div class="form-group col-md-6 col-sm-12">
						<label>Nombres</label>
						<input type="text" class="form-control input-sm" name="nombres" value="{{ $usuario->nombres }}"/>
					</div>
				</div>
	    		<div class="row">
	    			<div class="form-group col-md-6 col-sm-12">
						<label>Apellidos</label>
						<input type="text" class="form-control input-sm" name="apellidos" value="{{ $usuario->apellidos }}"/>
					</div>
				</div>
	    		<div class="row">
	    			<div class="form-group col-md-4 col-sm-6">
						<label>C&eacute;dula</label>
						<input type="text" class="form-control input-sm" name="cedula" value="{{ $usuario->cedula }}"/>
					</div>
				</div>
	    		<div class="row">
	    			<div class="form-group col-md-4 col-sm-6">
						<label>Email</label>
						<input type="email" class="form-control input-sm" name="email" value="{{ $usuario->email }}"/>
					</div>
				</div>
	    		<div class="row">
	    			<div class="form-group col-md-4 col-sm-6">
						<label>Estado</label>
						{{ Form::select('estado', 
		    				array(
		    					'A' => 'Activo',
		    					'S' => 'Suspendido',
		    					'I' => 'Inactivo'
		    				), $usuario->estado, array('class'=>'form-control input-sm')) 
		    			}}
					</div>
				</div>
	    		<p>
	    			<hr />
	    		</p>
	    		<p>
	    			<button class="btn btn-success btn-sm"><i class="fa fa-floppy-o"></i>&nbsp;Actualizar</button>
	    		</p>
	    	</form>
    	</div>
  	</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		$('.tooltip-estado').tooltip();
	});
</script>
@endsection
