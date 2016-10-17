$(document).ready(function(){
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
     $('.container-fluid').first().css("box-shadow","5px 5px 15px #888888");
    $('.container-fluid').first().css("padding-bottom","5px");
    $('.container-fluid').first().css("z-index","9999");
    $('.page-footer').first().css("position","fixed");
    $('.page-footer').first().css("bottom","0");
    $('.page-footer').first().css("left","0");
    $('.page-footer').first().css("width","100%");
    $('.dropdown.dropdown-user.open').first().css("z-index","99990");
    
    	var table2_Props = 	{
							paging: true,  
							paging_length: 6,  
							rows_counter: true,  
							rows_counter_text: "",  
							btn_reset: true,  
							loader: true,  
							loader_text: "Filtering ...",
						
						
							display_all_text: "  Show All  ",
							sort_select: true 
						};
	setFilterGrid( "firstTable",table2_Props );
    setFilterGrid( "thiTable",table2_Props );
    
     $( "#dateSelector" ).change(function() {
        var vall = $( "#dateSelector" ).val();
        if(vall == "custom"){
            $('#CustomDateDiv').css('display','flex');
        }
        else{
            $('#CustomDateDiv').css('display','none');
        }
    });
     
});

function filter(){
    var inidate = $('#iniDate').val();
    var findate = $('#finDate').val();
    location.href="rep_facebook.php?inidate="+inidate+"&findate="+findate;
}

function addFB(){
    toastr["success"]("Adding page, Please wait ...");
    var purl = $('#purl').val();
    purl = purl+"/";
	$.post( 
		'database/reports.php', 			
		{ func: "add" , purl:purl},		 
		function( data ){ 	
		      console.log(data);
			toastr["success"]("Page added.");
            toastr["success"]("Please wait 10 to 15 minutes to view page statistics.");
            //setTimeout(function(){ location.href='rep_overview.php'; }, 5000);
		});
    
}

 google.charts.load('current', {'packages':['geomap','corechart','line','bar']});
 google.charts.setOnLoadCallback(drawMap);
 google.charts.setOnLoadCallback(drawChart);
  google.setOnLoadCallback(drawChart4);
  google.setOnLoadCallback(drawposttypechart);
  google.charts.setOnLoadCallback(drawengchart);
  google.charts.setOnLoadCallback(drawFansChart);
  
  
  function drawMap() {
    $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_fb_geo" },		 
		function( data ){ 
		  
		
        
              var array  = JSON.parse(data);

                var data = google.visualization.arrayToDataTable(array);
        
              
                
                    var options = {};
                    options['dataMode'] = 'regions';
                
                    var container = document.getElementById('regions_div');
                    var geomap = new google.visualization.GeoMap(container);
                
                    geomap.draw(data, options);
		}
	);
  };
  var chartdistofint;
  function drawChart() {

   $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_fb_pie" },		 
		function( data ){ 
		  
		      
        
              var array  = JSON.parse(data);
              //alert("this is "+array);

                var data = google.visualization.arrayToDataTable(array);
        
              
                
                    
                        
                        var options = {
                          title: 'Distribution of Interactions',
                          sliceVisibilityThreshold: .0002
                        };
                        
                         chartdistofint = new google.visualization.PieChart(document.getElementById('piechart'));
                        
                        chartdistofint.draw(data, options);
		}
	);
}

var chartpageposts;
function drawChart4() {
    
        $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_f_posts"},		 
		function( data ){ 
		  console.log(data);
		
        
              var result  = JSON.parse(data);
              if(result[0].length < 1){
                    return;
                }
                  var data = google.visualization.arrayToDataTable([
                   ['Date', 'Posts'],
                    [new Date(result[1][0], result[2][0], result[3][0]),result[0][0]]
                  ]);

                	for(var i=1 ; i<result[0].length ; i++){
            			 data.addRow([new Date(result[1][i], result[2][i], result[3][i]),result[0][i]]);
                         
            			}
        
                var options = {
                  chart: {
                    title: 'Number of Page Posts',
                     height: 500
                    //subtitle: 'All values are in percentage.'
                  }
                  
                };
        
                chartpageposts = new google.visualization.ColumnChart(document.getElementById('columnchart_material_4'));
        
                chartpageposts.draw(data, options);
		}
	);
}

var chartdistofpost;
function drawposttypechart() {

   $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_fb_posttype" },		 
		function( data ){ 
		  
		
        
              var array  = JSON.parse(data);

                var data = google.visualization.arrayToDataTable(array);
        
              
                
                    
                        
                        var options = {
                          title: 'Distribution of Posts by Type'
                        };
                        
                        chartdistofpost = new google.visualization.PieChart(document.getElementById('piechart2'));
                        
                        chartdistofpost.draw(data, options);
		}
	);
}

var chartengg;
function drawengchart() {
    $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_f_engg"},		 
		function( data ){ 
		  console.log(data);
		
        
              var result  = JSON.parse(data);
              if(result[0].length < 1){
                    return;
                }
                  var data = google.visualization.arrayToDataTable([
                    ['Date', 'Reactions','Comments','Shares'],
                    [new Date(result[1][0], result[2][0], result[3][0]), result[4][0], result[5][0], result[0][0] ]
                  ]);

                	for(var i=1 ; i<result[0].length ; i++){
            			 data.addRow([new Date(result[1][i], result[2][i], result[3][i]), result[4][i], result[5][i], result[0][i] ]);
                         
            			}
                      
                    
                        var options = {
                          title: 'Engagement',
                          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                          vAxis: {minValue: 0}
                        };
                    
                        chartengg = new google.visualization.AreaChart(document.getElementById('eng_chart'));
                        chartengg.draw(data, options);
		}
	);
  }
  
  var chartfans;
 function drawFansChart() {

        $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_f_fans"},		  
		function( data ){ 
		  console.log(data);
		
        
              var result  = JSON.parse(data);
              if(result[0].length < 1){
                    return;
                }
                  var data = google.visualization.arrayToDataTable([
                   ['Date', 'Total Fans'],
                    [new Date(result[1][0], result[2][0], result[3][0]),result[0][0]]
                  ]);

                	for(var i=1 ; i<result[0].length ; i++){
            			 data.addRow([new Date(result[1][i], result[2][i], result[3][i]),result[0][i]]);
                         
            			}
        
               
            
                    var options = {
                      title: 'Total Fans',
                      curveType: 'function',
                      pointSize: 17,
                      legend: { position: 'bottom' }
                    };
            
                    chartfans = new google.visualization.LineChart(document.getElementById('fan_chart'));
            
                    chartfans.draw(data, options);
		}
	);
}

function exportModal(){
	$('#exportModal').modal('show');
}

function exportPNG_fans(){
    window.open(chartfans.getImageURI());
}
function exportPNG_engg(){
    window.open(chartengg.getImageURI());
}
function exportPNG_distofpost(){
    window.open(chartdistofpost.getImageURI());
}
function exportPNG_pageposts(){
    window.open(chartpageposts.getImageURI());
}
function exportPNG_distofint(){
    window.open(chartdistofint.getImageURI());
}

function selectPage(){
    $pageval = $('#PageSelect').val();
    $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_fb_addPage",token:$pageval },		 
		function( data ){ 
		  
		
            location.href='rep_facebook.php';
		}
	);
}
