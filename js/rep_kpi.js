//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChart2);
  
var chart;

    
    function drawChart2() {
        var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
        $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_kpi" ,week:datee},		 
		function( data ){ 
		  //console.log(data);
			var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
               var data = google.visualization.arrayToDataTable([
                   ['KPI', 'Positive', 'Negative'],
                    [result[0][0], parseInt(result[1][0]), parseInt(result[2][0])]
                  ]);
            
			     	for(var i=1 ; i<result[0].length ; i++){
            			 data.addRow([result[0][i], parseInt(result[1][i]), parseInt(result[2][i])]);
                         
            			}
        
                var options = {
                  chart: {
                    title: 'KPI'
                  },
                    
                   
        		      
                    height: 500,
                    isStacked: true,
                   
                };
                
                chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
        
                chart.draw(data, options);
		}
	);
        

      }
     
      
function exportPNG(){
    console.log(chart.getImageURI());
	window.open(chart.getImageURI());
}

function exportModal(){
	$('#exportModal').modal('show');
}
      
function sendEmail(){
    	toastr["success"]("Email Sent");
        $('#exportModal').modal('hide');
}
      
	
$(document).ready(function(){
   $('.container-fluid').first().css("box-shadow","5px 5px 15px #888888");
    $('.container-fluid').first().css("padding-bottom","5px");
    $('.container-fluid').first().css("z-index","9999");
    $('.page-footer').first().css("position","fixed");
    $('.page-footer').first().css("bottom","0");
    $('.page-footer').first().css("left","0");
    $('.page-footer').first().css("width","100%");
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
    $('.dropdown.dropdown-user.open').first().css("z-index","99990");
    
    $( "#dateSelector" ).change(function() {
        var vall = $( "#dateSelector" ).val();
        location.href='rep_kpi.php?date='+vall;
        //console.log(vall);
    });
    
    
       var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
    document.getElementById('dateSelector').value = datee;
  

});

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



function createCustomHTMLContent(flagURL, totalGold, totalSilver, totalBronze) {
  return '<div style="padding:5px 5px 5px 5px;">' +
	  '<img src="' + flagURL + '" style="width:75px;height:50px"><br/>' +
	  '<table class="medals_layout">' + '<tr>' +
	  '<td><img src="https://upload.wikimedia.org/wikipedia/commons/1/15/Gold_medal.svg" style="width:25px;height:25px"/></td>' +
	  '<td><b>' + totalGold + '</b></td>' + '</tr>' + '<tr>' +
	  '<td><img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Silver_medal.svg" style="width:25px;height:25px"/></td>' +
	  '<td><b>' + totalSilver + '</b></td>' + '</tr>' + '<tr>' +
	  '<td><img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Bronze_medal.svg" style="width:25px;height:25px"/></td>' +
	  '<td><b>' + totalBronze + '</b></td>' + '</tr>' + '</table>' + '</div>';
}