<?php

class ProfileController extends BaseController {

	public function myProfile()
	{
		$parts = Part::where('user_id', '=', Auth::user()->id)->get();
		return View::make('profile_template')
			->with('parts', $parts)
			->with('user', Auth::user());
	}

	public function userProfile($username)
	{
		$user = User::where('username', '=', $username)->first();
		$parts = Part::where('user_id', '=', $user->id)->get();
		return View::make('profile_template')
			->with('parts', $parts)
			->with('user', $user);
	}
	public function requestPart()
	{
        $fromUser = Auth::user();
        $part = Part::where('id', '=', Input::get('id'))->first();
        $toUser = User::where('id', '=', $part->user_id)->first();
        # SEND REQUEST EMAIL
        Mail::send('emails.request', array('toUser' => $toUser, 'fromUser' => $fromUser, 'part' => $part), function($message) use ($toUser)
        {
            $message->to($toUser->email, $toUser->username)
                    ->subject('Someone is interested in your parts!');
        });
        return Redirect::to('/profile/'.$toUser->username);
	}

}
