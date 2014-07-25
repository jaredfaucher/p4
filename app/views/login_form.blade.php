@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Login</h1>
	<br>
	<a href='/'>Go Home</a><br>
    
    @if(Session::get('error'))
        <div class='error'>{{ Session::get('error') }}</div>
    @endif
	
	{{ Form::open(array('url' => '/login', 'method' => 'POST')) }}

		Username: {{ Form::text('username') }} <br>
		Password: {{ Form::password('password') }} <br>

		{{ Form::submit('Login') }}

	{{ Form::close() }}

@stop