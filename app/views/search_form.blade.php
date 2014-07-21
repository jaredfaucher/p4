@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Search</h1>

	{{ Form::open(array('url' => '/search', 'method' => 'POST')) }}

		What are you looking for?: {{ Form::text('query') }} <br>

		{{ Form::submit('Search') }}

	{{ Form::close() }}

@stop