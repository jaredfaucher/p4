@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Add/Remove Parts</h1>
	<br>
	<a href='/'>Go Home</a><br>

	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}

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
									  'seat_clamp' => 'Seat Clamp')) }}<br>
		Part Name: {{ Form::text('part_name') }} <br>
		{{ Form::submit('Add Part') }}

	{{ Form::close() }}

@stop