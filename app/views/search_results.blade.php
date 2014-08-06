@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: Seach Results</h1>
	<br>
	<a href='/'>Go Home</a><br>
	@if(!empty($parts))
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Type</th>
				<th>Name</th>
				<th>User</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($parts as $part)
				<tr>
					<td class="filterable-cell">{{ $part->type }}</td>
					<td class="filterable-cell">{{ $part->part_name }}</td>
					<td class="filterable-cell">
						<a href={{ '"/profile/'.$usernames[$part->id].'"' }}>
							{{ $usernames[$part->id] }}
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	@elseif(!empty($closeUsers))
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Zip Code</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($closeUsers as $user)
			<tr>
				<td class="filterable-cell">
					<a href={{ '"/profile/'.$user->username.'"' }}>
						{{ $user->username }}
					</a>
				</td>
				<td class="filterable-cell">{{ $user->email }}</td>
				<td class="filterable-cell">{{ $user->zip }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
	@elseif(!empty($users))
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Zip Code</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
			<tr>
				<td class="filterable-cell">
					<a href={{ '"/profile/'.$user->username.'"' }}>
						{{ $user->username }}
					</a>
				</td>
				<td class="filterable-cell">{{ $user->email }}</td>
				<td class="filterable-cell">{{ $user->zip }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>	
	@elseif(empty($users))
		<h3>There are no users matching that criteria.  Try again!</h3>
	@endif
@stop