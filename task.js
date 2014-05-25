var maps, marker, placeLoc, directionsDisplay;
var directionsService = new google.maps.DirectionsService();

function initializeMap(){
	directionsDisplay = new google.maps.DirectionsRenderer();
	var latlng=new google.maps.LatLng(33.6839473,-117.79469419999998);
	var myOptions = {
		zoom:10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById('map'), myOptions);
	directionsDisplay.setMap(map);	
}
function go(){
	initializeMap();
}

$(document).ready(
	go 
);
