<?php

class ProfileController extends BaseController {

	public function getMyProfile()
	{
		if (Auth::user())
        {
            $parts = Part::where('user_id', '=', Auth::user()->id)->get();
            $img = Image::where('user_id', '=', Auth::user()->id)->first();
            if (!empty($img))
            {
                $url = $img->url;
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

    public function getAddImage()
    {
        if (Auth::user())
        {
            return View::make('add_image')
                ->with('user', Auth::user());
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }       
    }

    public function postAddImage()
    {
        # set up imgur connection
        $client = new \Imgur\Client();
        $client->setOption('client_id', 'd6c1ad7da60dc22');
        $client->setOption('client_secret', 'f3d89c626d4a3ce5a41e23351400e942d79542a6');

        if (isset($_SESSION['token'])) {
            $client->setAccessToken($_SESSION['token']);
            if($client->checkAccessTokenExpired()) {
                $client->refreshToken();
            }
        }
        elseif (isset($_GET['code'])) {
                $client->requestAccessToken($_GET['code']);
                $_SESSION['token'] = $client->getAccessToken();
        }
        else {
            echo '<a href="'.$client->getAuthenticationUrl().'">Click to authorize</a>';
        }
        
        # get file from upload and put in tmp folder
        $file = Input::file('file');
        $destinationPath = storage_path()."\\tmp\\";
        $filename = $file->getClientOriginalName();
        
        if ($file->move($destinationPath, $filename))
        {
            # fill in image data for imgur upload
            $imageData = array(
                    'image' => $destinationPath.$filename,
                    'type' => 'file',
                    'name' => $filename,
                    'title' => Input::get('title'),
                    'description' => Input::get('description'));
            
            # upload data
            $basic = $client->api('image')->upload($imageData);
            
            # get data to put in database
            $data = $basic->getData();

            $image = new Image;
            $image->user_id = Auth::user()->id;       
            $image->filename = $filename;
            $image->size = $data['size'];
            $image->url = $data['link'];
            $image->title = $data['title'];
            $image->description = $data['description'];
            
            # save image, catching errors
            try {
                $image->save();
            }
            catch(Exception $e) {
                return Redirect::to('/myprofile/edit')->with('flash_message', 'Image not uploaded, please try again');
            }

            return Redirect::to('/myprofile')->with('flash_message', 'Your new image was added!')

        }
        else
        {
            return Redirect::to('/myprofile/edit')->with('flash_message', 'Image not uploaded, please try again');
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
            $img = Image::where('user_id', '=', $user->id)->get();
            $url = $img->url;
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
