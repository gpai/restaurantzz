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
		//private $twit;
		
		public function __construct($city, $lat, $long){
			$this->city = $city;
			$this->lat = $lat;
			$this->long = $long;
		}
		
		public function fillYelpTwit(){
			//make yelp list	
			$list = yelp($this->lat, $this->long);
			
			//use yelp list to make twit list 
			$listTwit = twitter($list, $this->lat, $this->long);
			
			//store list as one string						
			for($i = 0; $i < sizeOf($list); $i++){
				$this->yelp[$i] = $list[$i]["name"]."*".$list[$i]["hashtag"]."*".$list[$i]["address"]."*".$list[$i]["url"]."*".$listTwit[$i]["score"];
			}
			
			//necessary?  Yelp contains twit info
			/*for($i = 0; $i < sizeOf($listTwit); $i++){
				$this->twit[$i] = $listTwit[$i]["score"];
			}*/
		}
		
		//not needed?
		public function searchCity($city){
			if ($this->city == $city){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		
		public function getCity(){
			return $this->city;
		}
		
		public function getLat(){
			return $this->lat;
		}
		
		public function getLong(){
			return $this->long;
		}
		
		public function getString(){
			for($i = 0; $i < sizeOf($this->yelp); $i++){	
				$temp = explode("*", $this->yelp[$i]);		
				$retArray[$i] = array(
					"name" => $temp[0], 
					"hashtag" => $temp[1], 
					"address" => $temp[2],
					"url" => $temp[3], 
					"score" => $temp[4]
				);
			}
			return $retArray;
		}
		
		//necessary???
		/*public function getTwit(){
			return $this->twit;
		}*/
	}

?>

