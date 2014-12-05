@extends('layouts.orden')

@section('css-header')
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
<style type="text/css" media="print">
	.btn-print{
		display: none;
	}
</style>
@endsection

@section('content')
	<div class="col-md-4 col-sm-4">
		<h4><small>Fecha</small><br />12/12/2014</h4>
	</div>
	<div class="col-md-4 col-sm-4">
		<h4><small># Orden</small><br />000-001</h4>
	</div>
	<div class="col-md-4 col-sm-4">
		<h4>
			<a href="#" onclick="window.print();" class="pull-right btn btn-default btn-print"><i class="fa fa-print"></i></a>
			<small>Total</small><br />
			$67.45
		</h4>
	</div>
	<div class="col-md-12 col-sm-12">
		<hr />
	</div>
	<div class="col-md-12 col-sm-12">
		<h4><small>Env&iacute;o</small><br />Av. Leopoldo Carrera, Edif. Olivos Business Center #104</h4>
	</div>
	<div class="col-md-12 col-sm-12">
		<hr />
	</div>
	<div class="col-md-12 col-sm-12">
		<br />
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th colspan="4">Detalle de Orden</th>
					</tr>
					<tr>
						<th width="60">Cantidad</th>
						<th>Producto</th>
						<th>Precio</th>
						<th class="text-right">Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Libro de Actividades</td>
						<td>$30.45</td>
						<td class="text-right"><strong>$30.45</strong></td>
					</tr>
					<tr>
						<td>1</td>
						<td>Nacho Lee 1</td>
						<td>$17.00</td>
						<td class="text-right"><strong>$17.00</strong></td>
					</tr>
					<tr>
						<td>1</td>
						<td>Cuaderno cuadriculado</td>
						<td>$13.00</td>
						<td class="text-right"><strong>$13.00</strong></td>
					</tr>
					<tr class="active">
						<td><strong>3 items</strong></td>
						<td colspan="3" class="text-right"><strong>Total:&nbsp;&nbsp;&nbsp;$67.45</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection
