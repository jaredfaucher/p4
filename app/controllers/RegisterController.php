<?php

class RegisterController extends BaseController {

	public function getRegister()
	{
		return View::make('register_form');
	}

	public function postRegister()
	{
	    $rules = array(
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'zip' => 'required|digits:5',
                'password' => 'required|min:6'
            );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails())
        {
            return Redirect::to('/register')
                ->with('flash_message', 'Registration failed, please fix errors and try again')
                ->withInput()
                ->withErrors($validator);
        }

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
            return Redirect::to('/register')
                ->with('flash_message', 'Register failed; please try again.')
                ->withInput();
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
