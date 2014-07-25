@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: {{ $user->username }}'s Profile</h1>
	<br>
	<a href='/'>Go Home</a><br>

	<h3>{{ $user->username }}'s Parts</h3><br>
	@if(Auth::user() != $user)
	<h5>Email {{ $user->username }} about their parts: {{ $user->email }}</h5><br>
	@endif
	<table class="table">
	<tr>
		<th>Type</th>
		<th>Name</th>
		@if(Auth::user() == $user)
		<th>Remove?</th>
		@endif
	</tr>
	@foreach ($parts as $part)
	<tr>
		<td>{{ $part->type }}</td>
		<td>{{ $part->part_name }}</td>
		@if(Auth::user() == $user)
		{{ Form::open(array('url' => '/delete', 'method' => 'POST')) }}
		<td>
			{{ Form::radio('id', $part->id) }}
		</td>
		@endif
	</tr>
	@endforeach
	@if(Auth::user() == $user)
	<tr>
		<td>
			<a href='/add'>Add Part</a>
		</td>
		<td></td>
		<td>
			{{ Form::submit('Delete Part') }}
		</td>
		{{ Form::close() }}
	</tr>
	@endif
	</table>

@stop