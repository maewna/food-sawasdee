<?php
$location = $_REQUEST['addr'];
$timeNow = $_REQUEST['timeNow'];
//echo $location;
$latlong    =   get_lat_long($location); // create a function with the name "get_lat_long" given as below
$map        =   explode(',' ,$latlong);
$mapLat         =   $map[0];
$mapLong    =   $map[1];   
//echo $mapLat.','.$mapLong;



// function to get  the address
function get_lat_long($address){

    $address = str_replace(" ", "+", $address);
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$lat = $response_a->results[0]->geometry->location->lat;
	$long = $response_a->results[0]->geometry->location->lng;
    return $lat.','.$long;
}
?>