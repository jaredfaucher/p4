@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Login</h1>

	{{ Form::open(array('url' => '/login', 'method' => 'POST')) }}

		Email: {{ Form::text('email') }} <br>
		Password: {{ Form::text('password') }} <br>

		{{ Form::submit('Login') }}

	{{ Form::close() }}

@stop