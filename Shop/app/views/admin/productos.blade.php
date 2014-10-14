@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>
	    	<i class="fa fa-shopping-cart"></i>&nbsp;Productos
	    	<form class="form-inline pull-right" role="form" action="{{ URL::route('admin_sincronizacion') }}" method="post">
	    		<button id="btn-sincronizar" class="btn btn-info btn-xs" type="submit">
	    			<i class="fa fa-refresh"></i>&nbsp;Sincronizar
	    		</button>
	    	</form>
	    </h4>
	    <hr /><br />
    	{{ $productos }}
  	</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		$("#btn-sincronizar").click(function(){
			$(this).find('i').addClass('fa-spin');
		});
	});
</script>
@endsection
