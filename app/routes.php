<?php

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/register', function()
{
	return View::make('register_form');
});

Route::post('/register', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
            $user->username = Input::get('username');
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/register')->with('error', 'Register failed; please try again.')->withInput();
            }
            
            # SEND CONFIRMATION EMAIL
            Mail::send('emails.register', array('username' => $user->username), function($message) use ($user)
            {
                $message->to($user->email, $user->username)
                        ->subject('Welcome to Bike Swap!');
            });


            return View::make('register_confirm');

        }
    )
);

Route::get('/login', function()
{
	return View::make('login_form');
});

Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('username', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                
                return Redirect::intended('/');
            }
            else {
                return Redirect::to('/login')->with('error', 'Log in failed; please try again.');
            }
        }
    )
);

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

Route::get('/profile/{user}', function()
{
	$parts = Part::where('user_id', '=', Auth::user()->id)->get();
	return View::make('profile_template')->with('parts', $parts);
});

Route::get('/manage', function()
{
	return View::make('manage_form');
});

Route::get('/search', function()
{
	return View::make('search_form');
});

Route::post('/search/{query}', function()
{
	return View::make('search');
});