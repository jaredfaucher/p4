<?php

class LoginController extends BaseController {

	public function getLogin()
	{
		return View::make('login_form');
	}

	public function postLogin()
	{
        $credentials = Input::only('username', 'password');

        if (Auth::attempt($credentials, $remember = true)) {
             
            return Redirect::intended('/');
        }
        else {
            return Redirect::to('/login')
                ->with('flash_message', 'Log in failed; please try again.')
            	->withInput();
        }
	}
}