<?php

# Search Helper Function

function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) 
{
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