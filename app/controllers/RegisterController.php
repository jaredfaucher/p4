<?php

class RegisterController extends BaseController {

	public function registerForm()
	{
		return View::make('register_form');
	}

	public function registerConfirm()
	{
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
}
