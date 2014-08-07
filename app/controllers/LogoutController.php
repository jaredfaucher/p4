<?php

class LogoutController extends BaseController {

	public function getLogout()
	{
		# Logs out user
    	Auth::logout();

    	# Redirects to the homepage
    	return Redirect::to('/');
	}

}
