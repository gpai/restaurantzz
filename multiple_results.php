<?php
	if (isset($_POST)) {
		if ($_POST['location'] == null) 
			$errorArray[] = "Please enter a location.";
		else {
			$form_location = $_POST['location'];
			//$base='https://maps.googleapis.com/maps/api/geocode/json?address=';
			//$location = explode(' ',$form_location);
			//$query =implode("+",$location);
			//$option='sensor=false';
			
		}
		if (count($errorArray) == 0){
			header("Location: http://localhost/restaurantzz/multiple_results.php");
			die();
		}
		
	}
	include 'multiple_results.phtml';
?>