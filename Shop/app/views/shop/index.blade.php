@extends('layouts.default')

@section('css-header')
<style type="text/css">
	.bg-principal{
		height: 250px;
		background: url('{{ URL::asset("/img/".Session::get('empresa')->imagen_banner) }}') 0 0 no-repeat;
		background-size: cover;
		background-color: whitesmoke;
	}
</style>
@endsection

@section('sidebar')
	<ul class="list-group">
		@if($categorias)
		  	<a class="list-group-item @if($cat == '-1') active @endif" href="{{ URL::route('principal') }}">Todas las Categorias</a>
			@foreach($categorias as $c)
		  		<a class="list-group-item @if($cat == $c->id) active @endif" href="{{ URL::route('principal') }}?categoria={{ $c->id }}">{{ $c->nombre }}<span class="fa fa-angle-right pull-right"></span></a>
		  	@endforeach
	  	@endif
	</ul>
	@if(Session::has('empresa'))
		<hr />
		<br />
		<div class="text-center">
		@if(Session::get('empresa')->facebook_plugin_activo)
			{{ Session::get('empresa')->facebook_plugin_script }}
		@endif
		</div>
	@endif
@endsection

@section('content')
	<div id="img-principal" class="row hide">
		<div class="col-md-12 col-sm-12">
			<div class="bg-principal">
				<form class="form-vertical" action="" role="form">
					<br />
					<br />
					<div class="form-group col-md-4">
						<label>Colegio</label>
					    <select class="form-control input-sm">
					    	<option value="">Todos</option>
					    	<option value="">Todos</option>
					    	<option value="">Todos</option>
					    	<option value="">Todos</option>
					    	<option value="">Todos</option>
					    	<option value="">Todos</option>
					    </select>
					</div>
				</form>
			</div>
		</div>
		<div class="clearfix"><br /></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default btn-sm pull-left" id="btn-seleccionar-colegio"><i class="fa fa-angle-down"></i>&nbsp;Seleccionar Colegio</button>
			<form class="form-inline pull-right" action="" role="form">
				<div class="form-group">
					<label>Filtrar</label>
				    <select class="form-control input-sm">
				    	<option value="">Todos</option>
				    	<option value="">Todos</option>
				    	<option value="">Todos</option>
				    	<option value="">Todos</option>
				    	<option value="">Todos</option>
				    	<option value="">Todos</option>
				    </select>
				</div>
			</form>
		</div>
		<div class="clearfix"><br /></div>
	</div>
	<div class="row">
		@foreach($productos as $p)
		<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		    	@if($p->imagen)
		      	<a href="{{ URL::route('producto_venta', $p->id) }}"><img src="{{ URL::asset('img/productos/'.$p->imagen) }}" alt="{{ $p->nombre }}" /></a>
		      	@else
		      	<a href="{{ URL::route('producto_venta', $p->id) }}"><img src="{{ URL::asset('img/productos/default/venta_default.png') }}" alt="{{ $p->nombre }}" /></a>
		      	@endif
		      	<div class="caption">
		        	<a href="{{ URL::route('producto_venta', $p->id) }}"><h5>{{ $p->nombre }}<strong class="pull-right text-success">${{ number_format($p->precio, 2) }}</strong></h5></a>
		      	</div>
		    </div>
	  	</div>
	  	@endforeach
	</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		$("#btn-seleccionar-colegio").click(function(){
			var img_p = $("#img-principal");
			var img_button = $(this).find('i.fa');
			if(img_p.hasClass('hide')){
				img_p.removeClass('hide');
				img_button.removeClass('fa-angle-down');
				img_button.addClass('fa-angle-up');
			}else{
				img_p.addClass('hide');
				img_button.removeClass('fa-angle-up');
				img_button.addClass('fa-angle-down');
			}
		});
	});
</script>
@endsection