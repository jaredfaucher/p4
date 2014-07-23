@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Register</h1>

	{{{ $error or '' }}}

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

		Username: {{ Form::text('username') }} <br>
		Email: {{ Form::text('email') }} <br>
		Password: {{ Form::password('password') }} <br>

		{{ Form::submit('Register') }}

	{{ Form::close() }}

@stop