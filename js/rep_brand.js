 Array.prototype.reduce = undefined;
 
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChartMain3);
    google.setOnLoadCallback(drawChartMain4);

	var chart2;
    var chart1;
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
      $( "#dateSelector" ).change(function() {
        var vall = $( "#dateSelector" ).val();
        location.href='rep_brand.php?date='+vall;
        //console.log(vall);
    });
    
    
       var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
    document.getElementById('dateSelector').value = datee;
});


function firsttab(){
    $('a[href="#tab_brand"]').click();
}

function exportPNG(){
    console.log(chart1.getImageURI());
	window.open(chart1.getImageURI());
}

function exportPNG2(){
    console.log(chart2.getImageURI());
	window.open(chart2.getImageURI());
}

function exportModal(){
	$('#exportModal').modal('show');
}
      
function sendEmail(){
    	toastr["success"]("Email Sent");
        $('#exportModal').modal('hide');
}



function drawChartMain3(){
      var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
     
     $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_brand_kpi", week:datee },		 
		function( data ){ 	
			var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
              
            
			   var data = google.visualization.arrayToDataTable([
                  ['KPI', 'Response'],
                  [result[0][0],     parseInt(result[1][0])],
                  [result[0][1],     parseInt(result[1][1])]
                ]);

           
                 
                var options = {
                 'width':500,
                                 'height':500,
                  pieHole: 0.5
                };
            
                chart2 = new google.visualization.PieChart(document.getElementById('chart_div_main_2'));
                chart2.draw(data, options);
                }
	);
}

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

function drawChartMain4() {
    var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
     
     $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_brand_conversion", week:datee },		 
		function( data ){ 	
			var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
              
            
			   var data = google.visualization.arrayToDataTable([
                  ['KPI', 'Response'],
                  [result[0][0],     parseInt(result[1][0])],
                  [result[0][1],     parseInt(result[1][1])]
                ]);

           
                 
             
            
                var options = {
                  'width':500,
                                 'height':500,
                  pieHole: 0.5
                };
            
                chart1 = new google.visualization.PieChart(document.getElementById('chart_div_main_6'));
                chart1.draw(data, options);
                }
	);
}



