<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class SearchController extends BaseController {

	public function getSearch()
	{
		if (Auth::user())
        {
            return View::make('search_form');
        }
        else
        {
            return Redirect::to('/login')
                ->with('flash_message', 'Please log in');
        }
	}
	public function postSearch()
	{
    	$query = Input::get('query');
        $distanceAway = Input::get('distanceAway');
        $username = Input::get('username');
        if (empty($distanceAway) && empty($username))
    	{
        	$query = '%'.$query.'%';
            $type = Input::get('type');
        	if ($type == 'any')
            {
                $parts = Part::where('part_name', 'LIKE', '%'.$query.'%')->get();
            }
            else
            {
                $parts = Part::where('part_name', 'LIKE', '%'.$query.'%')
                    ->where('type', '=', $type)
                    ->get();
            }
            foreach ($parts as $part)
            {
                $user = User::where('id', '=', $part->user_id)->first();

                $usernames[$part->id] = $user->username;
        	}
            return View::make('search_results')
                ->with('parts', $parts)
                ->with('usernames', $usernames);

    	}
    	elseif (empty($query) && empty($username))
    	{
            # Search Helper Functions
            /*function getCoordinates($zip)
            {
                $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=false';
                $json = file_get_contents($url);
                $obj = json_decode($json);
                $coordinates['lat'] = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $coordinates['long'] = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                return $coordinates;
            }
            function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) 
            {
                $theta = $longitude1 - $longitude2;
                $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                return $miles; 
            }*/
            
            if (App::environment() == 'production')
            {
                set_include_path(get_include_path() . PATH_SEPARATOR . $_ENV['OPENSHIFT_REPO_DIR']);
                include app_path().'\controllers\helpers\search_helper.php'; 
            }
            else
            {
                include app_path().'\controllers\helpers\search_helper.php';
            }

            $coordinates1 = getCoordinates(Auth::user()->zip);
        	$users = User::all();
        	$i = 0;
        
        	foreach ($users as $user)
        	{
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
                    if ($distanceBetween <= $distanceAway)
                	{
                        $closeUsers[$i] = $user;
                    	$i++;
                	}
            	}
        	}
        	if (!empty($closeUsers))
        	{
            	return View::make('search_results')
                    ->with('closeUsers', $closeUsers);
        	}
        	else
        	{
        		return View::make('search_results')
                    ->with('distanceAway', $distanceAway);
        	}
    	}
        else
        {
            $username = '%'.$username.'%';
            $users = User::where('username', 'LIKE', '%'.$username.'%')->get();
            return View::make('search_results')
                ->with('users', $users);
        }
	}
}
