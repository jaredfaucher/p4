<?php

class LoginController extends BaseController {

	public function loginForm()
	{
		return View::make('login_form');
	}

	public function loginAuth()
	{
        $credentials = Input::only('username', 'password');

        if (Auth::attempt($credentials, $remember = true)) {
             
            return Redirect::intended('/');
        }
        else {
            return Redirect::to('/login')->with('error', 'Log in failed; please try again.');
        }
	}
}