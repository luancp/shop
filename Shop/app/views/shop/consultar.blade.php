@extends('layouts.default')

@section('css-header')
{{ HTML::style('css/shop.css') }}
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
<style type="text/css">
	.bg-principal{
		height: 400px;
		background: url('{{ URL::asset("/img/".Session::get('empresa')->imagen_banner) }}') 0 0 no-repeat;
		background-size: cover;
		background-color: whitesmoke;
	}
	.form-filtros{
		margin: 10px 10px 10px 10px;
		padding-top: 10px;
		padding-bottom: 10px;
		min-height: 380px;
		background: url('{{ URL::asset("/img/bg_banner.png") }}') 0 0 repeat;
	}
</style>
@endsection

@section('sidebar')
	<ul class="list-group">
		<a class="list-group-item btn-seleccionar-colegio" href="{{ URL::route('principal') }}"><i class="fa fa-arrow-left"></i>&nbsp;Volver a Seleccionar Colegio</a>
	</ul>
	<ul class="list-group">
		@if($categorias)
		  	<a class="list-group-item @if($cat == '-1') active @endif" href="?colegio={{Input::get('colegio')}}&curso={{Input::get('curso')}}&categoria=-1">Todas las Categorias</a>
			@foreach($categorias as $c)
		  		@if($c->tieneHijos())
		  		<a class="list-group-item tiene-hijos @if($cat == $c->id) active @endif" data-toggle="collapse" href="#{{ $c->id }}" data-id="{{ $c->id }}">{{ $c->nombre }}<span class="icon-padre fa fa-angle-down pull-right"></span></a>
	  			<div id="{{ $c->id }}" class="hijo-tiene-hijos collapse">
	  				@foreach($c->getHjios as $h)
			  			<a class="list-group-item list-group-item-success list-group-item-submenu @if($cat == $h->id) active item-desplegado @endif" data-padre="{{ $c->id }}" href="?categoria={{ $h->id }}&colegio={{Input::get('colegio')}}&curso={{Input::get('curso')}}">{{ $h->nombre }}</a>
				  	@endforeach
	  			</div>
		  		@else
		  		<a class="list-group-item @if($cat == $c->id) active @endif" href="?categoria={{ $c->id }}&colegio={{Input::get('colegio')}}&curso={{Input::get('curso')}}">{{ $c->nombre }}</a>
		  		@endif
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

@section('bg-ventas')

@endsection

