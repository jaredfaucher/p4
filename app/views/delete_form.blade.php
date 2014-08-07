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
	<div class="col-md-2"></div>
	<div class="col-md-2">
		<a href='/'>Go Home</a>
	</div>
	<div class="col-md-2">
		<a href='/myprofile'>My Profile</a>
	</div>
	<div class="col-md-2">
		<a href='/myprofile/edit'>Edit Profile</a>
	</div>
	<div class="col-md-2">
		<a href='/logout'>Log out</a>
	</div>
	<div class="col-md-2"></div>
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
			<th class="five-column first">Title</th>
			<th class="five-column second">URL</th>
			<th class="five-column third">Profile?</th>
			<th class="five-column fourth">Preview</th>
			@if(Auth::user() == $user)
			<th class="five-column fifth">Remove?</th>
			@endif
		</tr>
	</thead>
	<tbody>
	@foreach ($images as $image)
		<tr>
			<td class="filterable-cell five-column">{{ $image->title }}</td>
			<td class="filterable-cell five-column">{{ $image->url }}</td>
			<td class="filterable-cell five-column third">
				@if($image->profile == true)
					Yes
				@else
					No
				@endif
			</td>
			<td class="filterable-cell five-column"><img class="preview" src={{ $image->url }} /></td>
			@if(Auth::user() == $user)
			{{ Form::open(array('url' => '/myprofile/edit/delete', 'method' => 'POST')) }}
			<td class="filterable-cell five-column fifth">
				{{ Form::radio('id', $image->id) }}
			</td>
			@endif
		</tr>
	@endforeach
	</tbody>
		<tr>
			<td class="five-column equal"></td>
			<td class="five-column equal"></td>
			<td class="five-column equal"></td>
			<td class="five-column equal"></td>
			<td class="five-column equal">
				{{ Form::submit('Delete Image') }}
			</td>
			{{ Form::close() }}
		</tr>
</table>
@stop