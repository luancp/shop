@extends('layouts.admin')

@section('css-header')

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
			@endif
    	</div>
    	<div class="col-md-7 col-sm-7">
    		<h4>{{ $colegio->nombre }}</h4>
    		<p><hr /></p>
    		<p><strong>Cursos</strong></p>
    		<p>
    			@foreach($colegio->cursos as $c)
    				{{ $c->nombre }},&nbsp;
    			@endforeach
    		</p>    		
    		<p><hr /></p>
    		<p><a class="btn btn-default btn-xs" href="{{ URL::route('admin_colegio_modificar', $colegio->id) }}"><i class="fa fa-edit"></i>&nbsp;Editar</a></p>
    	</div>
	  	<p class="col-md-12">&nbsp;<hr /></p>
  	</div>
@endsection

@section('js-footer')

@endsection

