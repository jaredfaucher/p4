<?php

class ProfileController extends BaseController {

	public function getMyProfile()
	{
		if (Auth::user())
        {
            $parts = Part::where('user_id', '=', Auth::user()->id)->get();
            $image = Image::where('user_id', '=', Auth::user()->id)
                        ->where('profile', '=', true)->first();
            if (!empty($image))
            {
                $url = $image->url;
            }
            else
            {
                $url = '';
            }
            return View::make('profile_template')
                ->with('parts', $parts)
                ->with('url', $url)
                ->with('user', Auth::user());
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }
	}

	public function getEdit()
	{
        if (Auth::user())
        {
            return View::make('profile_edit')
                ->with('user', Auth::user());
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }		
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
            
            # SEND CONFIRMATION EMAIL
            Mail::send('change.register', array('username' => $user->username, 'change' => $change), function($message) use ($user)
            {
                $message->to($user->email, $user->username)
                    ->subject('Your Account has been changed');
            });

            return Redirect::to('/myprofile')
                ->with('flash_message', 'Changes Made!');
        }
        else {
            return Redirect::to('/myprofile/edit')
                ->with('flash_message', 'Incorrect password; please try again.')
            	->withInput();
        }
	}

	public function getProfile($username)
	{
        if (Auth::user())
        {
            try {
                $user = User::where('username', '=', $username)->firstOrFail();
            }
            catch(Exception $e) {
                return Redirect::to('/search')->with('flash_message', 'User not found');
            }
            $parts = Part::where('user_id', '=', $user->id)->get();
            $image = Image::where('user_id', '=', $user->id)
                        ->where('profile', '=', true)->first();
            if (!empty($image))
            {
                $url = $image->url;
            }
            else
            {
                $url = '';
            }
            return View::make('profile_template')
                ->with('parts', $parts)
                ->with('url', $url)
                ->with('user', $user);
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }		
	}

    public function getPictures($username)
    {
        if (Auth::user())
        {
            try {
                $user = User::where('username', '=', $username)->firstOrFail();
            }
            catch(Exception $e) {
                return Redirect::to('/search')->with('flash_message', 'User not found');
            }
            $images = Image::where('user_id', '=', $user->id)->get();
            return View::make('pictures_display')
                ->with('images', $images)
                ->with('user', $user);
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }       
    }

	public function postRequest()
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