@extends('layouts.default')

@section('css-header')

@endsection

@section('sidebar')
	<ul class="list-group">
	  <a class="list-group-item" href="{{ URL::route('perfil') }}">Perfil<span class="fa fa-chevron-right pull-right"></span></a>
	  <a class="list-group-item" href="">Cuenta<span class="fa fa-chevron-right pull-right"></span></a>
	  <a class="list-group-item" href="">Contrase&ntilde;a<span class="fa fa-chevron-right pull-right"></span></a>
	</ul>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-12 bg-white">
		    <h4>Perfil</h4>
		    <hr />
	  	</div>
		<div class="col-sm-12 col-md-12 bg-white">
			
	  	</div>
	</div>
@endsection

