<?php

class SearchController extends BaseController {

	public function searchForm()
	{
		return View::make('search_form');
	}
	public function searchResults()
	{
		$query = Input::get('query');
    	if (!empty($query))
    	{
        	$query = '%'.$query.'%';
        	$parts = Part::where('part_name', 'LIKE', '%'.$query.'%')->get();

        	return View::make('search_results')->with('parts', $parts);

    	}
    	else
    	{
        	$distanceAway = Input::get('distanceAway');
        	function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) {
            	$theta = $longitude1 - $longitude2;
            	$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
            	$miles = acos($miles);
            	$miles = rad2deg($miles);
            	$miles = $miles * 60 * 1.1515;
            	return $miles; 
        	}

        	$currentUser = Auth::user();
        	$zip = $currentUser->zip;
        	$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=false';
        	$json = file_get_contents($url);
        	$obj = json_decode($json);

        	$lat1 = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        	$long1 = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        	$users = User::all();
        	$i = 0;
        
        	foreach ($users as $user)
        	{
            	if ($user->id == $currentUser->id)
            	{
                	continue;
            	}
            	else
            	{
                	$zip = $user->zip;
                	$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=false';
               		$json = file_get_contents($url);
                	$obj = json_decode($json);

                	$lat2 = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                	$long2 = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            
                	$distanceBetween = calculateDistance($lat1, $long1, $lat2, $long2);
                	if ($distanceBetween <= $distanceAway)
                	{
                    	$closeUsers[$i] = $user;
                    	$i++;
                	}
            	}
        	}
        	if (!empty($closeUsers))
        	{
            	return View::make('search_results')->with('closeUsers', $closeUsers);
        	}
        	else
        	{
        		echo "you're alone";
        	}
    	}
	}

}
