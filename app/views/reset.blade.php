@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Reset Password</h1>
</div>
<div class="row text-center">
	<a href='/'>Go Home</a>
</div>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('route' => array('password.update', $token))) }}
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Email: </div>
			<div class="col-md-3">{{ Form::text('email') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">New Password: <small>(Min. 6)</small></div>
			<div class="col-md-3">{{ Form::password('password') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Confirm Password: </div>
			<div class="col-md-3">{{ Form::password('password_confirmation') }}</div>
			<div class="col-md-3"></div> 
			{{ Form::hidden('token', $token) }}
		</div>
		<br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">{{ Form::submit('Reset Password') }}</div>
			<div class="col-md-4"></div>
		</div>
	{{ Form::close() }}

@stop