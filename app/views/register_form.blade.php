@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Register</h1>
	<br>
	<a href='/'>Go Home</a><br>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

		Username: {{ Form::text('username') }} <br>
		Email: {{ Form::text('email') }} <br>
		Zip Code: {{ Form::text('zip') }} <br>
		Password: {{ Form::password('password') }} <br>
		<small>Min: 6</small><br>

		{{ Form::submit('Register') }}

	{{ Form::close() }}

@stop