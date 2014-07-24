@extends('_master')
		
@section('title')
	Bike Swap
@stop

@section('content')
	<h1>Bike Swap</h1>
	<blockquote>
		<h4>by Jared Faucher<br>Dynamic Web Applications, Summer 2014</h4>
		<p>A community where people can try out, trade and buy/sell bike parts with people in their community</p>
	</blockquote>
	<div class="row">
		@if(Auth::check())
    	<div class="col-md-3"><a href="{{ URL::to('profile/' . Auth::user()->username) }}" >My Profile</a></div>
		<div class="col-md-3"><a href='/search'>Search Users or Parts</a></div>
		<div class="col-md-3"><a href='/manage'>Add/Remove Parts</a></div>
    	<div class="col-md-3"><a href='/logout'>Log out</a></div>
		@else 
		<div class="col-md-4"><a href="/login">Login</a></div>
  		<div class="col-md-4"><a href="/register">Register</a></div>
  		@endif
	</div>
@stop
