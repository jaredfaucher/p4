@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Edit {{ $user->username }}'s Profile</h1>
	<br>
	<a href='/'>Go Home</a><br>
	<a href='/myprofile'>My Profile</a><br>
	<a href='/myprofile/edit/add'>Add Picture to profile</a><br>
	<a href='/myprofile/edit/delete'>Delete Picture from profile</a><br>
	{{ Form::open(array('url' => '/myprofile/edit', 'method' => 'POST')) }}
		<div class="row"><h3>Change Password</h3></div>
		{{ Form::hidden('change', 'password') }}
		<div class="row">
			<div class="col-md-2">Current Password: </div>
			<div class="col-md-2">{{ Form::password('password') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">New Password: </div>
			<div class="col-md-2">{{ Form::password('newPassword') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Confirm New Password: </div>
			<div class="col-md-2">{{ Form::password('confirmNewPassword') }}</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Change Password') }}</div>
		</div>
	{{ Form::close() }}<br><br>
	
	{{ Form::open(array('url' => '/myprofile/edit', 'method' => 'POST')) }}
		<div class="row"><h3>Change Email</h3></div>
		{{ Form::hidden('change', 'email') }}
		<div class="row">
			<div class="col-md-2">Enter Password: </div>
			<div class="col-md-2">{{ Form::password('password') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">New Email: </div>
			<div class="col-md-2">{{ Form::text('newEmail') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Confirm New Email: </div>
			<div class="col-md-2">{{ Form::text('confirmNewEmail') }}</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Change Email') }}</div>
		</div>
	{{ Form::close() }}<br><br>
	
	{{ Form::open(array('url' => '/myprofile/edit', 'method' => 'POST')) }}
		<div class="row"><h3>Change Zip Code</h3></div>
		{{ Form::hidden('change', 'zip') }}
		<div class="row">
			<div class="col-md-2">Enter Password: </div>
			<div class="col-md-2">{{ Form::password('password') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">New Zip Code: </div>
			<div class="col-md-2">{{ Form::text('newZip') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Confirm Zip Code: </div>
			<div class="col-md-2">{{ Form::text('confirmNewZip') }}</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Change Zip Code') }}</div>
		</div>
	{{ Form::close() }}<br><br>
@stop