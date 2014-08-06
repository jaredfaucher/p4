@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Remind Password</h1>
</div>
<div class="row text-center">
	<a href='/'>Go Home</a>
</div>
<br>
@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/password/reset', 'method' => 'POST')) }}
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-3">Email: </div>
		<div class="col-md-3">{{ Form::text('email') }}</div>
		<div class="col-md-3"></div>
	</div>
	<br>
	<div class="row text-center">
		<div class="col-md-4"></div>
		<div class="col-md-4">{{ Form::submit('Send Reminder') }}</div>
		<div class="col-md-4"></div>
	</div>

{{ Form::close() }}

@stop