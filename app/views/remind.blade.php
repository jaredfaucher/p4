@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 id="title">Bike Swap :: Remind Password</h1>
	<br>
	<a href='/'>Go Home</a><br>

	@foreach($errors->all() as $message)
        <div class='error'>{{ $message }}</div>
    @endforeach

	{{ Form::open(array('url' => '/password/reset', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-2">Email: </div>
			<div class="col-md-2">{{ Form::text('email') }}</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Send Reminder') }}</div>
		</div>

	{{ Form::close() }}

@stop