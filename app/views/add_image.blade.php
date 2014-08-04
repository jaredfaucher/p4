@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Edit {{ $user->username }}'s Profile</h1>
	<br>
	<a href='/'>Go Home</a><br>
	<a href='/myprofile'>My Profile</a><br>
	{{ Form::open(array('url' => '/myprofile/edit/add', 'method' => 'POST', 'files' => true)) }}
	<div class="row">
		<div class="col-md-2">Where is your picture?: </div>
		<div class="col-md-2">{{ Form::file('file') }} </div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-2">{{ Form::submit('Upload Image') }}</div>
	</div>
	{{ Form::close() }}