@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: {{ $user->username }}'s Profile</h1>
	<br>
	<div class='row'>
		<div class="col-md-3">
			<a href='/'>Go Home</a><br>
	@if(Auth::user() == $user)
		<a href='/myprofile/edit'>Edit Profile</a>
	@endif
		</div>
		<div class="col-md-3">
			<img id='profile_pic' alt='Bike Swap' src={{ $path }} />
		</div>
	</div>
	<h3>{{ $user->username }}'s Parts</h3><br>
	<table class="table">
	<tr>
		<th>Type</th>
		<th>Name</th>
		@if(Auth::user() == $user)
		<th>Remove?</th>
		@else
		<th>Interested?</th>
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
		@else
		{{ Form::open(array('url' => '/request', 'method' => 'POST')) }}
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
	@else
	<tr>
		<td></td>
		<td></td>
		<td>
			{{ Form::submit('Request Part') }}
		</td>
		{{ Form::close() }}
	</tr>
	@endif
	</table>

@stop