@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Reset Password</h1>
	<br>
	<a href='/'>Go Home</a><br>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('route' => array('password.update', $token))) }}

		Email: {{ Form::text('email') }} <br>
		New Password: {{ Form::password('password') }} <br>
		Confirm Password: {{ Form::password('password_confirmation') }} <br>
		{{ Form::hidden('token', $token) }}

		{{ Form::submit('Reset Password') }}

	{{ Form::close() }}

@stop