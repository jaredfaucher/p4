@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Add/Remove Parts</h1>
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
		<a href='/search'>Search Users or Parts</a>
	</div>
	<div class="col-md-2">
		<a href='/logout'>Log out</a>
	</div>
	<div class="col-md-2"></div>
</div>
<br>
@foreach($errors->all() as $message) 
	<div class='error'>{{ $message }}</div>
@endforeach
{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-3">Part Type: </div>
		<div class="col-md-3">{{ Form::select('type', array(
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
		<div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-3">Part Name: </div>
		<div class="col-md-3">{{ Form::text('part_name') }}</div>
		<div class="col-md-3"></div>
	</div>
	<br>
	<div class="row text-center">
		<div class="col-md-4"></div>
		<div class="col-md-4">{{ Form::submit('Add Part') }}</div>
		<div class="col-md-4"></div>
	</div>
{{ Form::close() }}

@stop