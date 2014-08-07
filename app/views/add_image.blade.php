@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Edit {{ $user->username }}'s Profile</h1>
</div>
<br>
<div class="row text-center">
	<div class="col-md-2"></div>
	<div class="col-md-2">
		<a href='/'>Go Home</a>
	</div>
	<div class="col-md-2">
		<a href='/myprofile'>My Profile</a>
	</div>
	<div class="col-md-2">
		<a href='/myprofile/edit'>Edit Profile</a>
	</div>
	<div class="col-md-2">
		<a href='/logout'>Log out</a>
	</div>
	<div class="col-md-2"></div>
</div>
<br>
{{ Form::open(array('url' => '/myprofile/edit/add', 'method' => 'POST', 'files' => true)) }}
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Where is your picture?: </div>
	<div class="col-md-3">{{ Form::file('file') }} </div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Profile Picture?: </div>
	<div class="col-md-3">{{ Form::checkbox('profile', "true") }} </div>
	<div class="col-md-3"></div>
</div>	
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Title: </div>
	<div class="col-md-3">{{ Form::text('title') }} </div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Description: </div>
	<div class="col-md-3">{{ Form::text('description') }} </div>
	<div class="col-md-3"></div>
</div>		
<br>
<div class="row text-center">
	<div class="col-md-4"></div>
	<div class="col-md-4">{{ Form::submit('Upload Image') }}</div>
	<div class="col-md-4"></div>
</div>
{{ Form::close() }}
@stop