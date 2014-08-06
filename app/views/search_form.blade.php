@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: Search</h1>
	<br>
	<a href='/'>Go Home</a><br>

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}
		<h3>Find Parts near you</h3><br>
		<div class="row">
			<div class="col-md-2">What are you looking for?: </div>
			<div class="col-md-2">{{ Form::text('query') }}</div>
		</div>
		<div class="row">	
			<div class="col-md-2">Type (optional): </div>
			<div class="col-md-2">{{ Form::select('type', array('any' => 'Any',
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
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Search') }}</div>
		</div>

	{{ Form::close() }}<br>

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}

		<h3>Find users near you</h3><br>
		Distance from you: {{ Form::select('distanceAway', array(5 => '5 miles',
															 10 => '10 miles',
															 25 => '25 miles',
															 50 => '50 miles')) }}<br><br>

		{{ Form::submit('Search') }}

	{{ Form::close() }}

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}

		<h3>Find by username</h3><br>
		Username: {{ Form::text('username') }}<br><br>

		{{ Form::submit('Search') }}

	{{ Form::close() }}

@stop