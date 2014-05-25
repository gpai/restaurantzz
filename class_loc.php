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
		
		public function __construct($city, $lat, $long){
			$this->city = $city;
			$this->lat = $lat;
			$this->long = $long;
		}
		
		public function fillYelpTwit(){
			$list = yelp($this->lat, $this->long); //this get the closest 40 restuarnts with the given lat & long
			$listTwit = twitter($list, $this->lat, $this->long);
						
			for($i = 0; $i < sizeOf($list); $i++){
				$this->yelp[$i] = $list[$i]["name"]."*".$list[$i]["hashtag"]."*".$list[$i]["address"]."*".$list[$i]["url"]."*".$list[$i]["score"];
			}
			for($i = 0; $i < sizeOf($listTwit); $i++){
				$this->twit[$i] = $listTwit[$i]["score"];
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

