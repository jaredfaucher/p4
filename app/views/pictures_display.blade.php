@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: {{ $user->username }}'s Pictures</h1>
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
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Description</th>
				<th>Preview</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($images as $image)
			<tr>
				<td class="filterable-cell">{{ $image->title }}</td>
				<td class="filterable-cell">{{ $image->description }}</td>
				<td class="filterable-cell">
					<a href={{ $image->url }}>
						<img class="preview" src={{ $image->url }} />
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop