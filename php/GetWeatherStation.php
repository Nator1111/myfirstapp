<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    $executionStartTime = microtime(true) / 1000;

    $url = 'http://api.geonames.org/weatherJSON?north=' . $_POST['north'] . '&south=' . $_POST['south'] . '&east=' . $_POST['east'] . '&west=' . $_POST['west'] . '&username=nator1111';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);

    $weatherStationJSON = curl_exec($ch);

    curl_close($ch);

    $weatherStationObj = json_decode($weatherStationJSON, true);

    $output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "mission saved";
	$output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
	$output['data'] = $weatherStationObj['weatherObservations'];
	
	header('Content-Type: application/json; charset=UTF-8');

	echo json_encode($output); 
    
?>
