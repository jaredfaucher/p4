@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Search</h1>
	<br>
	<a href='/'>Go Home</a><br>

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}
		<h3>Find Parts near you</h3><br>
		What are you looking for?: {{ Form::text('query') }} <br>
		Type (optional): {{ Form::select('type', array('any' => 'Any',
									  'frame' => 'Frame', 
									  'fork' => 'Fork',
									  'headset' => 'Headset',
									  'crankset' => 'Crankset',
									  'bracket' => 'Bracket',
									  'pedals' => 'Pedals',
									  'cog' => 'Cog',
									  'chain' => 'Chain',
									  'hub' => 'Hub',
									  'spokes' => 'Spokes',
									  'rims' => 'Rim',
									  'tire' => 'Tire',
									  'brake' => 'Brake',
									  'brake_lever' => 'Brake Lever',
									  'handlebar' => 'Handlebar',
									  'stem' => 'Stem',
									  'grip' => 'Grip',
									  'saddle' => 'Saddle',
									  'seat_post' => 'Seat Post',
									  'seat_clamp' => 'Seat Clamp'), 'all') }}<br><br>

		{{ Form::submit('Search') }}

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