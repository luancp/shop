@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4><i class="fa fa-users"></i>&nbsp;&nbsp;Usuarios</h4>
	    <hr /><br />
    	<div class="table-responsive">
    		<table class="table table-condensed">
    			<thead>
    				<tr>
    					<th></th>
    					<th>Nombres</th>
    					<th>Usuario</th>
    					<th>Email</th>
    					<th>Estado</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($usuarios as $u)
    				<tr>
    					<td>
    						@if($u->imagen)
    						{{ HTML::image('img/avatars/'.$u->imagen, 'avatar', array('class'=>'img-circle', 'width'=>'30')) }}
    						@else
    						{{ HTML::image('img/avatars/default.png', 'avatar', array('class'=>'img-circle', 'width'=>'30')) }}
    						@endif
    					</td>
    					<td>
    						<a href="{{ URL::route('admin_usuario_consultar', $u->id) }}">{{ $u->getNombres() }}</a><br />
    						@if($u->cedula)
    						<span class="text-muted text-mini"><i class="fa fa-credit-card"></i>&nbsp;{{ $u->cedula }}</span>
    						@endif
    					</td>
    					<td>{{ $u->usuario }}</td>
    					<td>{{ $u->email }}</td>
    					<td>
    						@if($u->estado == 'A')
    							<strong class="text-success tooltip-estado" data-toggle="tooltip" data-placement="right" title="{{ $u->getEstadoDisplay() }}"><i class="fa fa-circle"></i></strong>
    						@endif
    						@if($u->estado == 'S')
    							<strong class="text-warning tooltip-estado" data-toggle="tooltip" data-placement="right" title="{{ $u->getEstadoDisplay() }}"><i class="fa fa-circle"></i></strong>
    						@endif
    						@if($u->estado == 'I')
    							<strong class="text-danger tooltip-estado" data-toggle="tooltip" data-placement="right" title="{{ $u->getEstadoDisplay() }}"><i class="fa fa-circle"></i></strong>
    						@endif
    					</td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    	<div class="text-center">
    		{{ $usuarios->links() }}
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
