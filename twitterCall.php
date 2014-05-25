<?php
	//hashtag of the form 'hashtag', 	geo of the form 'xxx.123456, -yyy.123456, xmi'
	require_once('TwitterAPIExchange.php');		//loads the php file
	
	function twitter($list, $lat, $long){
		//echo "require_once twitterAPIExchange file";
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		    'oauth_access_token' => "2519596680-4vvXa4rCbi4cys7i5vI2okwvtHk3Mt5zyJiQgMN",
		    'oauth_accessg_token_secret' => "b5mRy5M5jNpWHksPdUvhkXQn71CPDiV3gzvri7cZOScYC",
		    'consumer_key' => "RUPB7fzrB98W5ve7rNOmJykCM",
		    'consumer_secret' => "vENTh3lb3SEDPCGroCQVuWy5iEJmzizmvxW8N3KMcniJ6ysopO"
		);
		//var_dump($settings);
		/** Note: Set the GET field BEFORE calling buildOauth(); **/		/**create th search url**/
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$requestMethod = 'GET';
		for($i = 0; $i < sizeOf($list); $i++){
			$getfield = '?q=%23'.$list[$i]["hashtag"].'&geocode='.$lat.','.$long.',60mi&result_type=recent&include_entities=true&count=100';
			
			// Perform the request
			$twitter = new TwitterAPIExchange($settings);
			
			$json_output = $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
					
			// count the results
			$json = json_decode($json_output);
			$n = count($json->statuses);
			//update score array
			$list[$i]["score"] = $n;
		}
		return $list;
	}
?>
