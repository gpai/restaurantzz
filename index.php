<?php
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	
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
		for($i = 0; $i < 20; $i++)
		{
			for($j = 0; $j < 19 - $i; $j++)
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
		/*foreach($list as $liss){
			echo $liss["name"].'</br>';
			echo $liss["hashtag"].'</br>';
			echo $liss["address"].'</br>';
			echo $liss["url"].'</br>';
			echo $liss["score"].'</br>'.'</br>';
		}*/
	}
	include 'index.phtml';
?>