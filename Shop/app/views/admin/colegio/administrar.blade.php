@extends('layouts.admin')

@section('css-header')
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.css') }}
<style type="text/css">
	.panel-heading{
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
	}
	.panel-body{
		padding-top: 0;
		padding-bottom: 0;
	}
	.lista-productos{
		padding: 15px;
	}
</style>
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Colegio
	    </h4>
	    <hr /><br />
    	<div class="col-md-5 col-sm-5">
			@if($colegio->imagen)
				<img class="croppedImg" src="{{ URL::asset('img/colegios/'.$colegio->imagen) }}" width="200" />
			@else
				<img class="croppedImg" src="{{ URL::asset('img/colegios/default/default.png') }}" />
			@endif
    	</div>
    	<div class="col-md-7 col-sm-7">
    		<h4>{{ $colegio->nombre }}</h4>
    		<p><hr /></p>
    		<p><a class="btn btn-default btn-xs" href="{{ URL::route('admin_colegio_modificar', $colegio->id) }}"><i class="fa fa-edit"></i>&nbsp;Editar</a></p>
    	</div>
	  	<div class="col-md-12">&nbsp;<hr /><br /></div>
	  	<div class="col-md-12 col-sm-12">
	  		<div class="row">
	  			<div class="col-md-6 col-sm-6">
		  			<div class="panel panel-default">
					  <!-- Default panel contents -->
					  <div class="panel-heading"><strong>Cursos</strong><a class="pull-right text-success agregar-curso btn btn-link btn-xs" href="#"><i class="fa fa-plus"></i>&nbsp;Agregar Curso</a></div>
					  <div class="panel-body">
					  	<form class="hide form-agregar-curso" role="form" method="post" action="{{ URL::route('admin_colegio_admin_curso') }}">
					  		<label>Nombre Curso</label>
					  		<div>
					  			<input type="hidden" name="id-colegio" value="{{ $colegio->id }}" />
					  			<input class="form-control input-sm" type="text" id="nombre_curso" name="nombre" required="required" />
					  			<p>
					  				<br />
					  				<button type="submit" class="btn btn-primary btn-xs">Guardar</button>&nbsp;<a class="btn btn-link btn-xs cancelar-curso">Cancelar</a>
					  			</p>
					  		</div>
					  	</form>
					  </div>
					  <!-- List group -->
					  <ul class="list-group">
					    @foreach($colegio->cursos as $c)
						    <li class="list-group-item" id="{{ $c->id }}">
					    		<form class="form-inline" role="form" action="{{ URL::route('admin_colegio_curso_eliminar', $c->id) }}" method="post">
						    		<div class="form-group">
						    			<input type="hidden" name="colegio_id" value="{{ $colegio->id }}" />
						    			<input type="hidden" name="curso_id" value="{{ $c->id }}" />
							    		<button class="delete-curso text-danger btn btn-xs" type="submit" data-url="">
							    			<i class="fa fa-minus-circle"></i>
							    		</button>
							    		&nbsp;<a class="item-curso" data-name="{{ $c->nombre }}" data-id="{{ $c->id }}" href="#">{{ $c->nombre }}</a>
						    		</div>
						    	</form>
						    </li>
		    			@endforeach
					  </ul>
					</div>
		  		</div>
		  		<div class="col-md-6 col-sm-6">
		  			@if(count($colegio->cursos)>0)
			  			<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading" id="head-list"><strong>Lista por Curso</strong></div>
						  <div class="panel-body">
						  	  <a class="hide btn btn-link btn-xs agregar-producto pull-right" href="#"><i class="fa fa-plus"></i>&nbsp;Agregar Producto</a>
						  	  <form id="form-agregar-producto" class="hide" role="form" method="post" action="{{ URL::route('admin_colegio_admin_curso') }}">
						  		<div class="form-group">
						  			<label>Producto</label>
						  			<input type="hidden" id="id-colegio" name="id-colegio" value="{{ $colegio->id }}" />
						  			<input type="hidden" name="agregar-producto" value="true" />
						  			<input type="hidden" id="id-curso" name="id-curso" value="" />
						  			<input id="lista" class="form-control col-sm-9" name="producto" />
								</div>
						  		<div class="form-group">
						  			<label>Cantidad</label>
									<input id="cantidad-prod" class="form-control input-sm" type="number" min="1" name="cantidad" required="required" value="1" />
						  			<p>
						  				<br />
						  				<button type="submit" class="btn btn-primary btn-xs" id="guardar-producto-lista">Guardar</button>&nbsp;<a class="btn btn-link btn-xs cancelar-producto">Cancelar</a>
						  			</p>
						  		</div>
						  	  </form>
						  </div>
						  <!-- List group -->
						  <ul class="list-group" id="lista-productos-curso">
							<li class="list-group-item text-center curso-list-load">Seleccione un curso</li>
						  </ul>
						</div>
					@endif
		  		</div>
	  		</div>
	  	</div>
  	</div>
@endsection

