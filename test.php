<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>

	<?php
		
		require_once('TwitterAPIExchange.php');		//loads the php file
		require_once('OAuth.php');
		require_once('yelpTest.php');
		require_once('twitterCall.php');
		
		$list = yelp(33.8741025, -117.7364668);
		$list = twitter($list, 33.8741025, -117.7364668);
		
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
		
		
		
		for ($i = 0; $i < 40; $i++){
			echo $list[$i]["name"].'</br>';
			echo $list[$i]["hashtag"].'</br>';
			echo $list[$i]["address"].'</br>';
			echo $list[$i]["url"].'</br>';
			echo $list[$i]["score"].'</br>'.'</br>';
		}
		
		//determine highest tweets
		/*$highest = '0';
		for ($i = 0; $i < 40; $i++){
			if ($list[$i]["score"] > $highest){
				$highest = $list[$i]["score"]; 	
			}
		}
		echo $highest;*/
		
		/*$temp = array();
		$tempcounter = 0;
		while ($highest < 0){
			for ($i = 0; $i < 40; $i++){
				if ($list[$i]["score"] == $highest){
					$temp[$tempcounter] = $list[$i];
					$tempcounter = $tempcounter + 1;
				}
				$highest = $higest - 1;
			}
		}
		
		for ($i = 0; $i < 40; $i++){
			echo $temp[$i]["name"].'</br>';
			echo $temp[$i]["hashtag"].'</br>';
			echo $temp[$i]["address"].'</br>';
			echo $temp[$i]["url"].'</br>';
			echo $temp[$i]["score"].'</br>'.'</br>';
		}*/
		
		
		
		
		
	?>
	</body>
</html>