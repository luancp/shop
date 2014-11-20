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
    					<th width="100"></th>
    					<th>Nombre</th>
    					<th>Cursos</th>
    					<th>Listas</th>
    					<th>Acciones</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($colegios as $c)
    				<tr>
    					<td>
    						@if($c->imagen)
    							<img src="{{ URL::asset('img/colegios/'.$c->imagen) }}" alt="{{ $c->nombre }}" width="60" />
    						@else
    							<img src="{{ URL::asset('img/colegios/default/default.png') }}" alt="{{ $c->nombre }}" width="60" />
    						@endif
    					</td>
    					<td>
    						<a href="{{ URL::route('admin_colegio_consultar', $c->id) }}">{{ $c->nombre }}</a>
    					</td>
    					<td>
    						{{ count($c->cursos) }}
    					</td>
    					<td>
    						{{ $c->id }}
    					</td>
    					<td>
    						<div class="dropdown">
								<button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-cog"></i>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
									<li role="presentation"><a class="" href="{{ URL::route('admin_colegio_modificar', $c->id) }}" role="menuitem" tabindex="-1"><i class="fa fa-edit"></i>&nbsp;Editar</a></li>
									<li role="presentation"><a class="btn-eliminar" href="{{ URL::route('admin_colegio_eliminar', $c->id) }}" role="menuitem" tabindex="-1"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a></li>
									<li class="divider"></li>
									<li role="presentation"><a class="" href="{{ URL::route('admin_colegio_admin_curso', $c->id) }}" role="menuitem" tabindex="-1"><i class="fa fa-cog"></i>&nbsp;Cursos</a></li>
								</ul>
							</div>
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
{{ HTML::script('js/bootbox.min.js') }}
<script type="text/javascript">
	$(function(){
		$('a.btn-eliminar').click(function(e){
			e.preventDefault();
			var loc = $(this).attr('href');
			bootbox.confirm("Está seguro de eliminar el colegio?\nSe eliminarán todos los cursos y listas.", function(result){
                if(result){
                	location.href = loc;
                }
            });
		});
	});
</script>
@endsection
