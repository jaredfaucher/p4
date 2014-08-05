<?php

Route::get('/', 'HomeController@getIndex');

Route::get('/register', 'RegisterController@getRegister');

Route::post('/register', array('before' => 'csrf', 
                               'uses' => 'RegisterController@postRegister'));

Route::get('/login', 'LoginController@getLogin');

Route::post('/login', array('before' => 'csrf', 
                            'uses' => 'LoginController@postLogin'));

Route::get('/logout', 'LogoutController@getLogout');

Route::get('/myprofile', 'ProfileController@getMyProfile');

Route::get('/myprofile/edit', 'ProfileController@getEdit');

Route::post('/myprofile/edit', 'ProfileController@postEdit');

Route::get('/myprofile/edit/add', 'ImageController@getAddImage');

Route::post('/myprofile/edit/add', 'ImageController@postAddImage');

Route::get('/myprofile/edit/delete', 'ImageController@getDeleteImage');

Route::post('/myprofile/edit/delete', 'ImageController@postDeleteImage');

Route::get('/profile/{username}', 'ProfileController@getProfile');

Route::get('/profile/{username}/pictures', 'ProfileController@getPictures');

Route::get('/add', 'PartsController@getAdd');

Route::post('/add', array('before' => 'csrf', 
                          'uses' => 'PartsController@postAdd'));

Route::post('/delete', array('before' => 'csrf', 
                             'uses' => 'PartsController@postDelete'));

Route::get('/search', 'SearchController@getSearch');

Route::post('/search', 'SearchController@postSearch');

Route::post('/request', 'ProfileController@postRequest');

Route::get('/password/reset', 'RemindersController@getRemind');

Route::post('/password/reset', 'RemindersController@postRemind');

Route::get('/password/reset/{token}', 'RemindersController@getReset');

Route::post('/password/reset/{token}', array(
										'uses' => 'RemindersController@postReset',
										'as' => 'password.update'));