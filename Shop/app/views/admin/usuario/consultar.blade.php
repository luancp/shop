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
    		<p><strong>{{ $usuario->getnombres() }}</strong></p>
    		@if($usuario->cedula)
    		<p><i class="fa fa-credit-card"></i>&nbsp;{{ $usuario->cedula }}</p>
    		@endif
    		<p><i class="fa fa-at"></i>&nbsp;{{ $usuario->email }}</p>
    		<p>
    			@if($usuario->estado == 'A')
					<strong class="label label-success">{{ $usuario->getEstadoDisplay() }}</strong>
				@endif
				@if($usuario->estado == 'S')
					<strong class="label label-warning">{{ $usuario->getEstadoDisplay() }}</strong>
				@endif
				@if($usuario->estado == 'I')
					<strong class="label label-danger">{{ $usuario->getEstadoDisplay() }}</strong>
				@endif
    		</p>
    		<p>
    			<hr />
    		</p>
    		<p class="">
    			<a class="btn btn-default btn-xs" href="{{ URL::route('admin_usuario_editar', $usuario->id) }}"><i class="fa fa-edit"></i>&nbsp;Editar</a>
    		</p>
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