@section('js-footer')
{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/bootbox.min.js') }}
<script type="text/javascript">
	function eliminarProducto(a_elm, id_lista){
		a_elm = a_elm[0];
		$(a_elm).removeClass('delete-item-new').addClass('delete-item');
		bootbox.confirm("Está seguro de eliminar el producto de la lista?.", function(result){
            if(result){
				$.ajax({
				   url: '{{ URL::route("admin_colegio_curso_eliminar_producto") }}',
				   type: 'POST',
				   dataType: 'json',
				   async: true,
				   data: {
				      'id_lista': id_lista,
				   },
				   beforeSend: function() {
				      $(a_elm).html('<i class="fa fa-spinner fa-spin"></i>');
				   },
				   error: function() {
				      $(a_elm).html('<i class="fa fa-minus-circle"></i>');
				   },
				   success: function(data) {
				   	  $(a_elm).closest('li.curso-list').remove();
				   },
				});
            }
        });
	}

	$(function(){
		$('.agregar-curso').click(function(e){
			e.preventDefault();
			if($('.form-agregar-curso').hasClass('hide')){
				$('.form-agregar-curso').removeClass('hide');
				$('#nombre_curso').focus();
			}
		});
		$('.cancelar-curso').click(function(e){
			e.preventDefault();
			if(!$('.form-agregar-curso').hasClass('hide')){
				$('.form-agregar-curso').addClass('hide');
			}
		});
		$('.cancelar-producto').click(function(e){
			e.preventDefault();
			if(!$('#form-agregar-producto').hasClass('hide')){
				$('#form-agregar-producto').addClass('hide');
				$('.agregar-producto').removeClass('hide');
			}
		});
		//----------------------
		$('.item-curso').click(function(e){
			e.preventDefault();
			$('#head-list').html("<strong>"+ $(this).attr('data-name') +"</strong>");
			$('.lista-productos').removeClass('hide');
			$('.agregar-producto').removeClass('hide');
			$('#lista-productos-curso').find('li.curso-list').remove();
			
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
			   },
			   error: function() {
			      $('.curso-list-load').html('A ocurrido un error.');
			   },
			   success: function(data) {
			   	  if(data.length == 0){
			   	  	  $('.curso-list-load').html('No hay productos en la lista').removeClass('hide');
			   	  }else{
				   	  $.each(data, function(k, v){
					  	$('#lista-productos-curso').append('<li class="list-group-item curso-list"><a href="#" data-id="'+v.id+'" class="text-danger delete-item"><i class="fa fa-minus-circle"></i></a>&nbsp;'+v.producto+'</li>');
				   	  });
				   	  //agrega el producto a la lista
				      
				      $('.curso-list-load').html('').addClass('hide');
				  }
				  $('.delete-item').bind('click', function(e){
				  	e.preventDefault();
				  	var id_lista = $(this).attr('data-id');
				  	var a_elm = $(this);
                	eliminarProducto(a_elm, id_lista);
				  });
			   },
			});
			//agrega el id del curso al form
			$('#id-curso').val($(this).attr('data-id'));
			
		});
		$('.agregar-producto').click(function(e){
			e.preventDefault();
			$(this).addClass('hide');
			$('#form-agregar-producto').removeClass('hide');
		});
		
		$('#lista').select2({
		    minimumInputLength: 2,
		    allowClear: true,
		    ajax: {
		        url: "{{ URL::route('admin_get_productos_json') }}",
		        dataType: 'json',
		        type: "GET",
		        quietMillis: 50,
		        data: function (term) {
		            return {
		                term: term
		            };
		        },
		        results: function (data) {
		            return {
		                results: $.map(data, function (item) {
		                    return {
		                        text: item.nombre,
		                        id: item.id
		                    }
		                })
		            };
		        },
		        cache: true
		    }
		});
		
		//para guarda el producto en la lista
		$('#guardar-producto-lista').click(function(e){
			e.preventDefault();
			$(this).prop('disabled', true);
			$(this).html('Guardando...');
			
			$.ajax({
			   url: '{{ URL::route('admin_colegio_admin_curso') }}',
			   type: 'POST',
			   dataType: 'json',
			   data: {
			      'id-curso': $('#id-curso').val(), 
			      'id-colegio': $('#id-colegio').val(), 
			      'producto': $('#lista').val(), 
			      'cantidad': $('#cantidad-prod').val(), 
			      'agregar-producto': 'true', 
			   },
			   error: function() {
			      $('#guardar-producto-lista').prop('disabled', false);
			      $('#guardar-producto-lista').html('Guardar');
			   },
			   success: function(data) {
			   	  //agrega el producto a la lista
			      $('#lista-productos-curso').prepend('<li class="list-group-item curso-list"><a href="#" data-id="'+data.id+'" class="text-danger delete-item-new"><i class="fa fa-minus-circle"></i></a>&nbsp;'+data.prod_name+'</li>');
			      //reset de campos de form
			      $('#lista').select2('val','');
			      $('#cantidad-prod').val('1');
			      //reset boton
			      $('#guardar-producto-lista').prop('disabled', false);
			      $('#guardar-producto-lista').html('Guardar');
			      
			      $('.delete-item-new').bind('click', function(e){
				  	e.preventDefault();
				  	var id_lista = $(this).attr('data-id');
				  	var a_elm = $(this);
                	eliminarProducto(a_elm, id_lista);
				  });
			   },
			});
			
		});
		
		$('.delete-curso').click(function(e){
		  	e.preventDefault();
		  	console.log($(this).attr('data-id'));
		  	var loc = $(this).attr('data-url');
		  	var boton = $(this);
			bootbox.confirm("Está seguro de eliminar la lista?", function(result){
                if(result){
                	$(boton).closest('form').submit();
                }
            });
		  });
	});
</script>
@endsection

