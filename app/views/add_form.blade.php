@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 id="title">Bike Swap :: Add/Remove Parts</h1>
	<br>
	<a href='/'>Go Home</a><br><br>

	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-2">Part Type: </div>
			<div class="col-md-2">{{ Form::select('type', array(
									  'frame' => 'Frame', 
									  'fork_headset' => 'Fork/Headset',
									  'crankset_bracket' => 'Crankset/Bottom Bracket',
									  'pedals_straps' => 'Pedals/Straps',
									  'drive_cog_chainring' => 'Drivetrain/Cog/Chainring/Chain',
									  'front_hub_wheel_tire' => 'Front Wheel/Hub/Tire',
									  'back_hub_wheel_tire' => 'Back Wheel/Hub/Tire',
									  'brake_lever' => 'Brake/Brake Lever',
									  'handlebar_stem_grip' => 'Handlebar/Grip/Stem',
									  'saddle_seat' => 'Saddle/Seatpost/Clamp',
									  'accessories' => 'Accessories')) }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Part Name: </div>
			<div class="col-md-2">{{ Form::text('part_name') }}</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Add Part') }}</div>
		</div>

	{{ Form::close() }}

@stop