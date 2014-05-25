<?php
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	
	// if ($_POST['latitude'] != null) {
		// $lat= $_POST['latitude'];
		// header("Location: http://localhost:8888/multiple_results.php?lat=".$lat."&long=".$lat);
	// }
// 	
	//if Post has data inside it...
	// if (isset($_POST)) {
		
// 		
		//check to make sure that the latitude is not null
		// if($_POST['latitude'] == null){
			// $errorArray[]='latitude missing';
		// }else{
			// $lat= $_POST['latitude']; 
		// }
// 		
		// //check to make sure that the longitude is not null
		// if($_POST['longitude'] == null){
			// $errorArray[]='longitude missing';
		// }else{
			// $long= $_POST['longitude'];
		// } 
		// if(count($errorArray)==0){
			// header("Location: multiple_results.php?lat=".$lat."&long=".$long);
			// die();	
		// }
	// //if Post is empty...	
	// }
	
	
	//if there is a longitude or latitude already existing (ie user has inputted a location)...
	if(isset($_GET['lat']) && isset($_GET['long'])){
		//set local variables with get variables
		$lat = floatval($_GET['lat']);
		$long = floatval($_GET['long']);
		
		//echo $lat." this is the lat <br>";
		//echo $long." this is the long";
		
		$list = yelp($lat,$long); //this get the closest 40 restuarnts with the given lat & long
		$list = twitter($list, $lat, $long); //this ranks the 40 restuarnts with the yelp list
		
		//this sorts the list by rank
		for($i = 0; $i < 40; $i++)
		{
			for($j = 0; $j < 39 - $i; $j++)
			{
				if( $list[$j]["score"] < $list[$j+1]["score"]  )
				{
					$swap = $list[$j];
					$list[$j] = $list[$j+1];
					$list[$j+1] = $swap;
				}
			}
		}
		//print for debugging us only
		foreach($list as $liss){
			echo $liss["name"].'</br>';
			echo $liss["hashtag"].'</br>';
			echo $liss["address"].'</br>';
			echo $liss["url"].'</br>';
			echo $liss["score"].'</br>'.'</br>';
		}	
	}
	include 'multiple_results.phtml';
?>