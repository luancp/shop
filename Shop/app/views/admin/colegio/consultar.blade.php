@extends('layouts.admin')

@section('css-header')
<style type="text/css">
	.text-mini-cart {
		color: #AAAAAA;
		font-size: 12px;
	}
	.bg-selected {
		background-color: #d9edf7;
	}
</style>
@endsection

@section('content')
<div class="col-sm-12 col-md-12 bg-white">
	<h4><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Colegio </h4>
	<hr />
	<br />
	<div class="col-md-5 col-sm-5">
		@if($colegio->imagen)
		<img class="croppedImg" src="{{ URL::asset('img/colegios/'.$colegio->imagen) }}" width="200" />
		@endif
	</div>
	<div class="col-md-7 col-sm-7">
		<h4>{{ $colegio->nombre }}</h4>
		<p>
			<hr />
		</p>
		<p>
			<a class="btn btn-default btn-xs" href="{{ URL::route('admin_colegio_modificar', $colegio->id) }}"><i class="fa fa-edit"></i>&nbsp;Editar</a>
		</p>
	</div>
	<div class="col-md-12">
		&nbsp;
		<hr />
		<br />
	</div>
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<strong>Cursos</strong><a class="btn btn-default btn-xs pull-right" href="{{ URL::route('admin_colegio_admin_curso', $colegio->id) }}"><i class="fa fa-cog"></i>&nbsp;Administrar</a>
					</div>
					<!-- List group -->
					<ul class="list-group">
						@if(count($colegio->cursos) > 0)
						@foreach($colegio->cursos as $c)
						<li class="list-group-item" id="{{ $c->id }}">
							<a class="item-curso" data-name="{{ $c->nombre }}" data-id="{{ $c->id }}" href="#">{{ $c->nombre }}</a>
						</li>
						@endforeach
						@else
						<li class="list-group-item text-center" id="">
							No hay cursos creados
							<br />
							<a class="btn btn-default btn-xs btn-link" href="{{ URL::route('admin_colegio_admin_curso', $colegio->id) }}"><i class="fa fa-plus-circle"></i>&nbsp;Crear un Curso Ahora</a>
						</li>
						@endif
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading" id="head-list">
						<strong>Lista por Curso</strong>
					</div>
					<!-- List group -->
					<ul class="list-group" id="lista-productos-curso">
						<li class="list-group-item text-center curso-list-load">
							Seleccione un curso
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function() {
		$('.item-curso').click(function(e) {
			e.preventDefault();
			$('#head-list').html("<strong>" + $(this).attr('data-name') + "</strong>");
			$('.lista-productos').removeClass('hide');
			$('.agregar-producto').removeClass('hide');
			$('#lista-productos-curso').find('li.curso-list').remove();

			//le quita y le agrega la clase con color de fondo a los items
			$('li.list-group-item').removeClass('bg-selected');
			$(this).closest('li.list-group-item').addClass('bg-selected');
			
			//ajax trae los productos de la lista
			$.ajax({
				url: '{{ URL::route('admin_colegio_get_lista_curso') }}',
				type: 'POST',
				dataType: 'json',
				async: true,
				data: {
				'id-curso': $(this).attr('data-id'),
				},
				beforeSend: function() {
					$('.curso-list-load').html('<span class="fa fa-spinner fa-spin"></span>&nbsp;');
				}, error: function() {
					$('.curso-list-load').html('A ocurrido un error.');
				}, success: function(data) {
					if (data.length == 0) {
						$('.curso-list-load').html('No hay productos en la lista').removeClass('hide');
					} else {
						$.each(data, function(k, v) {
							$('#lista-productos-curso').append('<li class="list-group-item curso-list"><button data-id="' + v.id + '" class="text-danger btn btn-xs delete-item"><i class="fa fa-minus-circle"></i></button>&nbsp;' + v.producto + '<span class="text-mini-cart">(' + v.cantidad + ')</span></li>');
						});
						//agrega el producto a la lista
	
						$('.curso-list-load').html('').addClass('hide');
					}
				},
			});
			//agrega el id del curso al form
			$('#id-curso').val($(this).attr('data-id'));
		});
	});
</script>
@endsection

