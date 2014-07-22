@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Register</h1>

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

		Username: {{ Form::text('username') }} <br>
		Email: {{ Form::text('email') }} <br>
		Password: {{ Form::text('password') }} <br>

		{{ Form::submit('Register') }}

	{{ Form::close() }}

@stop