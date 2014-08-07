<?php

class PartsController extends BaseController {

	public function getAdd()
	{
		# Generate add form if user is logged in
        if (Auth::user())
        {
            return View::make('add_form');
        }
        # Prompt user to log in if not logged in
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }
	}

	public function postAdd()
	{
		# Set validator rules and attempt to validate input
        $rules = array(
                'type' => 'required',
                'part_name' => 'required'
            );

		$validator = Validator::make(Input::all(), $rules);

		# Return to add form upon failure
        if ($validator->fails())
        {
            return Redirect::to('/add')
                ->with('flash_message', 'Add failed, please fix errors and try again')
                ->withInput()
                ->withErrors($validator);
        }

        # Create new part object and assign input data
		$part = new Part;
		$part->type = Input::get('type');
		$part->part_name = Input::get('part_name');
		$part->user_id = Auth::user()->id;

 		# Try to add the part 
    	try {
        	$part->save();
    	}
    	# Fail
    	catch (Exception $e) {
        	return Redirect::to('/add')
        		->with('flash_message', 'Add failed, please try again.')
        		->withInput();
    	}
        # Redirect to user's profile
		return Redirect::to('/myprofile')
            ->with('flash_message', 'Part successfully added!')
			->with('user', Auth::user()->username);
	}

	public function postDelete()
	{
		# Get part id from form input and find the part in database
		$id = Input::get('id');
		$part = Part::find($id);
		# Try to delete the part
        try {
        	$part->delete();
    	}
    	# Fail
    	catch (Exception $e) {
        	return Redirect::to('/myprofile')
        		->with('flash_message', 'Delete failed; please try again.')
        		->with('user', Auth::user()->username)
        		->withInput();
    	}
        # Redirect to user's profile
		return Redirect::to('/myprofile')
            ->with('flash_message', 'Part successfully deleted!')
			->with('user', Auth::user()->username);
	}

}
