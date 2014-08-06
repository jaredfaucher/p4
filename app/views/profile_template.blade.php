@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: {{ $user->username }}'s Profile</h1>
</div>
<br>
<div class='row text-center'>
	<div class="col-md-3">
		<a href='/'>Go Home</a>
	</div>
	<div class="col-md-3">
		<a href='/search'>Search Users or Parts</a>
	</div>
@if(Auth::user() == $user)
	<div class="col-md-3">
		<a href='/myprofile/edit'>Edit Profile</a>
	</div>
@else
	<div class="col-md-3">
		<a href={{ '"/profile/'.$user->username.'/pictures"' }}>
			{{$user->username}}'s Pictures
		</a>
	</div>
@endif
	<div class="col-md-3">
		<a href='/logout'>Log out</a>
	</div>
</div>
<div class='row text-center'>
	<img id='profile_pic' alt='Bike Swap' src={{ $url }} />
</div>
<h3 class="title">{{ $user->username }}'s Parts</h3><br>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="three-column">Type</th>
			<th class="three-column">Name</th>
			@if(Auth::user() == $user)
			<th class="three-column">Remove?</th>
			@else
			<th class="three-column">Interested?</th>
			@endif
		</tr>
	</thead>
<tbody>
@foreach ($parts as $part)
	<tr>
		<td class="filterable-cell three-column">{{ $part->type }}</td>
		<td class="filterable-cell three-column">{{ $part->part_name }}</td>
		@if(Auth::user() == $user)
		{{ Form::open(array('url' => '/delete', 'method' => 'POST')) }}
		<td class="filterable-cell three-column">
			{{ Form::radio('id', $part->id) }}
		</td>
		@else
		{{ Form::open(array('url' => '/request', 'method' => 'POST')) }}
		<td class="filterable-cell three-column">
			{{ Form::radio('id', $part->id) }}
		</td>
		@endif
	</tr>
@endforeach
</tbody>
@if(Auth::user() == $user)
<tr>
	<td class="three-column">
		<a href='/add'>Add Part</a>
	</td>
	<td class="three-column"></td>
	<td class="three-column">
		{{ Form::submit('Delete Part') }}
	</td>
	{{ Form::close() }}
</tr>
@else
<tr>
	<td class="three-column"></td>
	<td class="three-column"></td>
	<td class="three-column">
		{{ Form::submit('Request Part') }}
	</td>
	{{ Form::close() }}
</tr>
@endif
</table>
@stop