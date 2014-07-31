<?php

Route::get('/', 'HomeController@getIndex');

Route::get('/register', 'RegisterController@getRegister');

Route::post('/register', array('before' => 'csrf', 
                               'uses' => 'RegisterController@postRegister'));

Route::get('/login', 'LoginController@getLogin');

Route::post('/login', array('before' => 'csrf', 
                            'uses' => 'LoginController@postLogin'));

Route::get('/logout', 'LogoutController@getLogout');

Route::get('/myprofile', 'ProfileController@myProfile');

Route::get('/myprofile/edit', 'ProfileController@getEdit');

Route::post('/myprofile/edit', 'ProfileController@postEdit');

Route::get('/profile/{username}', 'ProfileController@userProfile');

Route::get('/add', 'PartsController@addForm');

Route::post('/add', array('before' => 'csrf', 
                          'uses' => 'PartsController@addPart'));

Route::post('/delete', array('before' => 'csrf', 
                             'uses' => 'PartsController@deletePart'));

Route::get('/search', 'SearchController@getSearch');

Route::post('/search', 'SearchController@postSearch');

Route::post('/request', 'ProfileController@requestPart');

Route::get('/password/reset', 'RemindersController@getRemind');

Route::post('/password/reset', 'RemindersController@postRemind');

Route::get('/password/reset/{token}', 'RemindersController@getReset');

Route::post('/password/reset/{token}', array(
										'uses' => 'RemindersController@postReset',
										'as' => 'password.update'));