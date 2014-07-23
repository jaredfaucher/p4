<?php

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/register', function()
{
	return View::make('register_form');
});

Route::post('/register', function()
{
	$user = new User();
	
	$user->username = Input::get('username');
	# ENSURE USERNAME IS UNIQUE
	$query = User::where('username', '=', $user->username)->first();
	if (is_null($query) == false)
	{
		return View::make('register_form')->with('error','Error: Username exists! Try another!');
	}
	
	$user->email = Input::get('email');
	# ENSURE EMAIL IS UNIQUE
	$query = User::where('email', '=', $user->email)->first();
	if (is_null($query) == false)
	{
		return View::make('register_form')->with('error','Error: Email in use already! Try another!');
	}
	
	$user->password = Input::get('password');
	# ENSURE PASSWORD IS STRONG (optional)
	$user->password = Hash::make($user->password);
	
	$user->save();

	# SEND CONFIRMATION EMAIL
	Mail::send('emails.register', array('username' => $user->username), function($message) use ($user)
	{
		$message->to($user->email, $user->username)
				->subject('Welcome to Bike Swap!');
	});


	return View::make('register_confirm');
});

Route::get('/login', function()
{
	return View::make('login_form');
});

Route::post('/login', function()
{
	# VALIDATE LOGIN INFORMATION AND REDIRECT TO PROFILE
});

Route::get('/profile/{user}', function()
{
	return View::make('profile_template');
});

Route::get('/search', function()
{
	return View::make('search_form');
});

Route::post('/search/{query}', function()
{
	return View::make('search');
});

Route::get('/mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    print_r($results);

});