<?php

class LoginController extends BaseController {

	public function getLogin()
	{
		# Generate login form
        return View::make('login_form');
	}

	public function postLogin()
	{
        # Gets entered credentials from input
        $credentials = Input::only('username', 'password');

        # Attempts to authorize user, redirects home on success
        if (Auth::attempt($credentials, $remember = true)) {
             
            return Redirect::intended('/');
        }
        # Redirects to login form if authorization fails
        else {
            return Redirect::to('/login')
                ->with('flash_message', 'Log in failed; please try again.')
            	->withInput();
        }
	}
}