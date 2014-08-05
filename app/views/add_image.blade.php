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
	<div class="row">
		<div class="col-md-2">Profile Picture?: </div>
		<div class="col-md-2">{{ Form::checkbox('profile', "true") }} </div>
	</div>	
	<div class="row">
		<div class="col-md-2">Title: </div>
		<div class="col-md-2">{{ Form::text('title') }} </div>
	</div>
	<div class="row">
		<div class="col-md-2">Description: </div>
		<div class="col-md-2">{{ Form::text('description') }} </div>
	</div>		
	<br>
	<div class="row">
		<div class="col-md-2">{{ Form::submit('Upload Image') }}</div>
	</div>
	{{ Form::close() }}