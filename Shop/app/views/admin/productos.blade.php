@extends('layouts.admin')

@section('css-header')
<style type="text/css">
	.img-options{
		position: absolute;
		top: 50%;
		padding: 12px;
		background-color: black;
		opacity: 0.4;
	}
	
	.img-options a{
		font-size: 18px;
		color: white;
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
    		<div class="col-md-3 col-sm-4 col-xs-5">
				<div>
    			@if($p->imagen)
    					{{ HTML::image('img/productos/'.$p->imagen, '', array('class' => 'img-rounded', 'width' => '100%')) }}
    			@else
    				{{ HTML::image('img/productos/default.png', '', array('class' => 'img-rounded', 'width' => '100%')) }}
    			@endif
    				<div class="img-options">
		    			<a href="#"><i class="fa fa-edit"></i></a>
		    			<a href="#"><i class="fa fa-search"></i></a>
		    		</div>
				</div>
    		</div>
    		<div class="col-md-8 col-sm-8 col-xs-7">
    			<div>
	    			<p><strong class="producto-titulo">{{ $p->nombre }}</strong></p>
	    			<p class="producto-descripcion">{{ $p->descripcion }}</p>
	    		</div>
    		</div>
		</div><br />
	  	@endforeach	  	
	  	<div class="text-center">
	  		{{ $productos->links() }}
	  	</div>
  	</div>
  	
<div id="myModal" class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
		
		$('.img-rounded').click(function(){
			var sr=$(this).attr('src'); 
            $('#img-modal').attr('src',sr);
            $('#myModal').modal('show');
		});
	});
</script>
@endsection
