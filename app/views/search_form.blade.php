@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Search</h1>

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}

		What are you looking for?: {{ Form::text('query') }} <br>

		{{ Form::submit('Search') }}

	{{ Form::close() }}<br>

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}

		Find users near you: {{ Form::text('zip') }} <br>
		Distance from you: {{ Form::select('distance', array('5' => '5 miles',
															 '10' => '10 miles',
															 '25' => '25 miles',
															 '50' => '50 miles')) }}<br>

		{{ Form::submit('Search') }}

	{{ Form::close() }}

@stop