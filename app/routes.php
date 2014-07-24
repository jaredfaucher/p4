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
            $user->email = Input::get('email');
            $user->zip = Input::get('zip');
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

Route::get('/add', function()
{
	return View::make('add_form');
});

Route::post('/add', 
	array(
        'before' => 'csrf', 
        function()
		{
			$part = new Part;
			$part->type = Input::get('type');
			$part->part_name = Input::get('part_name');
			$part->user_id = Auth::user()->id;

   			# Try to add the part 
    		try {
        		$part->save();
    		}
    		# Fail
    		catch (Exception $e) {
        		return Redirect::to('/add')->with('error', 'Add failed; please try again.')->withInput();
    		}

			return Redirect::to('/profile/{user}')->with('user', Auth::user()->username);
	    }
	)
);

Route::post('/delete', 
	array(
        'before' => 'csrf', 
        function()
		{
			# DELETE THE PART
			$id = Input::get('id');
			$part = Part::find($id);
			try {
        		$part->delete();
    		}
    		# Fail
    		catch (Exception $e) {
        		return Redirect::to('/profile/{user}')->with('error', 'Add failed; please try again.')
        											  ->with('user', Auth::user()->username)
        											  ->withInput();
    		}

			return Redirect::to('/profile/{user}')->with('user', Auth::user()->username);
	    }
	)
);

Route::get('/search', function()
{
	return View::make('search_form');
});

Route::post('/search', function()
{
	$query = Input::get('query');
    if (!empty($query))
    {
        $parts = Part::where('name', 'LIKE', $query);
        return View::make('search_results')->with($parts);

    }
    else
    {
        include('PostalCode.php');

        $myLocation = new PostalCode(Input::get('zip'));
        $distanceAway = Input::get('distance');
        $users = User::all();
        $i = 0;
        foreach ($users as $user)
        {
            $distanceBetween = round($myLocation->getDistanceTo($user->zip), 2);
            if ($distanceBetween <= $distanceAway)
            {
                $closeUsers[$i] = $user;
                $i++;
            }
        }


        return View::make('search_results')->with($closeUsers);
    }
});