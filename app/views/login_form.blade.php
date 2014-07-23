@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Login</h1>

	{{ Form::open(array('url' => '/login', 'method' => 'POST')) }}

		Username: {{ Form::text('username') }} <br>
		Password: {{ Form::password('password') }} <br>

		{{ Form::submit('Login') }}

	{{ Form::close() }}

@stop