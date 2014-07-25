@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap :: Seach Results</h1><br>
	@if(Session::get('parts'))
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
				<td>{{ $part->user_id }}</td>
			</tr>
			@endforeach
		</table>	
	@elseif(Session::get('closeUsers'))
		<table class="table">
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Zip Code</th>
			</tr>
			@foreach ($closeUsers as $user)
			<tr>
				<td>{{ $user->username }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->zip }}</td>
			</tr>
			@endforeach
		</table>	
	@endif	
@stop