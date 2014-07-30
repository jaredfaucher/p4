<?php

class SearchController extends BaseController {

	public function getSearch()
	{
		return View::make('search_form');
	}
	public function postSearch()
	{
		$query = Input::get('query');
    	if (!empty($query))
    	{
        	$query = '%'.$query.'%';
        	$parts = Part::where('part_name', 'LIKE', '%'.$query.'%')->get();
            foreach ($parts as $part)
            {
                $user = User::where('id', '=', $part->user_id)->first();

                $usernames[$part->id] = $user->username;
        	}
            return View::make('search_results')
                ->with('parts', $parts)
                ->with('usernames', $usernames);

    	}
    	else
    	{
        	function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) {
            	$theta = $longitude1 - $longitude2;
            	$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
            	$miles = acos($miles);
            	$miles = rad2deg($miles);
            	$miles = $miles * 60 * 1.1515;
            	return $miles; 
        	}
            function getCoordinates($zip)
            {
                $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=false';
                $json = file_get_contents($url);
                $obj = json_decode($json);
                $coordinates['lat'] = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $coordinates['long'] = $obj->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                return $coordinates;
            }

            $distanceAway = Input::get('distanceAway');
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
	}
}
