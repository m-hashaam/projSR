
var map;
var longi = 0;
var lati = 0;
var markersArray = [];
var check = 0;

var AllCitiesReach = 0;

var loc2 = [];
var latlong2 = [];
var poly2 = [];
var coords2 = [];
var reach = [];
var senti = [];
var conv = [];
var male = [];
var female = [];
var resid = [];
var age1520 = [];
var age2130 = [];
var age3140 = [];
var age4150 = [];
var age5160 = [];
var age60 = [];
var house = [];
var empl = [];
var busin = [];
var unemp = [];
var stud = [];

var city1 = [];
var latlong1 = [];
var poly1 = [];
var coords1 = [];
var reach1 = [];
var social1 = [];
var senti1 = [];
var resi1 = [];
var house1 = [];
var male1 = [];
var female1 = [];
var age11 = [];
var age12 = [];
var age13 = [];
var age14 = [];
var age15 = [];
var ptrial1 = [];
var lcard1 = [];
var evouch1 = [];
var referral1 = [];
var hw1 = [];
var unemp1 = [];
var emp1 = [];
var busi1 = [];
var stu1 = [];

var totalIndex = -1;
var thescales = chroma.scale(['red', 'green']);
    

var Pieoptions = {
title: '',
colors: ['#134B88', '#900F86'],
animation:{
duration: 500,
easing: 'out',
}
};

var Baroptions = {
legend:'none',
hAxis: {
minValue: 0,
},
bars: 'horizontal',
animation:{
duration: 500,
easing: 'out',
}
};
var piechart;
var material;

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMaterial);
google.charts.setOnLoadCallback(drawChart);


function drawMaterial() {
  $.post( 
		'database/rep_something2.php', 			
    	{ func: "getStartAge" },		 
		function( data ){ 	
			//console.log(data);
            var result  = JSON.parse(data);
			  var data = google.visualization.arrayToDataTable([
                ['', ''],
                ['18-25', parseInt(result[0])],
                ['26-35', parseInt(result[1])],
                ['36-45', parseInt(result[2])],
                ['46-55', parseInt(result[3])],
                ['55 Above', parseInt(result[4])]
              ]);
            
              
              material = new google.charts.Bar(document.getElementById('chart_div'));
              material.draw(data, Baroptions);
	});
}

function drawChart() { 

    $.post( 
		'database/rep_something2.php', 			
    	{ func: "getStartGender" },		 
		function( data ){ 	
			//console.log(data);
            var result  = JSON.parse(data);
			  var data = google.visualization.arrayToDataTable([
                  ['Gender', '%'],
                  ['Male',     parseFloat(result[0])],
                  ['Female',  parseFloat(result[1])]
                ]);
                
                piechart = new google.visualization.PieChart(document.getElementById('piechart'));
                
                piechart.draw(data, Pieoptions);
	});
    
}
      
$( document ).ready(function() {
    initialize();
    
    $('#map-canvas').css("position","fixed");
    
    getCities();
    
});

function getCities(){
    $.post( 
		'database/rep_something2.php', 			
    	{ func: "getcities" },		 
		function( data ){ 	
			console.log(data);
            var result  = JSON.parse(data);
			 for(var i=0 ; i<result[0].length ; i++){
			       city1.push(result[0][i]);
                   latlong1.push(result[1][i]);
                   reach1.push(parseInt(result[2][i]));
                   AllCitiesReach += parseInt(result[2][i]);
                    social1.push(parseInt(result[3][i]));
                    senti1.push(parseInt(result[4][i]));
                    resi1.push(parseInt(result[5][i]));
                    house1.push(parseInt(result[6][i]));
                    male1.push(parseInt(result[7][i]));
                    female1.push(parseInt(result[8][i]));
                    age11.push(parseInt(result[9][i]));
                    age12.push(parseInt(result[10][i]));
                    age13.push(parseInt(result[11][i]));
                    age14.push(parseInt(result[12][i]));
                    age15.push(parseInt(result[13][i]));
                    ptrial1.push(parseInt(result[14][i]));
                    lcard1.push(parseInt(result[15][i]));
                    evouch1.push(parseInt(result[16][i]));
                    referral1.push(parseInt(result[17][i]));
                    hw1.push(parseInt(result[18][i]));
                    unemp1.push(parseInt(result[19][i]));
                    emp1.push(parseInt(result[20][i]));
                    busi1.push(parseInt(result[21][i]));
                    stu1.push(parseInt(result[22][i]));
            }
            drawCitiesOnMap();
	});
}

function getAreaData(cityname){
    $.post( 
		'database/rep_something2.php', 			
    	{ func: "getareas",city:cityname },		 
		function( data ){ 	
			//console.log(data);
            var result  = JSON.parse(data);
			 for(var i=0 ; i<result[0].length ; i++){
			       loc2.push(result[0][i]);
                   latlong2.push(result[1][i]);
            }
            drawAreasOnMap();
	});
}

