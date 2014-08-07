@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Register</h1>
</div>
	<div class='row text-center'>
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<a href='/'>Go Home</a>
		</div>
		<div class="col-md-4"></div>
	</div>
	<br>
	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Username: </div>
			<div class="col-md-3">{{ Form::text('username') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Email: </div>
			<div class="col-md-3">{{ Form::text('email') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Zip Code: </div>
			<div class="col-md-3">{{ Form::text('zip') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Password: <small>(Min. 6)</small></div>
			<div class="col-md-3">{{ Form::password('password') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Confirm: </div>
			<div class="col-md-3">{{ Form::password('confirm') }}</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4">{{ Form::submit('Register') }}</div>
			<div class="col-md-4"></div>
		</div>

	{{ Form::close() }}

@stop