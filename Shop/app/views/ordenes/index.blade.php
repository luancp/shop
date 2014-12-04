@extends('layouts.orden')

@section('css-header')
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
@endsection

@section('content')
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Fecha</th>
					<th># Orden</th>
					<th>Env&iacute;o</th>
					<th class="text-center">Total</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>12/12/2014</td>
					<td><a href="#">000-001</a></td>
					<td>Contifico(Zukalo S.A.)</td>
					<td class="text-center"><strong>$67.45</strong></td>
					<td class="text-center">
						<a class="btn btn-link btn-xs" href="#"><i class="fa fa-eye"></i></a>
						<a class="btn btn-link btn-xs" href="#"><i class="fa fa-print"></i></a>
					</td>
				</tr>
				<tr>
					<td>12/12/2014</td>
					<td><a href="#">000-001</a></td>
					<td>Contifico(Zukalo S.A.)</td>
					<td class="text-center"><strong>$67.45</strong></td>
					<td class="text-center">
						<a class="btn btn-link btn-xs" href="#"><i class="fa fa-eye"></i></a>
						<a class="btn btn-link btn-xs" href="#"><i class="fa fa-print"></i></a>
					</td>
				</tr>
				<tr>
					<td>12/12/2014</td>
					<td><a href="#">000-001</a></td>
					<td>Contifico(Zukalo S.A.)</td>
					<td class="text-center"><strong>$67.45</strong></td>
					<td class="text-center">
						<a class="btn btn-link btn-xs" href="#"><i class="fa fa-eye"></i></a>
						<a class="btn btn-link btn-xs" href="#"><i class="fa fa-print"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection
