@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 id="title">Bike Swap :: Add/Remove Parts</h1>
	<br>
	<a href='/'>Go Home</a><br><br>

	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach

	<h3>{{ $user->username }}'s Pictures</h3><br>
	<table class="table">
	<tr>
		<th>Title</th>
		<th>URL</th>
		<th>Profile?</th>
		<th>Preview</th>
		@if(Auth::user() == $user)
		<th>Remove?</th>
		@endif
	</tr>
	@foreach ($images as $image)
	<tr>
		<td>{{ $image->title }}</td>
		<td>{{ $image->url }}</td>
		<td>{{ $image->profile }}</td>
		<td><img class="preview" src={{ $image->url }} /></td>
		@if(Auth::user() == $user)
		{{ Form::open(array('url' => '/myprofile/edit/delete', 'method' => 'POST')) }}
		<td>
			{{ Form::radio('id', $image->id) }}
		</td>
		@endif
	</tr>
	@endforeach
	@if(Auth::user() == $user)
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>
			{{ Form::submit('Delete Image') }}
		</td>
		{{ Form::close() }}
	</tr>
	@endif
@stop