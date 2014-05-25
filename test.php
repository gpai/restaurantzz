<?php
	
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	require_once('class_loc.php');
	
	
	//variables
	$mainArray = array();
	$pos = 0;
	$found = FALSE;
	
	//user enters city
	$city = ???;
	
	//check if city is in our array
if(isset($_GET['lat']) && isset($_GET['long'])){	
	for ($i = 0; $i < sizeOf($mainArray); $i++){
		if($city == $mainArray[$i][0]){
			$found = TRUE;
			$pos = $i;
			break;	
		}
	}	

	if($found == FALSE){
		//get coordinates
		$lat = floatval($_GET['lat']);
		$long = floatval($_GET['long']);
		
		//add city to main array. 
		$mainArray[sizeOf($mainArray)][0] = $city;
		
		//make and process object.   Increases the size so rest is -1
		$object[sizeOf($object)] = new Location($city, $lat, $long);
		$object[sizeOf($object)-1]->fillYelpTwit();
		
		//add object to main array
		$mainArray[sizeOf($mainArray)-1][1] = $object[sizeOf($object)-1];
		
		//return values
		$city = $object[sizeOf($object)-1]->getCity();
		$lat = $object[sizeOf($object)-1]->getLat();
		$long = $object[sizeOf($object)-1]->getLong();
		$yelp = $object[sizeOf($object)-1]->getString();
	}
	
	else{
		$city = $object[$pos]->getCity();
		$lat = $object[$pos]->getLat();
		$long = $object[$pos]->getLong();
		$yelp = $object[$pos]->getString();		
	}
	
	for($i = 0; $i < 20; $i++)
		{
			for($j = 0; $j < 19 - $i; $j++)
			{
				if( $yelp[$j]["score"] < $yelp[$j+1]["score"]  )
				{
					$swap = $yelp[$j];
					$yelp[$j] = $yelp[$j+1];
					$yelp[$j+1] = $swap;
				}
			}
		}
}
	//example code
/*	$irvObj = new Location('Irvine', 33.8741025, -117.7364668);
	
	$irvObj->fillYelpTwit();
	var_dump($irvObj);
	
	echo $irvObj->searchCity('Irvine');
	
	$list = $irvObj->getString();
	
	echo $list[2]["name"];
	
	echo $list[16]["score"];*/ 
	

/////////////////////////ignore///////////////////////////////
	//$list = yelp(33.8741025, -117.7364668);	
	//$list = twitter($list, 33.8741025, -117.7364668);
	
	/*for($i = 0; $i < 20; $i++)
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
	}*/
	
	//print for debugging us only
	/*for ($i = 0; $i < 40; $i++){
		echo $list[$i]["name"].'</br>';
		echo $list[$i]["hashtag"].'</br>';
		echo $list[$i]["address"].'</br>';
		echo $list[$i]["url"].'</br>';
		echo $list[$i]["score"].'</br>'.'</br>';
	}*/	
?>