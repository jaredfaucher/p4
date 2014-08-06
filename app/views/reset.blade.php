@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: Reset Password</h1>
	<br>
	<a href='/'>Go Home</a><br>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('route' => array('password.update', $token))) }}
		<div class="row">
			<div class="col-md-2">Email: </div>
			<div class="col-md-2">{{ Form::text('email') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">New Password: </div>
			<div class="col-md-2">{{ Form::password('password') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Confirm Password: </div>
			<div class="col-md-2">{{ Form::password('password_confirmation') }}</div> 
			{{ Form::hidden('token', $token) }}
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Reset Password') }}</div>
		</div>
	{{ Form::close() }}

@stop