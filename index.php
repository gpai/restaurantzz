<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='css/teststyle.css'/>
		<title>Restaurantzz homie.</title>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	    <script>
	      function initialize() {
	        var map_canvas = document.getElementById('map_canvas');
	        var map_options = {
	          center: new google.maps.LatLng(-34.397, 150.644),
	          zoom: 8,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        }
	        var map = new google.maps.Map(map_canvas, map_options)
	      }
	      google.maps.event.addDomListener(window, 'load', initialize);
	    </script>
	</head>
	<body>
        <header id="title">
        	Restaurantzz
        </header>
        
        <div id="map_canvas"></div>
        
	</body>
</html>