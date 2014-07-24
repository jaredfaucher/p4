@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: {{ Auth::user()->username }}'s Profile</h1><br>

	<h3>{{ Auth::user()->username }}'s Parts</h3><br>
	<table class="table">
	<tr>
		<th>Type</th>
		<th>Name</th>
	</tr>
	@foreach ($parts as $part)
	<tr>
		<td>{{ $part->type }}</td>
		<td>{{ $part->name }}</td>
	</tr>
	@endforeach
	</table>

@stop