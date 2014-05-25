<?php
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	
	if (isset($_POST)) {
		if ($_POST['location'] == null) 
			$errorArray[] = "Please enter a location.";
		elseif($_POST['latitude'] == null){
			$errorArray[]= "lat missing";
		}else{
			$lat = $_POST['latitude'];
			$long = $_POST['longitude'];	
			//$errorArray[] = $lat;
			//$errorArray[] = $long;
			//header("Location: index.php?lat=".$lat."&long=".$long);	
			//die();
		}
		
	}
	include 'multiple_results.phtml';
?>