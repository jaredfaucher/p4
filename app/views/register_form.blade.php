@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Register</h1>

	@if(Session::get('error'))
        <div class='error'>{{ Session::get('error') }}</div>
    @endif

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

		Username: {{ Form::text('username') }} <br>
		Email: {{ Form::text('email') }} <br>
		Zip Code: {{ Form::text('zip') }} <br>
		Password: {{ Form::password('password') }} <br>

		{{ Form::submit('Register') }}

	{{ Form::close() }}

@stop