@extends('layouts.admin')

@section('css-header')

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
    		<div class="col-md-4 col-sm-4 col-xs-5">
    			@if($p->imagen)
    				{{ HTML::image('img/productos/'.$p->imagen, '', array('class' => 'img-rounded', 'width' => '100%')) }}
    			@else
    				{{ HTML::image('img/productos/default.png', '', array('class' => 'img-rounded', 'width' => '100%')) }}
    			@endif
    		</div>
    		<div class="col-md-8 col-sm-8 col-xs-7">
    			<div class="">
	    			<strong class="">{{ $p->nombre }}</strong><br/>
	    			<p class="">{{ $p->descripcion }}</p>
	    		</div>
    		</div>
		</div><br />
	  	@endforeach	  	
	  	<div class="text-center">
	  		{{ $productos->links() }}
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
	});
</script>
@endsection
