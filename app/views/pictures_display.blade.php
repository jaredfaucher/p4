@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: {{ $user->username }}'s Pictures</h1>
</div>
<br>
<div class='row text-center'>
	<div class="col-md-3">
		<a href='/'>Go Home</a>
	</div>
	<div class="col-md-2">
		<a href='/myprofile'>My Profile</a>
	</div>
	<div class="col-md-2">
		<a href='/search'>Search Users or Parts</a>
	</div>
   	<div class="col-md-2">
   		<a href='/logout'>Log out</a>
   	</div>
	<div class="col-md-3">
		<a href={{ '"/profile/'.$user->username.'"' }}>Back to Profile</a>
	</div>
</div>
<div class="row text-center">
	<h3>{{ $user->username }}'s Pictures</h3>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="three-column">Title</th>
			<th class="three-column">Description</th>
			<th class="three-column">Preview</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($images as $image)
		<tr>
			<td class="filterable-cell three-column">{{ $image->title }}</td>
			<td class="filterable-cell three-column">{{ $image->description }}</td>
			<td class="filterable-cell three-column">
				<a href={{ $image->url }}>
					<img class="preview" src={{ $image->url }} />
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop