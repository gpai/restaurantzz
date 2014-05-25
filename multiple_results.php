<?php
	if (isset($_POST)) {
		if ($_POST['location'] == null) 
			$errorArray[] = "Please enter a location.";
		else 
			$form_location = $_POST['location'];
		
		if (count($errorArray) == 0){
			header("Location: http://localhost/restaurantzz/index.php");
			die();
		}
		
	}
	include 'multiple_results.phtml';
?>