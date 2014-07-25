<?php

class LogoutController extends BaseController {

	public function logout()
	{
		# Log out
    	Auth::logout();

    	# Send them to the homepage
    	return Redirect::to('/');
	}

}
