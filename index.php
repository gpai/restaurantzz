<html></html>
<?php
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	require_once('class_loc.php');
	
	$object = array();
	$mainArray = array();
	$pos = 0;
	$found = FALSE;
	
	//if there is a longitude or latitude already existing (ie user has inputted a location)...
	if(isset($_GET['lat']) && isset($_GET['long'])){
		$pos = 0;
		$found = FALSE;
		//set local variables with get variables
		$lat = floatval($_GET['lat']);
		$long = floatval($_GET['long']);
		$city = $_GET['location'];
		
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
		
		if(sizeOf($yelp)< 10){
				for($i = sizeOf($yelp); $i < 10; $i++){
					$yelp[$i]["name"] = 'no';
					$yelp[$i]["hashtag"] = 'no';
					$yelp[$i]["address"] = 'no';
					$yelp[$i]["url"] = 'no';
					$yelp[$i]["score"] = 'no';
				}
			}
		
		$location = array();
		foreach($yelp as $yell){
			$location[count($location)] = $yell['address'];
		}
		//print for debugging us only
		//foreach($list as $liss){
			//echo $liss["name"].'</br>';
			//echo $liss["hashtag"].'</br>';
			//echo $liss["address"].'</br>';
			//echo $liss["url"].'</br>';
			//echo $liss["score"].'</br>'.'</br>';
		//}
		
?>

<?php	
	}
	include 'index.phtml';
?>