<?php

class ProfileController extends BaseController {

	public function myProfile()
	{
		$parts = Part::where('user_id', '=', Auth::user()->id)->get();
		return View::make('profile_template')
			->with('parts', $parts)
			->with('user', Auth::user());
	}

	public function getEdit()
	{
		return View::make('profile_edit')
			->with('user', Auth::user());
	}

	public function postEdit()
	{
		$credentials = array(
						'username' => Auth::user()->username,
						'password' => Input::get('password'));
		if (Auth::validate($credentials))
		{
            $change = Input::get('change');
            $user = Auth::user();
            if($change == 'password')
            {
            	$newPassword = Input::get('newPassword');
            	$confirmNewPassword = Input::get('confirmNewPassword');
            	if ($newPassword == $confirmNewPassword)
            	{
            		$user->password = Hash::make($newPassword);
            		try
            		{
            			$user->save();
            		}
            		catch (Exception $e) {
            			return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'Change failed. Try again!');
            		}
            	}
            	else
            	{
            		return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'New password and confirmation do not match. Try again!');
            	}
            }
            elseif($change == 'email')
            {
            	$newEmail = Input::get('newEmail');
            	$confirmNewEmail = Input::get('confirmNewEmail');
            	if ($newEmail == $confirmNewEmail)
            	{
            		$user->email = $newEmail;
            		try
            		{
            			$user->save();
            		}
            		catch (Exception $e) {
            			return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'Change failed. Try again!');
            		}
            	}
            	else
            	{
            		return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'New email and confirmation do not match. Try again!');
            	}
            }
            elseif($change == 'zip')
            {
            	$newZip = Input::get('newZip');
            	$confirmNewZip = Input::get('confirmNewZip');
            	if ($newZip == $confirmNewZip)
            	{
            		$user->zip = $newZip;
            		try
            		{
            			$user->save();
            		}
            		catch (Exception $e) {
            			return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'Change failed. Try again!');
            		}
            	}
            	else
            	{
            		return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'New Zip and confirmation do not match. Try again!');
            	}
            }
        }
        else {
            return Redirect::to('/myprofile/edit')
                ->with('flash_message', 'Incorrect password; please try again.')
            	->withInput();
        }
	}

	public function userProfile($username)
	{
		try {
			$user = User::findOrFail($username);
		}
		catch(Exception $e) {
            return Redirect::to('/search')->with('flash_message', 'User not found');
        }
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
