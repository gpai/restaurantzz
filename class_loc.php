<?php

	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	
	class Location{
		
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
		
		public function fillYelp($lat, $long){
			$list = yelp($lat,$long); //this get the closest 40 restuarnts with the given lat & long
			
			for($i = 0; $i < sizeOf($list); $i++){
				$yelp[$i] = $list[$i]["name"].$list[$i]["hashtag"].$list[$i]["address"].$list[$i]["url"].$list[$i]["score"];
			}
		}
		
		public function fillTwit($list, $lat, $long){
			$list = twitter($list, $lat, $long); //this ranks the 40 restuarnts with the yelp list
			
			for($i = 0; $i < sizeOf($list); $i++){
				$twit[$i] = $list[$i]["score"];
			}
		}
		
		public function getCity(){
			return $city;
		}
		
		public function getLat(){
			return $lat;
		}
		
		public function getLong(){
			return $long;
		}
		
		public function getYelp(){
			return $yelp;
		}
		
		public function getTwit(){
			return $twit;
		}
	}

?>

