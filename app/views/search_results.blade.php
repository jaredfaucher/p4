@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: {{ Auth::user()->username }}'s Profile</h1><br>
<table class="table">
	<tr>
		<th>Type</th>
		<th>Name</th>
		<th>Remove?</th>
	</tr>
	@foreach ($parts as $part)
	<tr>
		<td>{{ $part->type }}</td>
		<td>{{ $part->part_name }}</td>
		{{ Form::open(array('url' => '/delete', 'method' => 'POST')) }}
		<td>
			{{ Form::radio('id', $part->id) }}
		</td>
	</tr>
	@endforeach
</table>
@stop