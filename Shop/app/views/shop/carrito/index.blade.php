@extends('layouts.default')

@section('css-header')
<style type="text/css">
	.text-mini{
		font-size: 12px;
	}
	.espacio-arriba{
		padding-top: 10px;
	}
	.gran-total{
		font-size: 15px;		
	}
</style>
@endsection

@section('sidebar')
	<!-- <ul class="list-group">
	  <a class="list-group-item" href=""><span class="badge">14</span>Categoria</a>
	  <a class="list-group-item" href=""><span class="badge">3</span>Categoria 2</a>
	  <a class="list-group-item active" href=""><span class="badge">0</span>Categoria 3</a>
	  <a class="list-group-item" href=""><span class="badge">5</span>Categoria 4</a>
	  <a class="list-group-item" href=""><span class="badge">30</span>Categoria 5</a>
	</ul> -->
@endsection

@section('content')
	<div class="bg-white">
		<div class="col-md-12">
			<h4>
				<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Mis Compras
				@if($compras)
					<a class="btn btn-success btn-xs pull-right" href="{{ URL::route('principal') }}">Checkout</a>
				@endif
			</h4>
		    <hr /><br />
	    </div>
		<div class="col-md-12 col-sm-12">
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
							<th></th>
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
									{{ HTML::image('img/productos/thumb_default.png', '', array('class'=>'img-rounded', 'width'=>'70')) }}
								@endif
								</p>
							</td>
							<td>
								<p class="espacio-arriba">
									<strong>{{ array_get($c, 'nombre') }}</strong>
								</p>
							</td>
							<td class="text-center">
								<p class="espacio-arriba">
									<strong>${{ number_format(array_get($c, 'precio'), 2) }}</strong>
								</p>
							</td>
							<td class="text-center">
								<form class="espacio-arriba" role="form" name="elminarProducto_{{ array_get($c, 'id') }}" action="{{ URL::route('carrito_actualizar_producto') }}" method="post">
									<input type="hidden" name="id_prod" value="{{ array_get($c, 'id') }}" />
									<input class="form-control input-sm" type="number" name="cantidad" value="{{ array_get($c, 'cantidad') }}" />
									<button class="text-mini btn-link" type="submit"><span class="fa fa-refresh"></span>&nbsp;Actualizar</button>
								</form>
							</td>
							<td class="text-center">
								<p class="espacio-arriba">
									<strong>${{ number_format(array_get($c, 'precio')*array_get($c, 'cantidad'),2) }}</strong>
								</p>
							</td>
							<td class="text-center">								
								<form class="espacio-arriba" role="form" name="elminarProducto_{{ array_get($c, 'id') }}" action="{{ URL::route('carrito_eliminar_producto') }}" method="post">
									<input type="hidden" name="eliminar" value="1" />
									<input type="hidden" name="id_prod" value="{{ array_get($c, 'id') }}" />
									<button class="text-mini btn-link btn-eliminar" type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar" data-id="{{ array_get($c, 'id') }}">
										<i class="fa fa-times-circle text-danger"></i>
									</button>
								</form>								
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot style="border-top:3px solid #ddd;">
						<tr>
							<td colspan="3">Total items: <strong>{{ $items }}</strong></td>
							<td class="text-center"><strong class="gran-total espacio-arriba">Total</strong></td>
							<td class="text-center"><strong class="gran-total espacio-arriba">${{ number_format($total, 2) }}</strong></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="">
				<hr />
				<br />
				<a class="pull-left" style="margin-top:8px;" href="{{ URL::route('principal') }}">Seguir comprando</a>
				<a class="btn btn-success pull-right" href="{{ URL::route('principal') }}">Checkout</a>
			</div>
			@else
				<div class="text-center">
					<h3 style="margin-top: 0">
						<small><i class="fa fa-frown-o text-muted"></i>&nbsp;&nbsp;No has realizado compras aun.</small>
					</h3>
					<br />
					<a href="{{ URL::route('principal') }}">Ir a comprar</a>
					<br />
				</div>
				<br />
			@endif
		</div>
		<div class="clearfix"><br /></div>
	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/bootbox.min.js') }}
<script type="text/javascript">
	$(function(){
		$('button.btn-eliminar').tooltip();
		$('button.btn-eliminar').click(function(e){
			e.preventDefault();
			var boton = $(this);
			var id_prod = $(this).attr('data-id');
			bootbox.confirm("Está seguro de eliminar el producto?", function(result){
                if(result){
                	$(boton).closest('form').submit();
                }
            });
		});
	});
</script>
@endsection
