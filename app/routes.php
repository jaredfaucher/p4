<?php

Route::get('/', 'HomeController@showWelcome');

Route::get('/register', 'RegisterController@registerForm');

Route::post('/register', array('before' => 'csrf', 
                               'uses' => 'RegisterController@registerConfirm'));

Route::get('/login', 'LoginController@loginForm');

Route::post('/login', array('before' => 'csrf', 
                            'uses' => 'LoginController@loginAuth'));

Route::get('/logout', 'LogoutController@logout');

Route::get('/myprofile', 'ProfileController@myProfile');

Route::get('/profile/{username}', 'ProfileController@userProfile');

Route::get('/add', 'PartsController@addForm');

Route::post('/add', array('before' => 'csrf', 
                          'uses' => 'PartsController@addPart'));

Route::post('/delete', array('before' => 'csrf', 
                             'uses' => 'PartsController@deletePart'));

Route::get('/search', 'SearchController@searchForm');

Route::post('/search', 'SearchController@searchResults');