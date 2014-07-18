@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Add Bike</h1>

	{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

		Frame: {{ Form::text('frame') }} <br>
		Fork: {{ Form::text('fork') }} <br>
		Headset: {{ Form::text('headset') }} <br>
		Crankset: {{ Form::text('crankset') }} <br>
		Bottom Bracket: {{ Form::text('bracket') }} <br>
		Pedals: {{ Form::text('pedals') }} <br>
		Cog: {{ Form::text('cog') }} <br>
		Chain: {{ Form::text('chain') }} <br>	
		Hubs: {{ Form::text('hubs') }} <br>
		Spokes: {{ Form::text('spokes') }} <br>
		Rims: {{ Form::text('rims') }} <br>
		Tires: {{ Form::text('tires') }} <br>
		Brakes: {{ Form::text('brakes') }} <br>
		Brake Lever: {{ Form::text('brake_lever') }} <br>
		Handlebar: {{ Form::text('handlebar') }} <br>
		Stem: {{ Form::text('stem') }} <br>
		Tape/Grip: {{ Form::text('grip') }} <br>
		Saddle: {{ Form::text('saddle') }} <br>
		Seat Post: {{ Form::text('seat_post') }} <br>
		Seat Clamp: {{ Form::text('seat_clamp') }} <br>

		{{ Form::submit('Add Bike') }}

	{{ Form::close() }}

@stop