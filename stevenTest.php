<!DOCTYPE html>
<html> 
	<head> 
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	  	<title>Restaurantzz:  The z's are accented</title> 
	  	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	  	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
	</head>
	 
	<body>
  		<div id="map" style="width: 100%; height: 800px;"></div>

		<?php  
			$list = array(
				array(
					"name"=>"Outback Steakhouse",
					"hashtag" =>"OutbackSteakhouse",
					"address" =>"15433 Culver Dr Irvine, CA 92604",
					"url" =>"www.outback.com",
					"score" => 4
				),
				array(
					"name"=>"BJs",
					"hashtag" =>"BJs",
					"address" =>"13130 Jamboree Rd Irvine, CA 92602",
					"url" =>"www.bjrestaurants.com",
					"score" => 2
				),
				array(
					"name"=>"Outback Steakhouse",
					"hashtag" =>"OutbackSteakhouse",
					"address" =>"20655 Acadia Ct. Cupertino, CA 95014",
					"url" =>"www.outback.com",
					"score" => 2
				),
				array(
					"name"=>"Little Sheep Mongolian Hotpot",
					"hashtag" =>"LittleSheepMongolianHotpot",
					"address" =>"15361 Culver Dr Irvine, CA 92604",
					"url" =>"www.littlesheephotpot.com",
					"score" => 1
				)
			); 
			
			//make size = 10
			if(sizeOf($list)< 10){
				for($i = sizeOf($list); $i < 10; $i++){
					$list[$i]["name"] = 'no';
					$list[$i]["hashtag"] = 'no';
					$list[$i]["address"] = 'no';
					$list[$i]["url"] = 'no';
					$list[$i]["score"] = 'no';
				}
			}
		?>
		
		
		<script type="text/javascript">
	  		// Define your locations: HTML content for the info window, latitude, longitude
    		var locations = [
      			['<?php echo $list[0]["name"]; ?>', -33.890542, 151.274856, '<?php echo $list[0]["address"]; ?>', '<h2><?php echo $list[0]["url"]; ?></h2>'],
      			['<?php echo $list[1]["name"]; ?>', -33.923036, 151.259052, '<?php echo $list[1]["address"]; ?>', '<h2><?php echo $list[1]["url"]; ?></h2>'],
      			['<?php echo $list[2]["name"]; ?>', -34.028249, 151.157507, '<?php echo $list[2]["address"]; ?>', '<h2><?php echo $list[2]["url"]; ?></h2>'],
      			['<?php echo $list[3]["name"]; ?>', -33.80010128657071, 151.28747820854187, '<?php echo $list[3]["address"]; ?>', '<h2><?php echo $list[3]["url"]; ?></h2>'],
      			['<?php echo $list[4]["name"]; ?>', -33.81010128657071, 151.28747820854187, '<?php echo $list[4]["address"]; ?>', '<h2><?php echo $list[4]["url"]; ?></h2>'],
      			['<?php echo $list[5]["name"]; ?>', -33.82010128657071, 151.28747820854187, '<?php echo $list[5]["address"]; ?>', '<h2><?php echo $list[5]["url"]; ?></h2>'],
      			['<?php echo $list[6]["name"]; ?>', -33.83010128657071, 151.28747820854187, '<?php echo $list[6]["address"]; ?>', '<h2><?php echo $list[6]["url"]; ?></h2>'],
      			['<?php echo $list[7]["name"]; ?>', -33.84010128657071, 151.28747820854187, '<?php echo $list[7]["address"]; ?>', '<h2><?php echo $list[7]["url"]; ?></h2>'],
      			['<?php echo $list[8]["name"]; ?>', -33.85010128657071, 151.28747820854187, '<?php echo $list[8]["address"]; ?>', '<h2><?php echo $list[8]["url"]; ?></h2>'],
      			['<?php echo $list[9]["name"]; ?>', -33.86010128657071, 151.28747820854187, '<?php echo $list[9]["address"]; ?>', '<h2><?php echo $list[9]["url"]; ?></h2>']
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
					    var latitude = results[0].geometry.location.lat();
					    var longitude = results[0].geometry.location.lng();
					    console.log(latitude);
					    console.log(longitude);
					    marker = new google.maps.Marker({
			        		position: new google.maps.LatLng(latitude, longitude),		//locations[i][1], locations[i][2]
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
</body>
</html>