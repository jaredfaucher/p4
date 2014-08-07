@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Search</h1>
</div>
<div class="row text-center">
	<div class="col-md-3"></div>
	<div class="col-md-2">
		<a href='/'>Go Home</a>
	</div>
	<div class="col-md-2">
		<a href='/myprofile'>My Profile</a>
	</div>
   	<div class="col-md-2">
   		<a href='/logout'>Log out</a>
   	</div>
   	<div class="col-md-3"></div>
</div>
{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}
<div class="row text-center">
	<h3>Find Parts near you</h3>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">What are you looking for?: </div>
	<div class="col-md-3">{{ Form::text('query') }}</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Type (optional): </div>
	<div class="col-md-3">{{ Form::select('type', array('any' => 'Any',
							  'Frame' => 'Frame', 
							  'Fork/Headset' => 'Fork/Headset',
							  'Crankset/Bracket' => 'Crankset/Bottom Bracket',
							  'Pedals/Straps' => 'Pedals/Straps',
							  'Drivetrain/Cog/Chainring/Chain' => 'Drivetrain/Cog/Chainring/Chain',
							  'Front Wheel/Hub/Tire' => 'Front Wheel/Hub/Tire',
							  'Back Wheel/Hub/Tire' => 'Back Wheel/Hub/Tire',
							  'Brake/Brake Lever' => 'Brake/Brake Lever',
							  'Handlebar/Grip/Stem' => 'Handlebar/Grip/Stem',
							  'Saddle/Seatpost/Clamp' => 'Saddle/Seatpost/Clamp',
							  'Accessories' => 'Accessories'), 'any') }}</div>
	<div class="col-md-3"></div>
</div>
<br>
<div class="row text-center">
	<div class="col-md-4"></div>
	<div class="col-md-4">{{ Form::submit('Search') }}</div>
	<div class="col-md-4"></div>
</div>

{{ Form::close() }}<br>

{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}
<div class="row text-center">
	<h3>Find users near you</h3>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Distance from you: </div>
	<div class="col-md-3">{{ Form::select('distanceAway', array(5 => '5 miles',
															 10 => '10 miles',
															 25 => '25 miles',
															 50 => '50 miles')) }}</div>
	<div class="col-md-3"></div>
</div>
<br>														 
<div class="row text-center">
	<div class="col-md-4"></div>
	<div class="col-md-4">{{ Form::submit('Search') }}</div>
	<div class="col-md-4"></div>
</div>

{{ Form::close() }}<br>

{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}
<div class="row text-center">
	<h3>Find by username</h3>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">Username: </div>
	<div class="col-md-3">{{ Form::text('username') }}</div>
	<div class="col-md-3"></div>
</div>
<br>														 
<div class="row text-center">
	<div class="col-md-4"></div>
	<div class="col-md-4">{{ Form::submit('Search') }}</div>
	<div class="col-md-4"></div>
</div>

{{ Form::close() }}

@stop