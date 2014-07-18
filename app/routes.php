<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

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
	return View::make('login');
});

Route::get('/search', function()
{
	return View::make('search');
});

Route::post('/search/{query}', function()
{
	return View::make('search');
});

Route::get('/profile', function()
{
	return View::make('profile');
});

Route::post('/profile/{user}', function()
{
	return View::make('profile');
});