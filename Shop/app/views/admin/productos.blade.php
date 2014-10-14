@extends('layouts.admin')

@section('css-header')

@endsection

@section('content')
	<div class="col-sm-12 col-md-12 bg-white">
	    <h4>Productos</h4>
	    <hr /><br />
    	<div class="table-responsive">
		    <table class="table table-hover">
		      <thead>
		        <tr>
		          <th>#</th>
		          <th>First Name</th>
		          <th>Last Name</th>
		          <th>Username</th>
		        </tr>
		      </thead>
		      <tbody>
		        <tr>
		          <td>1</td>
		          <td>Mark</td>
		          <td>Otto</td>
		          <td>@mdo</td>
		        </tr>
		        <tr>
		          <td>2</td>
		          <td>Jacob</td>
		          <td>Thornton</td>
		          <td>@fat</td>
		        </tr>
		        <tr>
		          <td>3</td>
		          <td colspan="2">Larry the Bird</td>
		          <td>@twitter</td>
		        </tr>
		      </tbody>
		    </table>
		  </div>
  	</div>
@endsection

@section('js-footer')
<script type="text/javascript">
	$(function(){
		
	});
</script>
@endsection
