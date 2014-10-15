@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4><i class="fa fa-tags"></i>&nbsp;&nbsp;Categorias</h4>
	    <hr /><br />
    	<div class="clearfix"></div>
    	@foreach($categorias as $c)
    		<div class="col-md-4 col-sm-4 col-xs-12 bg-white" style="margin-bottom:5px;">
    			<strong class="">{{ $c->nombre }}</strong><br/>
    			<p>{{ $c->codigo }}</p>
    		</div>
	  	@endforeach	  	
	  	<div class="text-center">
	  		{{ $categorias->links() }}
	  	</div>
	  	<div class="clearfix"></div>
  	</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		
	});
</script>
@endsection
