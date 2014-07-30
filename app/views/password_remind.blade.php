@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Remind Password</h1>
	<br>
	<a href='/'>Go Home</a><br>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('url' => '/remind', 'method' => 'POST')) }}

		Email: {{ Form::text('email') }} <br>

		{{ Form::submit('Send Reminder') }}

	{{ Form::close() }}

@stop