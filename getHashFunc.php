<<<<<<< HEAD
<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>

	<?php
		//hashtag of the form 'hashtag', 	geo of the form 'xxx.123456, -yyy.123456, xmi'
		function getHash($hashtag, $geo){
			require_once('TwitterAPIExchange.php');		//loads the php file
			
			/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
			$settings = array(
			    'oauth_access_token' => "2519596680-4vvXa4rCbi4cys7i5vI2okwvtHk3Mt5zyJiQgMN",
			    'oauth_access_token_secret' => "b5mRy5M5jNpWHksPdUvhkXQn71CPDiV3gzvri7cZOScYC",
			    'consumer_key' => "RUPB7fzrB98W5ve7rNOmJykCM",
			    'consumer_secret' => "vENTh3lb3SEDPCGroCQVuWy5iEJmzizmvxW8N3KMcniJ6ysopO"
			);
			
			/** Note: Set the GET field BEFORE calling buildOauth(); **/		/**create th search url**/
			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$requestMethod = 'GET';
			$getfield = '?q=%23'.$hashtag.'&geocode='.$geo.'&result_type=recent&include_entities=true&count=100';
			
			// Perform the request
			$twitter = new TwitterAPIExchange($settings);
			$json_output = $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			
			
			// count the results
			$json = json_decode($json_output);
			$n = count($json->statuses);
			return $n;
		}

		$n = getHash('hackuci', '33.683947,-117.794694,20mi');
		echo $n;
		
		//associate $n with the hashtag.
		
	?>
	</body>
</html>
=======
<?php
	require_once('twitterCall.php');
	
	//associate $n with the hashtag.
	$n = getHash('hackuci', '33.683947,-117.794694,20mi');

	
	include "getHashFunc.phtml";
?>
>>>>>>> d2afa414348fadd4414753e74fb52b50c53fad33
