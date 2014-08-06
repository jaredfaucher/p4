@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: Login</h1>
	<br>
	<a href='/'>Go Home</a><br><br>
    
    @if(Session::get('error'))
        <div class='error'>{{ Session::get('error') }}</div>
    @endif
	
	{{ Form::open(array('url' => '/login', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-2">Username: </div>
			<div class="col-md-2">{{ Form::text('username') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Password: </div>
			<div class="col-md-2">{{ Form::password('password') }}</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<a href='/password/reset'>Forgot your password?</a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-2">{{ Form::submit('Login') }}</div>
		</div>

	{{ Form::close() }}

@stop