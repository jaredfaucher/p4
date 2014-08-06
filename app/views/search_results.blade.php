@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
<div class="row text-center">
	<h1 class="title">Bike Swap :: Seach Results</h1>
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
		<a href='/search'>Search Users or Parts</a>
	</div>
   	<div class="col-md-3">
   		<a href='/logout'>Log out</a>
   	</div>
</div>
	@if(!empty($parts))
		<table class="table table-striped">
			<thead>
			<tr>
				<th class="three-column">Type</th>
				<th class="three-column">Name</th>
				<th class="three-column">User</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($parts as $part)
				<tr>
					<td class="filterable-cell three-column">{{ $part->type }}</td>
					<td class="filterable-cell three-column">{{ $part->part_name }}</td>
					<td class="filterable-cell three-column">
						<a href={{ '"/profile/'.$usernames[$part->id].'"' }}>
							{{ $usernames[$part->id] }}
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	@elseif(!empty($closeUsers))
		<table class="table table-striped" id="search">
			<thead>
			<tr>
				<th class="three-column three-column">Username</th>
				<th class="three-column three-column">Email</th>
				<th class="three-column three-column">Zip Code</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($closeUsers as $user)
			<tr>
				<td class="filterable-cell three-column">
					<a href={{ '"/profile/'.$user->username.'"' }}>
						{{ $user->username }}
					</a>
				</td>
				<td class="filterable-cell three-column">{{ $user->email }}</td>
				<td class="filterable-cell three-column">{{ $user->zip }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
	@elseif(!empty($users))
		<table class="table table-striped" id="search">
			<thead>
			<tr>
				<th class="three-column">Username</th>
				<th class="three-column">Email</th>
				<th class="three-column">Zip Code</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
			<tr>
				<td class="filterable-cell three-column">
					<a href={{ '"/profile/'.$user->username.'"' }}>
						{{ $user->username }}
					</a>
				</td>
				<td class="filterable-cell three-column">{{ $user->email }}</td>
				<td class="filterable-cell three-column">{{ $user->zip }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>	
	@elseif(empty($users))
		<h3>There are no users matching that criteria.  Try again!</h3>
	@endif
@stop