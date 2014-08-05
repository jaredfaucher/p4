@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 id="title">Bike Swap :: {{ $user->username }}'s Pictures</h1>
	<br>
	<div class='row'>
		<div class="col-md-3">
			<a href='/'>Go Home</a>
		</div>
	</div>
	<div class='row'>
		<div class="col-md-3">
			<a href={{ '"/profile/'.$user->username.'"' }}>Back to Profile</a>
		</div>
	</div>
	<h3>{{ $user->username }}'s Pictures</h3><br>
	<table class="table">
	<tr>
		<th>Title</th>
		<th>Description</th>
		<th>Preview</th>
	</tr>
	@foreach ($images as $image)
	<tr>
		<td>{{ $image->title }}</td>
		<td>{{ $image->description }}</td>
		<td>
			<a href={{ $image->url }}>
				<img class="preview" src={{ $image->url }} />
			</a>
		</td>
	</tr>
	@endforeach
	</table>

@stop