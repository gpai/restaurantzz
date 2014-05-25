<?php

	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	
	class location{
		
		private $city;
		private $lat;
		private $long;
		
		private $yelp;
		private $twit;
		
		public function __construct($c, $la, $lo){
			$city = $c;
			$lat = $la;
			$long = $lo;
		}
		
		public function getYelp($lat, $long){
			$list = yelp($lat,$long); //this get the closest 40 restuarnts with the given lat & long
			
			$liststr = $list[0]["name"].$list[0]["hashtag"].$list[0]["address"].$list[0]["url"].$list[0]["score"];
			
			
						
					
					
					"name" => $name, 
					"hashtag" => convertToHash($name), 
					"address" => $address.' '.$city." ".$state.", ".$postal,
					"url" => $url, 
					"score" => 0			
		}
		
		public function getTwit($list, $lat, $long){
			$list = twitter($list, $lat, $long); //this ranks the 40 restuarnts with the yelp list
		}
		
	}

?>

