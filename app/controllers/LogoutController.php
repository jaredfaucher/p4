<?php

class LogoutController extends BaseController {

	public function getLogout()
	{
		# Log out
    	Auth::logout();

    	# Send them to the homepage
    	return Redirect::to('/');
	}

}
