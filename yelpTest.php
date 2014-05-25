<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>

	<?php		
		// Enter the path that the oauth library is in relation to the php file
		require_once ('OAuth.php');
		
		//get list of restaurants, offset gets next page results
		function getRest($lat, $long, $offset, $list){
			// Create search URL		&location=sf to search for cities
			$unsigned_url = "http://api.yelp.com/v2/search?term=restaurants&ll=".$lat.",".$long."&sort=1&offset=".$offset."&limit=20";
		
			// Set your keys here
			$consumer_key = "-70bjnshjp6RQN9qfa2XUA";
			$consumer_secret = "0SrpFUKEW4HfKgHc9dJf7wnnNt0";
			$token = "KMzsSQ6XlaKxhYHHMOgfjgoiAbZju6pb";
			$token_secret = "x76OHiyfEeuLVBJhTlKT9_t1Mv8";
			
			// Token object built using the OAuth library
			$token = new OAuthToken($token, $token_secret);
			
			// Consumer object built using the OAuth library
			$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
			
			// Yelp uses HMAC SHA1 encoding
			$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
			
			// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
			$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);
			
			// Sign the request
			$oauthrequest->sign_request($signature_method, $consumer, $token);
			
			// Get the signed URL
			$signed_url = $oauthrequest->to_url();
			
			// Send Yelp API Call
			$ch = curl_init($signed_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch); // Yelp response
			curl_close($ch);
			
			// Handle Yelp response data
			$response = json_decode($data, TRUE);
			
			//for debugging
			//var_dump($response);
			
			//populate the array, there are $entries restaurants
			$entries = sizeOf($response['businesses']);
			$counter = 0;
			foreach($response['businesses'] as $poop){
				$name = $response['businesses'][$counter]['name'];
				$url = $response['businesses'][$counter]['url'];
				$loc = $response['businesses'][$counter]['location'];
				$city = $loc['city'];
				$postal = $loc['postal_code'];
				$address = $loc['address']['0'];
				$state = $loc['state_code'];
				
				//print code for debugging
				/*echo $name.'   ,   '.convertToHash($name).'</br>';
				echo $address.'</br>';
				echo $city.' '.$state.', '.$postal.'</br>';
				echo $url.'</br>'.'</br>';*/
				
				//array entry code.	0name, 1hash, 2address, 3city, 4state, 5postal, 6url, 7score
				$list[$counter+$offset] = array(
					"name" => $name, 
					"hashtag" => convertToHash($name), 
					"address" => $address.' '.$city." ".$state.", ".$postal,
					"url" => $url, 
					"score" => 0
				);
				
				$counter = $counter + 1;
			}
			return $list;
		}
		
		function convertToHash($string){
			$temp = str_replace(' ', '', $string);
			return $temp;
		} 
		
		function yelp($lat, $long){
			//init and populate list with first 3 pages
			$list = array();
			$list = getRest($lat, $long, 0, $list);
			$list = getRest($lat, $long, 20, $list);
			
			//debuggin code
			/*for ($i = 0; $i < 40; $i++){
				echo $list[$i]["name"].'</br>';
				echo $list[$i]["hashtag"].'</br>';
				echo $list[$i]["address"].'</br>';
				echo $list[$i]["url"].'</br>';
				echo $list[$i]["score"].'</br>';
			}*/
			
			return $list;
		}
		
		//yelp(33.506, -117.056);
		
		//print it
		//print_r($response);
	
	?>
	</body>
</html>