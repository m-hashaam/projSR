//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChart4);
      
      var chart ;
      var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};
      
function drawChart4() {
    var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
        $.post( 
		'database/reports_graph.php', 			
		{ func: "rep_persona" ,week:datee},		 
		function( data ){ 
		  console.log(data);
		
        
              var array  = JSON.parse(data);

                var data = google.visualization.arrayToDataTable(array);
        
                var options = {
                  chart: {
                    title: 'Persona',
                     height: 500
                    //subtitle: 'All values are in percentage.'
                  }
                  
                };
        
                chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material_4'));
        
                chart.draw(data, options);
		}
	);
}
      
     
      
	
$(document).ready(function(){
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
    $('a[href="#tab_persona"]').click();
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
        location.href='rep_persona.php?date='+vall;
        //console.log(vall);
    });
    
    
       var datee = getUrlParameter('date');
        var find = '%20';
        var re = new RegExp(find, 'g');
        
        datee = datee.replace(re, ' ');
    document.getElementById('dateSelector').value = datee;
    
    
});

function exportPNG(){
    console.log(chart.getImageURI());
	window.open(chart.getImageURI());
}

function exportModal(){
	$('#exportModal').modal('show');
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
      
function sendEmail(){
    	toastr["success"]("Email Sent");
        $('#exportModal').modal('hide');
}



function firsttab(){
    $('a[href="#tab_persona"]').click();
}
