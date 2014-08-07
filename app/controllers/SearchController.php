<?php

class SearchController extends BaseController {

	public function getSearch()
	{
		# Genarate search form if user if logged in
        if (Auth::user())
        {
            return View::make('search_form');
        }
        # Prompt user to log in if not logged in
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }
	}
	public function postSearch()
	{
    	# Get input to determine which form was submitted
        $query = Input::get('query');
        $distanceAway = Input::get('distanceAway');
        $username = Input::get('username');
        
        # Execute if $distanceAway and $username are empty
        if (empty($distanceAway) && empty($username))
    	{
        	# Validates that $query is not empty
            /*$rules = array(
                'query' => 'required');
            $validator = Validator::make(array($query), $rules);
            # Returns to search from if validator fails
            if ($validator->fails())
            {
                return Redirect::to('/search')
                    ->with('flash_message', 'Search failed, provide input and try again')
                    ->withInput()
                    ->withErrors($validator);
            }*/
            # Adds wildcard to entered query and searches for parts with similar name           
            $query = '%'.$query.'%';
            # Gets type from input
            $type = Input::get('type');
        	# Searches for part with similar name.  
            # Searches all types if type was 'any'
            if ($type == 'any')
            {
                $parts = Part::where('part_name', 'LIKE', '%'.$query.'%')->get();
            }
            # Filters search results if type was specified
            else
            {
                $parts = Part::where('part_name', 'LIKE', '%'.$query.'%')
                    ->where('type', '=', $type)
                    ->get();
            }
            $usernames = null;
            # Finds corresponding users for parts found
            foreach ($parts as $part)
            {
                $user = User::where('id', '=', $part->user_id)->first();

                $usernames[$part->id] = $user->username;
        	}
            # Returns search results with $parts and corresponding $usernames
            return View::make('search_results')
                ->with('parts', $parts)
                ->with('usernames', $usernames);

    	}
    	# Execute if $query and $username are empty
        elseif (empty($query) && empty($username))
    	{
            # Validate that $distanceAway is not empty
            /*$rules = array(
                'distanceAway' => 'required');
            $validator = Validator::make(array($distanceAway), $rules);

            # Return user to search form if validator fails
            if ($validator->fails())
            {
                return Redirect::to('/search')
                    ->with('flash_message', 'Search failed, provide input and try again')
                    ->withInput()
                    ->withErrors($validator);
            }*/


            # Search Helper Functions

            # Uses Google Geocode API to get lat/long coordinates from Zip Code
            /*function getCoordinates($zip)
            {
                $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=false';
                $json = file_get_contents($url);
                $obj = json_decode($json);
                $coordinates['lat'] = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $coordinates['long'] = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                return $coordinates;
            }
            # Calculates distance between two lat/long points
            function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) 
            {
                $theta = $longitude1 - $longitude2;
                $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                return $miles; 
            }*/
            
            # Unsuccessful attempt to fix helpers problem
            /*if (App::environment() == 'production')
            {
                set_include_path(get_include_path() . PATH_SEPARATOR . $_ENV['OPENSHIFT_REPO_DIR']);
                include 'app\controllers\helpers\search_helper.php';
            }
            else
            {
                include app_path().'\controllers\helpers\search_helper.php';
            }*/

            include 'search_helper.php';

            # Calculate logged in user's lat/long coordinates
            $coordinates1 = getCoordinates(Auth::user()->zip);
        	
            # Retrieves all users to calculate distance
            $users = User::all();
        	# Flag variable for $closeUsers array
            $i = 0;
            
            # Loops through all users in $users and calculates distance from logged in user
        	foreach ($users as $user)
        	{
            	# Skips logged in user
                if ($user->id == Auth::user()->id)
            	{
                    continue;
            	}
            	else
            	{
                    $coordinates2 = getCoordinates($user->zip);
                	$distanceBetween = calculateDistance($coordinates1['lat'], 
                                                         $coordinates1['long'], 
                                                         $coordinates2['lat'],
                                                         $coordinates2['long']);
                    # Adds user to $closerUsers array if they are close enough
                    # Increments $i
                    if ($distanceBetween <= $distanceAway)
                	{
                        $closeUsers[$i] = $user;
                    	$i++;
                	}
            	}
        	}
            # Returns Search Results view if $closerUsers contains users
        	if (!empty($closeUsers))
        	{
            	return View::make('search_results')
                    ->with('closeUsers', $closeUsers);
        	}
            # Returns search results view with $distanceAway to tell user there is no one within the chosen radius
        	else
        	{
        		return View::make('search_results')
                    ->with('distanceAway', $distanceAway);
        	}
    	}

        # Execute if $distanceAway and $query are empty
        else
        {
            # Validates that username was entered
            /*$rules = array(
                'username' => 'required');
            $validator = Validator::make(array($username), $rules);

            # Returns to search form if validator fails
            if ($validator->fails())
            {
                return Redirect::to('/search')
                    ->with('flash_message', 'Search failed, please provide input and try again')
                    ->withInput()
                    ->withErrors($validator);
            }*/
            # Adds wildcard to entered username and searches for user with similar name           
            $username = '%'.$username.'%';
            $users = User::where('username', 'LIKE', '%'.$username.'%')->get();
            # Returns search results view with $users
            return View::make('search_results')
                ->with('users', $users);
        }
	}
}