<?php

class ProfileController extends BaseController {

	public function myProfile()
	{
		$parts = Part::where('user_id', '=', Auth::user()->id)->get();
		return View::make('profile_template')->with('parts', $parts)
											 ->with('user', Auth::user());
	}

	public function userProfile($username)
	{
		$user = User::where('username', '=', $username)->first();
		$parts = Part::where('user_id', '=', $user->id)->get();
		return View::make('profile_template')->with('parts', $parts)
											 ->with('user', $user);
	}

}
