
var map;
var longi = 0;
var lati = 0;
var markersArray = [];
var check = 0;


//Time between marker refreshes
var INTERVAL = 5000;

function getMarkers() {
    var id = getUrlParameter("driverid");
	$.post( 
		'database/drivers.php', 			
		{ func: "getDriverLocation" ,id:id},		 
		function( data ){ 	
			//alert(data);
			 var result = JSON.parse(data);
			 if(result[0] == "none" || result[1]=="none"){
				 if(check == 0){
					alert("Location not available for driver");
					check = 1;
				 }
			 }
			 else{
				 var latLng = new google.maps.LatLng( result[0], result[1]);
					placeMarker(latLng);
					//map.setZoom(15);
					map.panTo(latLng);
			 }
	});
}


$(document).ready(function(){
	setInterval(getMarkers, 3000);
});

function initialize() {

  var markers = [];
  var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
	  center: new google.maps.LatLng(6.5486584,3.3596864),
	  zoom: 11,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(mapCanvas, mapOptions);

  // var defaultBounds = new google.maps.LatLngBounds(
      // new google.maps.LatLng(-33.8902, 151.1759),
      // new google.maps.LatLng(-33.8474, 151.2631));
  // map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
	
	
	
	// google.maps.event.addListener(map, "click", function (e) {
		
		// //alert("lat is "+latLng.lat()+"  and long is "+latLng.lng());
	// });
	
	
	

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

function placeMarker(location) {
	// first remove all markers if there are any
	deleteOverlays();

	var marker = new google.maps.Marker({
		position: location, 
		map: map
	});

	// add marker in markers array
	markersArray.push(marker);

	//map.setCenter(location);
}

function deleteOverlays() {
	for (var i = 0 ; i<markersArray.length ; i++) {
		markersArray[i].setMap(null);
		//markersArray[i].setVisible(false);
	}
	markersArray.length = 0;
}

google.maps.event.addDomListener(window, 'load', initialize);
  

function getUrlParameter(sParam)
{
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++)
		{
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam)
			{
				return sParameterName[1];
			}
		}
}