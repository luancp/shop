@extends('layouts.default')

@section('css-header')
<style type="text/css">
	.bg-principal{
		height: 400px;
		background: url('{{ URL::asset("/img/".Session::get('empresa')->imagen_banner) }}') 0 0 no-repeat;
		background-size: cover;
		background-color: whitesmoke;
	}
	.form-filtros{
		margin: 10px 20px 10px 10px;
		padding-top: 10px;
		padding-bottom: 10px;
		min-height: 310px;
		margin-top: 45px;
		background: url('{{ URL::asset("/img/bg_banner.png") }}') 0 0 repeat;
	}
	#precio-total-curso{
		font-weight: bold;
		color: green;
		font-size: 15px;
	}
	.form-group{
		margin-bottom: 15px;
	}
	label{
		margin-bottom: 0;
	}
	.titulo-listas{
		color: green;
		font-weight: bold;
	}
	.titulo-colegio{
		margin: 0;
		font-weight: bold;
	}
	#btn-curso-agregar-todos, #btn-curso-explorar-lista, #btn-curso-consultar{
		color: #288088;
		font-weight: bold;
	}
	.btn-seleccionar-colegio{
		color: green!important;
		border: none;
		font-weight: bold;
		padding-top: 7px;
	}
	.list-group-item-submenu{
		/*background-color: #F5F5F5;*/
		padding-left:25px!important;
	}
	.list-group-item {
		padding: 10px 10px;
	}
	.bg-filter{
		background-color: #f0f1f2;
	}
</style>
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
@endsection

@section('sidebar')
	<ul class="list-group">
		@if($categorias)
		  	<a class="list-group-item @if($cat == '-1') active @endif" href="{{ URL::route('principal') }}">Todas las Categorias</a>
			@foreach($categorias as $c)
		  		@if($c->tieneHijos())
		  		<a class="list-group-item tiene-hijos @if($cat == $c->id) active @endif" data-toggle="collapse" href="#{{ $c->id }}">{{ $c->nombre }}<span class="fa fa-angle-down pull-right"></span></a>
		  		@else
		  		<a class="list-group-item @if($cat == $c->id) active @endif" href="{{ URL::route('principal') }}?categoria={{ $c->id }}">{{ $c->nombre }}</a>
		  		@endif
	  			<div id="{{ $c->id }}" class="collapse">
	  				@foreach($c->getHjios as $h)
			  			<a class="list-group-item list-group-item-success list-group-item-submenu @if($cat == $h->id) active item-desplegado @endif" data-padre="{{ $c->id }}" href="{{ URL::route('principal') }}?categoria={{ $h->id }}">{{ $h->nombre }}</a>
				  	@endforeach
	  			</div>
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
<div class="bg-principal">
	<form class="col-md-5 col-sm-5 form-filtros" action="" role="form" method="get">
		<div class="form-group col-md-12 col-sm-12">
			<h3 class="titulo-listas"><i class="fa fa-check-square-o"></i>&nbsp;Listas por Colegio</h3>
		</div>
		<div class="form-group col-md-12 col-sm-12">
			<label>Seleccionar Colegio</label>
		    <input id="select-colegios" name="colegio" class="form-control input-sm" value="{{Input::has('colegio')?Input::get('colegio'):''}}" />
		</div>
		<div class="form-group col-md-12 col-sm-12">
			<label>Seleccionar Curso</label>
		    <input id="select-cursos" name="curso" class="form-control input-sm cursos-seleccion" value="{{Input::has('curso')?Input::get('curso'):''}}" />
		</div>
		<div id="total-curso" class="form-group col-md-12 col-sm-12 hide">
			<label>Precio Estimado de la Lista</label>
		    <div id="precio-total-curso"></div>
		</div>
		<div class="form-group">
			<button id="btn-curso-consultar" class="btn btn-link" type="submit" disabled="disabled"><i class="fa fa-search"></i>&nbsp;Consultar</button>
			<button id="btn-curso-agregar-todos" class="btn btn-link hide" data-href="{{ URL::route('agregar_carrito_todos') }}?" disabled="disabled"><i class="fa fa-shopping-cart"></i>&nbsp;Agregar Todos</button>
			<button id="btn-curso-explorar-lista" class="btn btn-link hide" type="submit" disabled="disabled"><i class="fa fa-bars"></i>&nbsp;Explorar Lista</button>
			<div class="clearfix"></div>
		</div>
	</form>
</div>
<br />
@endsection

@section('content')
	<div id="img-principal" class="row hide">
		<div class="col-md-12 col-sm-12">
			
			<div class="clearfix"><br /></div>
		</div>
		<div class="clearfix"><br /></div>
	</div>
	<div class="col-md-12 col-sm-12 bg-filter">
		<div class="">
			<h5 class="pull-left">
				Mostrando desde: <strong>{{ $productos->getFrom() }}</strong>&nbsp;
				hasta: <strong>{{ $productos->getTo() }}</strong> de un total <strong>{{ $productos->getTotal() }}</strong>
			</h5>
			<span class="pull-right" style="margin-top:3px;">
				<select class="form-control input-sm">
					<option value="-"></option>
					<option value="N">Nombre</option>
					<option value="P">Precio</option>
				</select>
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
			      	<a href="{{ URL::route('producto_venta', $p->id) }}"><img src="{{ URL::asset('img/productos/'.$p->imagen) }}" alt="{{ $p->nombre }}" /></a>
			      	@else
			      	<a href="{{ URL::route('producto_venta', $p->id) }}"><img src="{{ URL::asset('img/productos/default/venta_default.png') }}" alt="{{ $p->nombre }}" /></a>
			      	@endif
			      	<div class="caption">
			        	<a href="{{ URL::route('producto_venta', $p->id) }}"><h5 title="{{ $p->nombre }}">{{ str_limit($p->nombre, $limit=20, $end='...') }}<strong class="pull-right text-success">${{ number_format($p->precio, 2) }}</strong></h5></a>
			      	</div>
			    </div>
		  	</div>
	  	@endforeach
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			{{ $productos->appends(array('curso' => Input::get('curso'), 'colegio' => Input::get('colegio')))->links() }}
		</div>
	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/jquery.shuffle.min.js') }}
<script type="text/javascript">
	var colegios = null;
	var cursos = null;
	
	function format(item) { return item.nombre; }
	
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
			})
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
				   },
				   success: function(data){
				   	  $('#total-curso').removeClass('hide');
				   	  $('#precio-total-curso').text("$"+data.total);
					  
					  if(data.total > 0){
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
			})
		});
		
		//verifica los campos en el get
		@if(Input::has('colegio'))
			$('#select-colegios').trigger('change');
		@endif
		@if(Input::has('curso'))
			$('#select-cursos').trigger('change');
		@endif
		
		$("#btn-curso-agregar-todos").click(function(e){
			e.preventDefault();
			location.href = $(this).attr('data-href');
		});
		
		$('.tiene-hijos').click(function(e){
			if($(this).find('span.fa').hasClass('fa-angle-down')){
				$(this).find('span.fa').removeClass('fa-angle-down').addClass('fa-angle-up');				
			}else{
				$(this).find('span.fa').removeClass('fa-angle-up').addClass('fa-angle-down');
			}
		});
		
		$('a[href="#'+$('.item-desplegado').attr('data-padre')+'"]').trigger('click');
	});
</script>
@endsection