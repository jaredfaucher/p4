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
	<div class="col-md-3">
		<a href='/'>Go Home</a>
	</div>
	<div class="col-md-3">
		<a href='/myprofile'>My Profile</a>
	</div>
	<div class="col-md-3">
		<a href='/myprofile/edit'>Edit Profile</a>
	</div>
	<div class="col-md-3">
		<a href='/logout'>Log out</a>
	</div>
</div>

@foreach($errors->all() as $message) 
	<div class='error'>{{ $message }}</div>
@endforeach
<div class="row text-center">
	<h3>{{ $user->username }}'s Pictures</h3>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="five-column">Title</th>
			<th class="five-column">URL</th>
			<th class="five-column">Profile?</th>
			<th class="five-column">Preview</th>
			@if(Auth::user() == $user)
			<th class="five-column">Remove?</th>
			@endif
		</tr>
	</thead>
	@foreach ($images as $image)
	<tbody>
		<tr>
			<td class="filterable-cell five-column">{{ $image->title }}</td>
			<td class="filterable-cell five-column">{{ $image->url }}</td>
			<td class="filterable-cell five-column">
				@if($image->profile == true)
					Yes
				@else
					No
				@endif
			</td>
			<td class="filterable-cell five-column"><img class="preview" src={{ $image->url }} /></td>
			@if(Auth::user() == $user)
			{{ Form::open(array('url' => '/myprofile/edit/delete', 'method' => 'POST')) }}
			<td class="filterable-cell five-column">
				{{ Form::radio('id', $image->id) }}
			</td>
			@endif
		</tr>
	@endforeach
	@if(Auth::user() == $user)
		<tr>
			<td class="five-column"></td>
			<td class="five-column"></td>
			<td class="five-column"></td>
			<td class="five-column"></td>
			<td class="five-column">
				{{ Form::submit('Delete Image') }}
			</td>
			{{ Form::close() }}
		</tr>
	@endif
	</tbody>
</table>
@stop