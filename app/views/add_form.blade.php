@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Add Parts</h1>

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

		Part Type: {{ Form::select('type', array('frame' => 'Frame', 
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
									  'seat_clamp' => 'Seat Clamp')) }}
		Part Name: {{ Form::text('part_name') }} <br>
		{{ Form::submit('Add Part') }}

	{{ Form::close() }}

@stop