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
			<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Res&uacute;men de Compra
		</h4>
		<hr />
		<br />
	</div>
	<div class="col-md-12 col-sm-12">
		<strong>Direcci&oacute;n de Env&iacute;o</strong>
		<div class="well well-sm">
			<p>
				<strong>{{ $direccion->nombre }}</strong><br />
				<i><span>{{ $direccion->direccion }}</span></i><br />
				<i><small>{{ $direccion->referencia }}</small></i><br />
				<span>{{ $direccion->telefono }}</span>
			</p>
		</div>
		@if($compras)
		<div class="table-responsive">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th width="90"></th>
						<th>Productos</th>
						<th class="text-center">Precio</th>
						<th class="text-center" width="100">Cantidad</th>
						<th class="text-center">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					@foreach($compras as $c)
					<tr>
						<td>
						<p class="espacio-arriba">
							@if(array_get($c, 'imagen'))
							{{ HTML::image('img/productos/thumb_'.array_get($c, 'imagen'), '', array('class'=>'img-rounded', 'width'=>'70')) }}
							@else
							{{ HTML::image('img/productos/default/thumb_default.png', '', array('class'=>'img-rounded', 'width'=>'70')) }}
							@endif
						</p></td>
						<td>
						<p class="espacio-arriba">
							<a href="{{ URL::route('producto_venta', array_get($c, 'id')) }}"><strong>{{ array_get($c, 'nombre') }}</strong></a>
						</p></td>
						<td class="text-center">
						<p class="espacio-arriba">
							<strong>${{ number_format(array_get($c, 'precio'), 2) }}</strong>
						</p></td>
						<td class="text-center">
							<strong>{{ array_get($c, 'cantidad') }}</strong>
						</td>
						<td class="text-center">
						<p class="espacio-arriba">
							<strong>${{ number_format(array_get($c, 'precio')*array_get($c, 'cantidad'),2) }}</strong>
						</p></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot style="border-top:3px solid #ddd;">
					<tr>
						<td colspan="3">Total items: <strong>{{ count($compras) }}</strong></td>
						<td class="text-center"><strong class="gran-total espacio-arriba">Subtotal</strong></td>
						<td class="text-center"><strong class="gran-total espacio-arriba">${{ number_format($subtotal, 2) }}</strong></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3"><a href="{{ URL::route('carrito') }}">Editar el Carrito</a></td>
						<td class="text-center"><strong class="gran-total espacio-arriba">IVA</strong></td>
						<td class="text-center"><strong class="gran-total espacio-arriba">${{ number_format($iva, 2) }}</strong></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td class="text-center"><strong class="gran-total espacio-arriba">Total</strong></td>
						<td class="text-center"><strong class="gran-total espacio-arriba">${{ number_format($total, 2) }}</strong></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
		@endif
	</div>
	<div class="col-sm-12">
		<a href="{{ URL::route('compra_direccion') }}?direccion_id={{$direccion->id}}" class="btn btn-default btn-sm">
			<i class="fa fa-chevron-circle-left"></i>&nbsp;
			Anterior
		</a>
		<form class="pull-right" method="get" action="{{ URL::route('compra_pago') }}">
			<input type="hidden" id="id_direccion_id" name="direccion_id" value="{{ $direccion->id }}" />
			<button id="btn-siguiente" class="btn btn-primary btn-sm">
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
		$('button.btn-eliminar').tooltip();
		$('button.btn-eliminar').click(function(e) {
			e.preventDefault();
			var boton = $(this);
			var id_prod = $(this).attr('data-id');
			bootbox.confirm("Está seguro de eliminar el producto?", function(result) {
				if (result) {
					$(boton).closest('form').submit();
				}
			});
		});
		//para vaciar el carrito
		$('#btn-vaciar-carrito').click(function(e) {
			e.preventDefault();
			var boton = $(this);
			bootbox.confirm("Está seguro de vaciar todo el carrito?", function(result) {
				if (result) {
					location.href = $(boton).attr('href');
				}
			});
		});
		//para cuando cambia la cantidad
		$('.cantidad-carrito').change(function(e){
			$(this).next('button').removeClass('hide');
		});
	}); 
</script>
@endsection
