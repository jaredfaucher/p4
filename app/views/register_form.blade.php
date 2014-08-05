@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 id="title">Bike Swap :: Register</h1>
	<br>
	<a href='/'>Go Home</a><br><br>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-2">Username: </div>
			<div class="col-md-2">{{ Form::text('username') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Email: </div>
			<div class="col-md-2">{{ Form::text('email') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Zip Code: </div>
			<div class="col-md-2">{{ Form::text('zip') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Password: <small>(Min. 6)</small></div>
			<div class="col-md-2">{{ Form::password('password') }}</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Register') }}</div>
		</div>

	{{ Form::close() }}

@stop