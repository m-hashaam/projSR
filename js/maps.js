
var map;
var longi = 0;
var lati = 0;
var markersArray = [];
var check = 0;

$( document ).ready(function() {
    initialize();

	
	
  
});







function initialize() {

  var markers = [];
  var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
	  //center: new google.maps.LatLng(32.981020,73.784180),
      center: new google.maps.LatLng(24.932454, 67.023458),
	  zoom:11
       //mapTypeId: google.maps.MapTypeId.SATELLITE
	
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
	
	
    //for (var i = 0, marker; marker = markers[i]; i++) {
    //  marker.setMap(map);
    //}

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
  
  
  
 getPersonas();
  
  
  
  

	
}

function getPersonas(){
	var icon;
    $.post( 
		'database/maps.php', 			
		{ func: "get" },		 
		function( data ){ 	
		  var result = JSON.parse(data);
			 
             	var legend = document.createElement('div');
            	legend.id = 'legend';
            
            	var htmll = "<div style=\"background:white; border-radius:5px; margin-right:10px;     padding-top: 5px;padding-bottom: 5px;\">";
            	
            
            
             
             var test = [];
             var jj = 0;
             for(var i=0 ; i<result[0].length ; i++){
				
                if(test.indexOf(result[1][i])<= -1){
                    test[jj] = result[1][i];
                    jj=jj+1;
                    htmll+="<p style=\"margin: 7px 7px 7px 7px;\"><img src=\""+result[5][i]+"\" class=\"invertcolor\"style=\"max-width:35px; max-height:35px; width:auto; height:auto;   margin-right: auto;     margin-left: auto; padding-right: 10px;\"/>"+result[1][i]+"</p>";
                }
                
                console.log(result[6][i]);
                icon = new google.maps.MarkerImage(
                    result[6][i],
                    null, /* size is determined at runtime */
                    null, /* origin is 0,0 */
                    null, /* anchor is bottom center of the scaled image */
                    new google.maps.Size(35, 30)
                );  
                
                var gg = randomGeo(result[3][i],result[4][i]);
                console.log("randomGeo("+result[3][i]+","+result[4][i]+")")
                
                console.log(result[3][i]+":"+result[4][i]+" OR "+gg.latitude+":"+gg.longitude);
                
                marker = new google.maps.Marker({
					map:map,
					 animation: google.maps.Animation.DROP,
					 title:result[1][i]+" | "+result[2][i]+"\nReach: "+result[0][i],
					position: new google.maps.LatLng(gg.latitude,gg.longitude),
                    content: "",
                    icon: icon
				  });
                  
                  
                
               
			}
            htmll+="</div>";
            legend.innerHTML = htmll;
            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
		});
}

function randomGeo(center, radius) {
    var y0 = parseFloat(center);
    var x0 = parseFloat(radius);
    var rd = 10000 / 111300; //about 111300 meters in one degree

    var u = Math.random();
    var v = Math.random();

    var w = rd * Math.sqrt(u);
    var t = 2 * Math.PI * v;
    var x = w * Math.cos(t);
    var y = w * Math.sin(t);

    //Adjust the x-coordinate for the shrinking of the east-west distances
    var xp = x / Math.cos(y0);

    var newlat = y + y0;
    var newlon = x + x0;
    var newlon2 = xp + x0;

    return {
        'latitude': parseFloat(newlat).toFixed(5),
        'longitude': parseFloat(newlon).toFixed(5),
        'longitude2': parseFloat(newlon2).toFixed(5),
      
    };
}



