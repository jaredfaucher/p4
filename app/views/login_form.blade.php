@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1 class="title">Bike Swap :: Login</h1>
	<br>
	<div class='row text-center'>
		<div class="col-md-3"></div>
		<div class="col-md-3">
			<a href='/'>Go Home</a>
		</div>
		<div class="col-md-3">
			<a href='/register'>Register</a>
		</div>
		<div class="col-md-3"></div>
	</div>
	<br>
    @if(Session::get('error'))
        <div class='error'>{{ Session::get('error') }}</div>
    @endif
	
	{{ Form::open(array('url' => '/login', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Username: </div>
			<div class="col-md-3">{{ Form::text('username') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">Password: </div>
			<div class="col-md-3">{{ Form::password('password') }}</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3">
				<a href='/password/reset'>Forgot your password?</a>
			</div>
			<div class="col-md-3"></div>
		</div>
		<br>
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4">{{ Form::submit('Login') }}</div>
			<div class="col-md-4"></div>
		</div>

	{{ Form::close() }}

@stop