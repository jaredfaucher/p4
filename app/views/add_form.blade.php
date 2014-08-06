@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: Add/Remove Parts</h1>
	<br>
	<a href='/'>Go Home</a><br><br>

	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-2">Part Type: </div>
			<div class="col-md-2">{{ Form::select('type', array(
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
									  'Accessories' => 'Accessories')) }}</div>
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