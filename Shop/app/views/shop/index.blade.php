@extends('layouts.default')

@section('css-header')
<style type="text/css">
	.bg-principal{
		height: 250px;
		background: url('{{ URL::asset("/img/".Session::get('empresa')->imagen_banner) }}') 0 0 no-repeat;
		background-size: cover;
		background-color: whitesmoke;
	}
	.form-filtros{
		margin: 10px 20px 10px 10px;
		padding-top: 10px;
		padding-bottom: 10px;
		height: 230px;
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
</style>
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
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
				<form class="clearfix col-md-5 col-sm-5 form-filtros" action="" role="form" method="get">
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
					<div class="form-group col-md-12 col-sm-12">
						<button id="btn-curso-consultar" class="btn btn-sm btn-primary" type="submit" disabled="disabled">Consultar</button>
					</div>
				</form>
			</div>
			<div class="clearfix"><br /></div>
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
			var ajaxCurso = $.ajax({
				   url: '{{ URL::route("get_curso_total") }}',
				   type: 'POST',
				   dataType: 'json',
				   async: true,
				   data: {
				      'curso_id': $(this).val(),
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
					  $('#btn-curso-consultar').attr('disabled', false);
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
		
	});
</script>
@endsection