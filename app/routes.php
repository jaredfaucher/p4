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
	# ADD USER TO USERS TABLE AND THEN GENERATE ADD FORM
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