@section('content')
	<div id="img-principal" class="row hide">
		<div class="col-md-12 col-sm-12">
			
			<div class="clearfix"><br /></div>
		</div>
		<div class="clearfix"><br /></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- para los filtros -->
			@if(Session::has('colegio'))
				<h3 class="titulo-colegio">{{ Session::get('colegio') }}&nbsp;<small>{{ Session::get('curso') }}</small><a id="btn-curso-explorar-lista" class="btn btn-link pull-right" href="{{ URL::route('agregar_carrito_todos') }}?colegio={{ Input::get('colegio') }}&curso={{ Input::get('curso') }}"><i class="fa fa-shopping-cart"></i>&nbsp;Comprar Lista</a></h3>
			@endif
		</div>
		<div class="clearfix"><br /></div>
	</div>
	<div class="col-md-12 col-sm-12 bg-filter">
		<div class="">
			<h5 class="pull-left">
				Mostrando desde: <strong>{{ $productos->getFrom() }}</strong>&nbsp;
				hasta: <strong>{{ $productos->getTo() }}</strong> de un Total: <strong>{{ $productos->getTotal() }}</strong>
			</h5>
			<span class="pull-right" style="margin-top:3px;">
				<form class="" name="form_filtros" action="{{ URL::route('principal') }}" method="get">
					<input type="hidden" name="categoria" value="{{ $cat }}" />
					<input type="hidden" name="colegio" value="{{ Input::get('colegio') }}" />
					<input type="hidden" name="curso" value="{{ Input::get('curso') }}" />
					<input type="hidden" name="page" value="{{ Input::get('page') }}" />
					<select class="form-control input-sm" id="select-filtros" name="filtro">
						<option value="-">Filtro</option>
						<option value="N" @if(Input::get('filtro')=='N')selected="true"@endif>Nombre</option>
						<option value="P" @if(Input::get('filtro')=='P')selected="true"@endif>Precio</option>
					</select>
				</form>
			</span>
		</div>
	</div>
	<div class="col-md-12 col-sm-12">
		<br />
	</div>
	<div class="row">
		@foreach($productos as $p)
			<div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
			    	@if($p->imagen)
			      	<a href="{{ URL::route('producto_venta', $p->id) }}?categoria={{Input::get('categoria')}}&colegio={{Input::get('colegio')}}&curso={{Input::get('curso')}}"><img src="{{ URL::asset('img/productos/'.$p->imagen) }}" alt="{{ $p->nombre }}" /></a>
			      	@else
			      	<a href="{{ URL::route('producto_venta', $p->id) }}?categoria={{Input::get('categoria')}}&colegio={{Input::get('colegio')}}&curso={{Input::get('curso')}}"><img src="{{ URL::asset('img/productos/default/venta_default.png') }}" alt="{{ $p->nombre }}" /></a>
			      	@endif
			      	<div class="caption">
			        	<a href="{{ URL::route('producto_venta', $p->id) }}?categoria={{Input::get('categoria')}}&colegio={{Input::get('colegio')}}&curso={{Input::get('curso')}}"><h5 title="{{ $p->nombre }}">{{ str_limit($p->nombre, $limit=20, $end='...') }}<strong class="pull-right text-success">${{ number_format($p->precio, 2) }}</strong></h5></a>
			      	</div>
			    </div>
		  	</div>
	  	@endforeach
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			{{ $productos->links() }}
		</div>
	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/jquery.shuffle.min.js') }}
{{ HTML::script('js/shop.js') }}
<script type="text/javascript">
	$(function(){
		//verifica los campos en el get
		@if(Input::has('colegio'))
			$('#select-colegios').trigger('change');
		@endif
		@if(Input::has('curso'))
			$('#select-cursos').trigger('change');
		@endif
		
		var ajaxColegios = $.ajax({
			   url: '{{ URL::route("get_colegios_principal") }}',
			   type: 'POST',
			   dataType: 'json',
			   async: true,
			   data: {
			      
			   },
			   beforeSend: function() {
			      
			   },
			   error: function() {
			      colegios = [];
			   },
			   success: function(data) {
			   	  colegios = data;
			   },
		});
		
		$.when(ajaxColegios).done(function(){
			$('#select-colegios').select2({
				data:{ results: colegios, text: 'nombre' },
			    formatSelection: format,
			    formatResult: format
			});
		});
		
		//para cuando elige el colegio
		$('#select-cursos').select2({data: []});
		$('#select-colegios').on('change', function(){
			$('.cursos-seleccion').removeClass('hide');
			var colegio_id = $(this).val();
			var ajaxCursos = $.ajax({
				   url: '{{ URL::route("get_cursos_principal") }}',
				   type: 'POST',
				   dataType: 'json',
				   async: true,
				   data: {
				      'colegio_id': colegio_id,
				   },
				   beforeSend: function() {
				      
				   },
				   error: function() {
				      cursos = [];
				   },
				   success: function(data) {
				   	  cursos = data;
				   },
			});
			
			$.when(ajaxCursos).done(function(){
				$('#select-cursos').select2({
					data:{ results: cursos, text: 'nombre' },
				    formatSelection: format,
				    formatResult: format
				});
			});
		});
		
		//selecciona el curso
		$('#select-cursos').on('change', function(e){
			
			$('#btn-curso-consultar').attr('disabled', false);
			
		});
		
		$('#btn-curso-consultar').click(function(e){
			e.preventDefault();
			var ajaxCurso = $.ajax({
				   url: '{{ URL::route("get_curso_total") }}',
				   type: 'POST',
				   dataType: 'json',
				   async: true,
				   data: {
				      'curso_id': $('#select-cursos').val(),
				   },
				   beforeSend: function() {
				      
				   },
				   error: function() {
				      $('#total-curso').removeClass('hide');
				   	  $('#precio-total-curso').text("$0.00");
				      
				      $('#total-comp').removeClass('hide');
				   	  $('#precio-total-comp').text("$0.00");
				   },
				   success: function(data){
				   	  $('#total-curso').removeClass('hide');
				   	  $('#precio-total-curso').text("$"+data.total_prod);
				   	  $('#total-comp').removeClass('hide');
				   	  $('#precio-total-comp').text("$"+data.total_comp);
					  
					  if(data.total_prod > 0){
						  $('#btn-curso-explorar-lista').removeClass('hide');
						  $('#btn-curso-explorar-lista').attr('disabled', false);
						  $('#btn-curso-agregar-todos').removeClass('hide');
						  $('#btn-curso-agregar-todos').attr('disabled', false);
						  
						  var url_href = $("#btn-curso-agregar-todos").attr('data-href');
						  url_href = url_href + 'colegio=' + $('#select-colegios').val() + '&curso=' + $('#select-cursos').val();
						  $("#btn-curso-agregar-todos").attr('data-href', url_href);
				      }else{
				      	  $('#btn-curso-explorar-lista').addClass('hide');
						  $('#btn-curso-explorar-lista').attr('disabled', true);
						  $('#btn-curso-agregar-todos').addClass('hide');
						  $('#btn-curso-agregar-todos').attr('disabled', true);
				      }
				   },
			});
			$.when(ajaxCurso).done(function(){
			});
		});
	});
</script>
@endsection