@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: {{ $user->username }}'s Profile</h1>
	<br>
	<div class='row'>
		<div class="col-md-5">
			<a href='/'>Go Home</a>
		</div>
	@if(Auth::user() == $user)
		<div class="col-md-5">
			<a href='/myprofile/edit'>Edit Profile</a>
		</div>
	@else
		<div class="col-md-5">
			<a href={{ '"/profile/'.$user->username.'/pictures"' }}>
				{{$user->username}}'s Pictures
			</a>
		</div>
	@endif
	</div>
	<div class='row'>
		<div class="col-md-8">
			<img id='profile_pic' alt='Bike Swap' src={{ $url }} />
		</div>
	</div>
	<h3 class="title">{{ $user->username }}'s Parts</h3><br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Type</th>
				<th>Name</th>
				@if(Auth::user() == $user)
				<th>Remove?</th>
				@else
				<th>Interested?</th>
				@endif
			</tr>
		</thead>
	<tbody>
	@foreach ($parts as $part)
		<tr>
			<td class="filterable-cell">{{ $part->type }}</td>
			<td class="filterable-cell">{{ $part->part_name }}</td>
			@if(Auth::user() == $user)
			{{ Form::open(array('url' => '/delete', 'method' => 'POST')) }}
			<td class="filterable-cell">
				{{ Form::radio('id', $part->id) }}
			</td>
			@else
			{{ Form::open(array('url' => '/request', 'method' => 'POST')) }}
			<td class="filterable-cell">
				{{ Form::radio('id', $part->id) }}
			</td>
			@endif
		</tr>
	@endforeach
	</tbody>
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
	</div>

@stop