@extends('layouts.pago')

@section('css-header')
<style type="text/css">
	.text-mini {
		font-size: 12px;
	}
	.espacio-arriba {
		padding-top: 10px;
	}
	.gran-total {
		font-size: 15px;
	}
</style>
@endsection

@section('sidebar-right')
	
@endsection

@section('content')
<div class="bg-white">
	<div class="col-md-12">
		<h4>
			<i class="fa fa-cab"></i>&nbsp;&nbsp;Direcci&oacute;n de Env&iacute;o
		</h4>
		<hr />
		<br />
	</div>
	<div class="col-md-12 col-sm-12">
		@if(count($direcciones) > 0)
			@foreach($direcciones as $d)
				<div class="well well-sm">
					<p>
						<strong>{{ $d->nombre }}</strong><br />
						<i><span>{{ $d->direccion }}</span></i><br />
						<i><small>{{ $d->referencia }}</small></i><br />
						<span>{{ $d->telefono }}</span>
					</p>
					<h4 style="margin-bottom:0;">
						<i id="icon-selected_{{$d->id}}" class="fa fa-circle-o text-success icon-selected"></i>
						<a id="btn-dir-select" data-id="{{$d->id}}" class="btn btn-primary btn-xs">
							Usar esta direcci&oacute;n
						</a>
						<a class="btn btn-xs btn-link" href="#">Editar esta Direcci&oacute;n</a>
					</h4>
				</div>
			@endforeach
		@else
		
		@endif
	</div>
	@if(count($direcciones) < 3)
		<div class="col-md-12 col-sm-12">
			<hr />
			<h4>Agregar Dirección Nueva</h4>
			@if($errors->has())
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all('<li class="text-danger">:message</li>') as $error)
					{{ $error }}		
				@endforeach
				</ul>
		    </div>
			@endif
			<form class="form-horizontal" method="post" action="{{ URL::route('guardar_direccion') }}">
				<div class="form-group">
					<div class="col-sm-5">
						<label>Nombres</label>
						<input type="text" class="form-control input-sm" name="nombre" value="{{ Input::old('nombre') }}" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
						<label>Direcci&oacute;n</label>
						<input type="text" class="form-control input-sm" name="direccion" value="{{ Input::old('direccion') }}" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
						<label>Tel&eacute;fono</label>
						<input type="text" class="form-control input-sm" name="telefono" value="{{ Input::old('telefono') }}" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
						<label>Referencia</label>
						<input type="text" class="form-control input-sm" name="referencia" value="{{ Input::old('referencia') }}" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
						<button class="btn btn-success btn-sm">
							<span class="fa fa-floppy-o"></span>
							&nbsp;Guardar Direcci&oacute;n
						</button>
					</div>
				</div>
			</form>
		</div>
	@endif
	<div class="col-sm-12">
		<a href="{{ URL::route('carrito') }}" class="btn btn-default btn-sm">
			<i class="fa fa-chevron-circle-left"></i>&nbsp;
			Anterior
		</a>
		<form class="pull-right" method="get" action="{{ URL::route('compra_resumen') }}">
			<input type="hidden" id="id_direccion_id" name="direccion_id" value="" />
			<button id="btn-siguiente" class="btn btn-primary btn-sm" disabled="true">
				Siguiente&nbsp;
				<i class="fa fa-chevron-circle-right"></i>
			</button>
		</form>
	</div>
	<div class="clearfix">
		<br />
	</div>
</div>

@endsection

@section('js-footer')
{{ HTML::script('js/bootbox.min.js') }}
<script type="text/javascript">
	$(function() {
		$('a[id$="btn-dir-select"]').click(function(e){
			e.preventDefault();
			var id_icon = $(this).attr('data-id');
			$('i.icon-selected').removeClass('fa-check-circle').addClass('fa-circle-o');
			$('#icon-selected_'+id_icon).removeClass('fa-circle-o').addClass('fa-check-circle');
			
			$('#id_direccion_id').val(id_icon);
			$('#btn-siguiente').attr('disabled', false);
		});
		
		@if(isset($direccion_id))
			$('a[data-id="{{$direccion_id}}"]').trigger('click');
		@endif
	}); 
</script>
@endsection
