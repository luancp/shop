@extends('layouts.carrito')

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
		<h4><i class="fa fa-heart"></i>&nbsp;&nbsp;Lista de Deseos</h4>
		<hr />
		<br />
	</div>
	<div class="col-md-12 col-sm-12">
		@if(count($lista) > 0)
		<div class="table-responsive">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th width="90"></th>
						<th>Productos</th>
						<th width="90"></th>
						<th width="90"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($lista as $w)
					<tr>
						<td>
						<p class="espacio-arriba">
							@if($w->producto->imagen)
							{{ HTML::image('img/productos/thumb_'.$w->producto->imagen, '', array('class'=>'img-rounded', 'width'=>'70')) }}
							@else
							{{ HTML::image('img/productos/default/thumb_default.png', '', array('class'=>'img-rounded', 'width'=>'70')) }}
							@endif
						</p></td>
						<td>
						<p class="espacio-arriba">
							<strong>{{ $w->producto->nombre }}</strong>
						</p></td>
						<td class="text-center">
							<form class="espacio-arriba form-horizontal" role="form" name="elminarProducto_{{ $w->id }}" action="{{ URL::route('wishlist_eliminar_producto') }}" method="post">
								<input type="hidden" name="eliminar" value="1" />
								<input type="hidden" name="id_prod" value="{{ $w->id }}" />
								<button class="text-mini btn btn-default btn-eliminar" type="submit" data-id="{{ $w->id }}">
									<i class="fa fa-trash"></i> Eliminar
								</button>
							</form>
						</td>
						<td class="text-center">
							<form class="espacio-arriba form-horizontal" role="form" name="moverProducto_{{ $w->id }}" action="{{ URL::route('wishlist_mover_producto') }}" method="post">
								<input type="hidden" name="mover" value="1" />
								<input type="hidden" name="id_wish" value="{{ $w->id }}" />
								<input type="hidden" name="id" value="{{ $w->producto->id }}" />
								<input type="hidden" name="prod_nombre" value="{{ $w->producto->nombre }}" />
								<input type="hidden" name="prod_imagen" value="{{ $w->producto->imagen }}" />
								<input type="hidden" name="prod_precio" value="{{ $w->producto->precio }}" />
								<button class="text-mini btn btn-default btn-mover" type="submit">
									<i class="fa fa-shopping-cart"></i> Mover al Carrito
								</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot style="border-top:3px solid #ddd;">
					<tr>
						<td colspan="3">Total items: <strong>{{ count($lista) }}</strong></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="clearfix">
			<hr />
			<br />
			<a class="pull-left" style="margin-top:8px;" href="{{ URL::route('principal') }}">Seguir comprando</a>
			<a class="pull-left" style="margin-top:8px;margin-left:5px;" href="{{ URL::route('carrito') }}">Mostrar con Carrito</a>
		</div>
		@else
		<div class="text-center">
			<h3 style="margin-top: 0"><small><i class="fa fa-frown-o text-muted"></i>&nbsp;&nbsp;No hay productos en la lista a&uacute;n.</small></h3>
			<br />
			<a href="{{ URL::route('principal') }}">Regresar a comprar</a>
			<br />
		</div>
		<br />
		@endif
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
			bootbox.confirm("Está seguro de eliminar el producto?", function(result) {
				if (result) {
					$(boton).closest('form').submit();
				}
			});
		});
	}); 
</script>
@endsection
