@extends('layouts.admin')

@section('css-header')
<style type="text/css">
	.thumbnail{
		margin-bottom: 10px;
	}
	.titulo-producto{
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}
	.thumbnail{
		cursor: pointer;
	}
</style>
@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Productos
	    	<form class="form-inline pull-right" role="form" action="{{ URL::route('admin_sincronizacion') }}" method="post">
	    		<button id="btn-sincronizar" class="btn btn-info btn-xs" type="submit">
	    			<i class="fa fa-refresh"></i>&nbsp;<span class="text-sincronizar">Sincronizar</span>
	    		</button>
	    	</form>
	    </h4>
	    <hr /><br />
    	
	    @foreach($productos as $p)
	    <div class="row">
    		<div class="col-md-3 col-sm-4 col-xs-6">
				<div>
    			@if($p->imagen)
    				{{ HTML::image('img/productos/thumb_'.$p->imagen, '', array('class' => 'thumbnail', 'width' => '100%', 'data-title' => $p->nombre, 'data-src' => URL::asset("img/productos/$p->imagen"))) }}
    			@else
    				{{ HTML::image('img/productos/default/default.png', '', array('class' => 'thumbnail', 'width' => '100%', 'data-title' => $p->nombre)) }}
    			@endif
				</div>
    		</div>
    		<div class="col-md-9 col-sm-8 col-xs-6">
    			<div>
	    			<p class="titulo-producto"><a href="{{ URL::route('admin_producto_consultar', $p->id) }}"><strong>{{ $p->nombre }}</strong></a></p>
	    			<p class="descripcion-producto">{{ $p->descripcion }}</p>
	    		</div>
    		</div>
		</div>
	  	@endforeach	  	
	  	<div class="text-center">
	  		{{ $productos->links() }}
	  	</div>
  	</div>
  	
<div id="myModal" class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
    		<h4 style="margin:0;">
    			<span id="img-title"></span>
    			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>	
    		</h4>	        
	    </div>
	    <div class="modal-body text-center">
	      <img id="img-modal" src="" width="100%" />
      	</div>
    </div>
  </div>
</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		$("#btn-sincronizar").click(function(){
			$(this).find('i').addClass('fa-spin');
			$(this).find('span.text-sincronizar').text('Sincronizando...');
		});
		
		$('.thumbnail').click(function(){
			var sr=$(this).attr('data-src');
			if(sr){
				var title=$(this).attr('data-title');
	            $('#img-modal').attr('src',sr);
	            $('#img-title').text(title);
	            $('#myModal').modal('show');
           }
		});
	});
</script>
@endsection
