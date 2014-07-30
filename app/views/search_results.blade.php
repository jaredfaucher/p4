@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Seach Results</h1>
	<br>
	<a href='/'>Go Home</a><br>
	@if(!empty($parts))
		<table class="table">
			<tr>
				<th>Type</th>
				<th>Name</th>
				<th>User</th>
			</tr>
			@foreach ($parts as $part)
			<tr>
				<td>{{ $part->type }}</td>
				<td>{{ $part->part_name }}</td>
				<td>
					<a href={{ '"/profile/'.$usernames[$part->id].'"' }}>
						{{ $usernames[$part->id] }}
					</a>
				</td>
			</tr>
			@endforeach
		</table>	
	@elseif(!empty($closeUsers))
		<table class="table">
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Zip Code</th>
			</tr>
			@foreach ($closeUsers as $user)
			<tr>
				<td>
					<a href={{ '"/profile/'.$user->username.'"' }}>
						{{ $user->username }}
					</a>
				</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->zip }}</td>
			</tr>
			@endforeach
		</table>
	@elseif(!empty($users))
		<table class="table">
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Zip Code</th>
			</tr>
			@foreach ($users as $user)
			<tr>
				<td>
					<a href={{ '"/profile/'.$user->username.'"' }}>
						{{ $user->username }}
					</a>
				</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->zip }}</td>
			</tr>
			@endforeach
		</table>	
	@elseif(empty($users))
		<h3>There are no users matching that criteria.  Try again!</h3>
	@endif
@stop