@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Colegios
	    	<a id="btn-sincronizar" class="btn btn-success btn-xs pull-right" href="{{ URL::route('admin_colegio_registrar') }}">
    			<i class="fa fa-plus"></i>&nbsp;<span class="text-sincronizar">Agregar Colegio</span>
    		</a>
	    </h4>
	    <hr /><br />
    	<div class="table-responsive">
    		<table class="table table-condensed">
    			<thead>
    				<tr>
    					<th></th>
    					<th>Nombre</th>
    					<th>Listas</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($colegios as $c)
    				<tr>
    					<td>
    						<img src="{{ URL::asset('img/colegio/'.$c->imagen) }}" alt="{{ $c->colegio }}" width="100" />
    					</td>
    					<td>
    						<a href="{{ URL::route('admin_colegio_consultar', $u->id) }}">{{ $c->nombre }}</a>
    					</td>
    					<td>
    						{{ $c->id }}
    					</td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    	<div class="text-center">
    		{{ $colegios->links() }}
    	</div>
  	</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		
	});
</script>
@endsection
