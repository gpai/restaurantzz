<html></html>
<?php
	require_once('TwitterAPIExchange.php');		//loads the php file
	require_once('OAuth.php');
	require_once('yelpTest.php');
	require_once('twitterCall.php');
	
	//if there is a longitude or latitude already existing (ie user has inputted a location)...
	if(isset($_GET['lat']) && isset($_GET['long'])){
		//set local variables with get variables
		$lat = floatval($_GET['lat']);
		$long = floatval($_GET['long']);
		
		//echo $lat." this is the lat <br>";
		//echo $long." this is the long";
		
		$list = yelp($lat,$long); //this get the closest 40 restuarnts with the given lat & long
		$list = twitter($list, $lat, $long); //this ranks the 40 restuarnts with the yelp list
		
		//this sorts the list by rank
		for($i = 0; $i < 20; $i++)
		{
			for($j = 0; $j < 19 - $i; $j++)
			{
				if( $list[$j]["score"] < $list[$j+1]["score"]  )
				{
					$swap = $list[$j];
					$list[$j] = $list[$j+1];
					$list[$j+1] = $swap;
				}
			}
		}
		
		if(sizeOf($list)< 10){
				for($i = sizeOf($list); $i < 10; $i++){
					$list[$i]["name"] = 'no';
					$list[$i]["hashtag"] = 'no';
					$list[$i]["address"] = 'no';
					$list[$i]["url"] = 'no';
					$list[$i]["score"] = 'no';
				}
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
<script type="text/javascript">
		// Define your locations: HTML content for the info window, latitude, longitude
		var locations = [
			["<?php echo $list[0]["name"]; ?>", "<?php echo $list[0]["latitude"]; ?>", "<?php echo $list[0]["longitude"]; ?>", "<?php echo $list[0]["address"]; ?>", "<?php echo $list[0]["url"]; ?>"],
			["<?php echo $list[1]["name"]; ?>", "<?php echo $list[1]["latitude"]; ?>", "<?php echo $list[1]["longitude"]; ?>", "<?php echo $list[1]["address"]; ?>", "<?php echo $list[1]["url"]; ?>"],
			["<?php echo $list[2]["name"]; ?>", "<?php echo $list[2]["latitude"]; ?>", "<?php echo $list[2]["longitude"]; ?>", "<?php echo $list[2]["address"]; ?>", "<?php echo $list[2]["url"]; ?>"],
			["<?php echo $list[3]["name"]; ?>", "<?php echo $list[3]["latitude"]; ?>", "<?php echo $list[3]["longitude"]; ?>", "<?php echo $list[3]["address"]; ?>", "<?php echo $list[3]["url"]; ?>"],
			["<?php echo $list[4]["name"]; ?>", "<?php echo $list[4]["latitude"]; ?>", "<?php echo $list[4]["longitude"]; ?>", "<?php echo $list[4]["address"]; ?>", "<?php echo $list[4]["url"]; ?>"],
			["<?php echo $list[5]["name"]; ?>", "<?php echo $list[5]["latitude"]; ?>", "<?php echo $list[5]["longitude"]; ?>", "<?php echo $list[5]["address"]; ?>", "<?php echo $list[5]["url"]; ?>"],
			["<?php echo $list[6]["name"]; ?>", "<?php echo $list[6]["latitude"]; ?>", "<?php echo $list[6]["longitude"]; ?>", "<?php echo $list[6]["address"]; ?>", "<?php echo $list[6]["url"]; ?>"],
			["<?php echo $list[7]["name"]; ?>", "<?php echo $list[7]["latitude"]; ?>", "<?php echo $list[7]["longitude"]; ?>", "<?php echo $list[7]["address"]; ?>", "<?php echo $list[7]["url"]; ?>"],
			["<?php echo $list[8]["name"]; ?>", "<?php echo $list[8]["latitude"]; ?>", "<?php echo $list[8]["longitude"]; ?>", "<?php echo $list[8]["address"]; ?>", "<?php echo $list[8]["url"]; ?>"],
			["<?php echo $list[9]["name"]; ?>", "<?php echo $list[9]["latitude"]; ?>", "<?php echo $list[9]["longitude"]; ?>", "<?php echo $list[9]["address"]; ?>", "<?php echo $list[9]["url"]; ?>"]
		];
	 
		
	
	    // Setup the different icons and shadows
	    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
		var icons = [
		      iconURLPrefix + 'red-dot.png',
		    ]
		var icons_length = icons.length;
		
	    var shadow = {
	      anchor: new google.maps.Point(15,33),
	      url: iconURLPrefix + 'msmarker.shadow.png'
	    };
	
	    var map = new google.maps.Map(document.getElementById('map'), {
	      zoom: 12,
	      center: new google.maps.LatLng(33.68, -117.79),
	      mapTypeId: google.maps.MapTypeId.ROADMAP,
	      mapTypeControl: false,
	      streetViewControl: false,
	      panControl: false,
	    });
	
	    var infowindow = new google.maps.InfoWindow({
	      maxWidth: 400
	    });
	
	    var marker;
	    var markers = new Array();
	    
	    var iconCounter = 0;
	    
	    // Add the markers and infowindows to the map
	    for (var i = 0; i < locations.length; i++) {
		  if (locations[i][0] != "no"){  
		  	var geocoder = new google.maps.Geocoder();
		  	var address = locations[i][3];
		  	geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
				    locations[i][1] = results[0].geometry.location.lat();
				    locations[i][2] = results[0].geometry.location.lng();
				   
				    marker = new google.maps.Marker({
		        		position: new google.maps.LatLng(locations[i][1], locations[i][2]),		//locations[i][1], locations[i][2]
		        		map: map,
		        		icon : icons[iconCounter],
		        		shadow: shadow
		     		 });
	     			markers.push(marker);
	     			
	     			google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        			return function() {
	         				 infowindow.setContent(locations[i][0]);
	         				 infowindow.open(map, marker);
	        			}
	      			})(marker, i));
	      
	     			iconCounter++;
		     		 // We only have a limited number of possible icon colors, so we may have to restart the counter
					if(iconCounter >= icons_length){
		      			iconCounter = 0;
		     		 }
		    	 } 
			}); 
	     }
	    }
		//end for each 
	    function AutoCenter() {
	      //  Create a new viewpoint bound
	      var bounds = new google.maps.LatLngBounds();
	      //  Go through each...
	      $.each(markers, function (index, marker) {
	        bounds.extend(marker.position);
	      });
	      //  Fit these bounds to the map
	      map.fitBounds(bounds);
	    }
	    AutoCenter();
	</script> 
<?php	
	}
	include 'index.phtml';
?>