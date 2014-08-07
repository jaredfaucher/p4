<?php

class ImageController extends BaseController 
{
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
      	include 'image_helper.php';

       	$rules = array(
                'file' => 'required|image',
                'title' => 'required',
                'description' => 'required'
            );

       	$validator = Validator::make(Input::all(), $rules);

       	if ($validator->fails())
        {
            return Redirect::to('/myprofile/edit/add')
                ->with('flash_message', 'Add failed, please fix errors and try again')
                ->withInput()
                ->withErrors($validator);
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
        require 'helpers\image_helper.php';

    	$id = Input::get('id');
    	$image = Image::find($id);

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