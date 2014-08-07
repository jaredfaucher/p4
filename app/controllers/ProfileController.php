<?php

class ProfileController extends BaseController {

	public function getMyProfile()
	{
		# Checks if user is logged in
        if (Auth::user())
        {
            # retrieves user's parts and profile image
            $parts = Part::where('user_id', '=', Auth::user()->id)->get();
            $image = Image::where('user_id', '=', Auth::user()->id)
                        ->where('profile', '=', true)->first();
            # Assigns profile picture url to $url if it exists.
            if (!empty($image))
            {
                $url = $image->url;
            }
            # Assigns blank URL if it does not
            else
            {
                $url = 'http://i.imgur.com/Vy5qP5V.gif';
            }
            # Generates profile template with parts, profile picture url and user info
            return View::make('profile_template')
                ->with('parts', $parts)
                ->with('url', $url)
                ->with('user', Auth::user());
        }
        # Redirects to login form if user is not logged in
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }
	}

	public function getEdit()
	{
        # Checks if user is logged in
        if (Auth::user())
        {
            # Generates profile edit view
            return View::make('profile_edit')
                ->with('user', Auth::user());
        }
        # Redirects to login form if user is not logged in
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }		
	}

	public function postEdit()
	{
		# Get credentials from edit form to validate user's password
        $credentials = array(
						'username' => Auth::user()->username,
						'password' => Input::get('password'));
		if (Auth::validate($credentials))
		{
            # Get the change type from form: password, email or zipcode
            $change = Input::get('change');
            $user = Auth::user();
            if($change == 'password')
            {
                # If changing password, ensure the new password and confirmation are the same
                $newPassword = Input::get('newPassword');
            	$confirmNewPassword = Input::get('confirmNewPassword');
            	if ($newPassword == $confirmNewPassword)
            	{
            		# Hash the new password, enter it into user object and save user
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
            	# Redirect to edit form if new password and confirm do not match
                else
            	{
            		return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'New password and confirmation do not match. Try again!');
            	}
            }
            elseif($change == 'email')
            {
                # If changing email, ensure the new email and confirmation are the same
                $newEmail = Input::get('newEmail');
            	$confirmNewEmail = Input::get('confirmNewEmail');
            	if ($newEmail == $confirmNewEmail)
            	{
            		# Enter email into user object and attempt to save user
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
            	# Redirect to edit form if new email and confirm do not match
                else
            	{
            		return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'New email and confirmation do not match. Try again!');
            	}
            }
            elseif($change == 'zip')
            {
                # If changing zip, ensure the new zip and confirmation are the same
                $newZip = Input::get('newZip');
            	$confirmNewZip = Input::get('confirmNewZip');
            	if ($newZip == $confirmNewZip)
            	{
            		# Enter zip into user object and attempt to save user
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
            	# Redirect to edit form if new zip and confirm do not match
                else
            	{
            		return Redirect::to('/myprofile/edit')
                		->with('flash_message', 'New Zip and confirmation do not match. Try again!');
            	}
            }
            
            # SEND CONFIRMATION EMAIL
            Mail::send('emails.change', array('username' => $user->username, 'change' => $change), function($message) use ($user)
            {
                $message->to($user->email, $user->username)
                    ->subject('Your Account has been changed');
            });
            # Redirect to profile with flash message if change was successfull
            return Redirect::to('/myprofile')
                ->with('flash_message', 'Changes Made!');
        }
        # Redirect to edit form if user entered incorrect password
        else {
            return Redirect::to('/myprofile/edit')
                ->with('flash_message', 'Incorrect password; please try again.')
            	->withInput();
        }
	}

	public function getProfile($username)
	{
        # Attempt to generate user's profile if current user is logged in
        if (Auth::user())
        {
            # Try to find a user in database with usename entered into URL
            try {
                $user = User::where('username', '=', $username)->firstOrFail();
            }
            catch(Exception $e) {
                # Redirect to search page if user is not found
                return Redirect::to('/search')->with('flash_message', 'User not found');
            }
            # Get users parts and profile picture from database
            $parts = Part::where('user_id', '=', $user->id)->get();
            $image = Image::where('user_id', '=', $user->id)
                        ->where('profile', '=', true)->first();
            # If profile picture is not empty, get url to imgur page to display image
            if (!empty($image))
            {
                $url = $image->url;
            }
            # If user does not have a profile picture use default
            else
            {
                $url = 'http://i.imgur.com/Vy5qP5V.gif';
            }
            # Return profile template with user information
            return View::make('profile_template')
                ->with('parts', $parts)
                ->with('url', $url)
                ->with('user', $user);
        }
        # Prompt user to log in if not logged in
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }		
	}

    public function getPictures($username)
    {
        # Attempt to generate user's pictures if user is logged in
        if (Auth::user())
        {
            # Try to find a user in database with usename entered into URL
            try {
                $user = User::where('username', '=', $username)->firstOrFail();
            }
            catch(Exception $e) {
                # Redirect to search page if user is not found
                return Redirect::to('/search')->with('flash_message', 'User not found');
            }
            # Get user's images from database
            $images = Image::where('user_id', '=', $user->id)->get();
            # Return pictures_display view with user's information and images
            return View::make('pictures_display')
                ->with('images', $images)
                ->with('user', $user);
        }
        # Prompt user to log in if not logged in
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }       
    }

	public function postRequest()
	{
        # Set the logged in user to $fromUser for email
        $fromUser = Auth::user();
        # Find the part they are requesting from database with form information
        $part = Part::where('id', '=', Input::get('id'))->first();
        # Find the user in databse with part information
        $toUser = User::where('id', '=', $part->user_id)->first();
        # SEND REQUEST EMAIL
        Mail::send('emails.request', array('toUser' => $toUser, 'fromUser' => $fromUser, 'part' => $part), function($message) use ($toUser)
        {
            $message->to($toUser->email, $toUser->username)
                    ->subject('Someone is interested in your parts!');
        });
        # Redirect user back to profile
        return Redirect::to('/profile/'.$toUser->username);
	}
}