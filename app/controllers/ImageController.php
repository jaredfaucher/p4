<?php

class ImageController extends BaseController {

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
            $image->imgurId = $data['id'];
            
            if (Input::get('profile') === 'true')
            {
            	# find old profile picture and change it to false
            	$oldImage = Image::where('profile', '=', true)->first();
            	if(!empty($oldImage))
            	{
            		$oldImage->profile = false;
            	}
            	# set new picture as profile
            	$image->profile = true;
            }
            else
            {
            	$image->profile = false;
            }
            
            # save image, catching errors
            try {
                $image->save();
            }
            catch(Exception $e) {
                return Redirect::to('/myprofile/edit')->with('flash_message', 'Image not uploaded, please try again');
            }
            try {
            	File::delete($destinationPath.$filename);
            }
            catch(Exception $e) {
            	return Redirect::to('/myprofile/edit')->with('flash_message', 'Temporary Image not deleted. Contact Admin.');
            }
            
            return Redirect::to('/myprofile')->with('flash_message', 'Your new image was added!');
        }
        else
        {
            return Redirect::to('/myprofile/edit')->with('flash_message', 'Image not uploaded, please try again');
        }
    }
	public function getDeleteImage()
    {
        if (Auth::user())
        {
            $images = Image::where('user_id', '=', Auth::user()->id)->get();
            return View::make('delete_form')
            	->with('images', $images)
                ->with('user', Auth::user());
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }       
    }

    public function postDeleteImage()
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

    	$id = Input::get('id');
    	$image = Image::find($id);
    	
    	# delete from imgur
    	# TODO:$basic = $client->api('image')->deleteImage($image->imgurId);

    	# delete from database
    	try {
    		$image->delete();
    	}
    	# Fail
    	catch (Exception $e) {
        	return Redirect::to('/myprofile')
        		->with('flash_message', 'Delete failed; Contact administrator')
        		->with('user', Auth::user()->username)
        		->withInput();
    	}
    	return Redirect::to('/myprofile')
    		->with('flash_message', 'Your image was succesfully deleted');
    }
}