<?php
	
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	require_once('test.php');
	
	$irvObj = new Location();
	
	$list = yelp(33.8741025, -117.7364668);
	//$list = twitter($list, 33.8741025, -117.7364668);
	
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
	for ($i = 0; $i < 40; $i++){
		echo $list[$i]["name"].'</br>';
		echo $list[$i]["hashtag"].'</br>';
		echo $list[$i]["address"].'</br>';
		echo $list[$i]["url"].'</br>';
		echo $list[$i]["score"].'</br>'.'</br>';
	}	
?>