function drawAreasOnMap(){
    for(var i=0; i<loc2.length; i++){
        var latlongarray = latlong2[i].split(',');
        var coords = [];
        for(var j=0 ; j<latlongarray.length ; j+=2){
            coords.push( {lat: parseFloat(latlongarray[j+1]), lng: parseFloat(latlongarray[j])});
        }
        coords.push( {lat: parseFloat(latlongarray[1]), lng: parseFloat(latlongarray[0])});
        poly1.push(drawOnMap(coords,loc2[i],'#FF0000','area'));
    }
}

function drawCitiesOnMap(){
    for(var i=0; i<city1.length; i++){
        var latlongarray = latlong1[i].split(',');
        var coords = [];
        for(var j=0 ; j<latlongarray.length ; j+=2){
            coords.push( {lat: parseFloat(latlongarray[j+1]), lng: parseFloat(latlongarray[j])});
        }
        coords.push( {lat: parseFloat(latlongarray[1]), lng: parseFloat(latlongarray[0])});
        var thecolors = thescales((parseFloat(reach1[i])/parseFloat(AllCitiesReach))*100).hex();
        poly2.push(drawOnMap(coords,city1[i],thecolors,'city'));
    }
}

function drawOnMap(coords,nname,ccolor,type){
     //console.log("drawing "+nname);
     var poly = new google.maps.Polygon({
          paths: coords,
          strokeColor: ccolor,
          strokeOpacity: 0.8,
          strokeWeight: 2,
          indexID: nname,
          type: type,
          fillColor: ccolor,
          fillOpacity: 0.35
        });
    poly.setMap(map);
    google.maps.event.addListener(poly, 'click', function (event) {
        polygonListenrer(poly);      
    }); 
    return poly;
}

function findTotalIndex(){
    var maxval = 0;
    for(var i=0 ; i<reach.length ; i++){
        if(reach[i] > maxval){
            maxval = reach[i];
            totalIndex = i;
        }
    }
}

function drawThings(indd){
    
    //console.log("start");
    //console.log("total index 1 "+totalIndex);
    if(totalIndex == -1){
        //console.log("total index 2 "+totalIndex);
        findTotalIndex();
    }
    //console.log("total index "+totalIndex);
    if(indd == -1){
        indd = totalIndex;
    }
    //console.log(" index "+indd);
    if($('#sidebar-button').css("right") == "0px"){
        sidebar();
    }
    var rr = (reach[indd])/(reach[totalIndex]);
    rr *= 100;
    //console.log("rr "+rr);
    //$('.sidebarrightloading').addClass("hidemyclass");
    //$('.sidebarrightcontent').removeClass("hidemyclass");
    $('.sidebarheads').html("<h1>"+loc[indd]+"</h1>");
    $('#side_reachcontr').html(rr.toFixed(2)+"%");
    $('#side_residents').html(resid[indd]);
    $('#side_areareach').html(reach[indd]);
    $('#side_conv').html(conv[indd]);
    $('#side_pro1name').html("Students");
    $('#side_pro1val').html(stud[indd]);
    $('#side_pro2name').html("Businessmen");
    $('#side_pro2val').html(busin[indd]);
    $('#side_pro3name').html("Housewives");
    $('#side_pro3val').html(house[indd]);
    
     var data = google.visualization.arrayToDataTable([
      ['Gender', '%'],
      ['Male',     male[indd]],
      ['Female',  female[indd]]
    ]);
    piechart.draw(data, Pieoptions);
    
    var data2 = google.visualization.arrayToDataTable([
        ['Age Range', 'Value'],
        ['15 - 20', age1520[indd]],
        ['21 - 30', age2130[indd]],
        ['31 - 40', age3140[indd]],
        ['41 - 50', age4150[indd]],
        ['51 - 60', age5160[indd]],
        ['Above 60', age60[indd]]
      ]);

  
  material.draw(data2, Baroptions);
    
}


function initialize() {

  var markers = [];
  var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
      center: new google.maps.LatLng(31.136054, 70.831721),
	  zoom:6
       //mapTypeId: google.maps.MapTypeId.SATELLITE
	}
	map = new google.maps.Map(mapCanvas, mapOptions);

  
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
	
	
	
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
	
	
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
  
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
  
  
 
	
}

function removeAllGraphs(){
    for(var i=0 ; i<poly1.length; i++){
        poly1[i].setMap(null);
    }
    for(var i=0 ; i<poly2.length; i++){
        poly2[i].setMap(null);
    }
}

function removeIndvidualCity(cityname){
    poly1[city1.indexOf(cityname)].setMap(null);
}

function polygonListenrer(p){
    if(p.type == "city"){
        //removeAllGraphs();
        //drawCitiesOnMap();
        //removeIndvidualCity(p.indexID);
        
        p.setMap(null);
        getAreaData(p.indexID);
    }
    else{
        
    }
    
    //drawThings(-1);
    //drawThings(loc.indexOf(p.indexID));
}

