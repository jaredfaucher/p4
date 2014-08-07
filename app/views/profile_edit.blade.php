@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Edit {{ $user->username }}'s Profile</h1>
</div>
	<div class='row text-center'>
		<div class="col-md-2"></div>
		<div class="col-md-2">
			<a href='/'>Go Home</a>
		</div>
		<div class="col-md-2">
			<a href='/myprofile'>My Profile</a>
		</div>
		<div class="col-md-2">
			<a href='/myprofile/edit/add'>Add Picture to profile</a>
		</div>
		<div class="col-md-2">
			<a href='/myprofile/edit/delete'>Delete Picture from profile</a>
		</div>
		<div class="col-md-2"></div>
	</div>
	{{ Form::open(array('url' => '/myprofile/edit', 'method' => 'POST')) }}
		<div class="row text-center"><h3>Change Password</h3></div>
		{{ Form::hidden('change', 'password') }}
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Current Password: </div>
			<div class="col-md-3">{{ Form::password('password') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">New Password: </div>
			<div class="col-md-3">{{ Form::password('newPassword') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Confirm New Password: </div>
			<div class="col-md-3">{{ Form::password('confirmNewPassword') }}</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4">{{ Form::submit('Change Password') }}</div>
			<div class="col-md-4"></div>
		</div>
	{{ Form::close() }}<br><br>
	
	{{ Form::open(array('url' => '/myprofile/edit', 'method' => 'POST')) }}
		<div class="row text-center"><h3>Change Email</h3></div>
		{{ Form::hidden('change', 'email') }}
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Enter Password: </div>
			<div class="col-md-3">{{ Form::password('password') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">New Email: </div>
			<div class="col-md-3">{{ Form::text('newEmail') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Confirm New Email: </div>
			<div class="col-md-3">{{ Form::text('confirmNewEmail') }}</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4">{{ Form::submit('Change Email') }}</div>
			<div class="col-md-4"></div>
		</div>
	{{ Form::close() }}<br><br>
	
	{{ Form::open(array('url' => '/myprofile/edit', 'method' => 'POST')) }}
		<div class="row text-center"><h3>Change Zip Code</h3></div>
		{{ Form::hidden('change', 'zip') }}
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Enter Password: </div>
			<div class="col-md-3">{{ Form::password('password') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">New Zip Code: </div>
			<div class="col-md-3">{{ Form::text('newZip') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Confirm Zip Code: </div>
			<div class="col-md-3">{{ Form::text('confirmNewZip') }}</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4">{{ Form::submit('Change Zip Code') }}</div>
			<div class="col-md-4"></div>
		</div>
	{{ Form::close() }}<br><br>
@stop