//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
 Array.prototype.reduce = undefined;
 
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChartMain1);
    google.setOnLoadCallback(drawChartMain2);
    google.setOnLoadCallback(drawChartMain3);
    google.setOnLoadCallback(drawChartMain4);

	
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
});


function firsttab(){
    $('a[href="#tab_general"]').click();
}

function drawChartMain1(){
  
       $.post( 
		'database/reports_graph.php', 			
		{ func: "main_feedback" },		 
		function( data ){ 	
			var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
             var data = google.visualization.arrayToDataTable([
                ['Feedback Type',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Positive', 'Negative',{ role: 'annotation' } ],
                [result[2][0],feedbackTooltip(parseInt(result[0][0]), parseInt(result[1][0]),result[2][0]), parseInt(result[0][0])/1000, parseInt(result[1][0])/1000,'' ]
              ]);
			for(var i=1 ; i<result[0].length ; i++){
			 data.addRow([result[2][i],feedbackTooltip(parseInt(result[0][i]), parseInt(result[1][i]),result[2][i]), parseInt(result[0][i])/1000, parseInt(result[1][i])/1000,'' ]);
              //data.addRow(['13',feedbackTooltip(9000, 1000,13), 9, 1,'' ]);
			}
            
            
              var options = {
             legend: { position: 'top', alignment: 'end' },
        		  //title: 'Feedback on Product',
              
        		tooltip: { isHtml: true },
        		 focusTarget: 'category',
                isStacked: true,
                 hAxis: { textPosition: 'none' },
                  vAxis: { textPosition: 'none' }
        	
              };
        
                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_main_1'));
                chart.draw(data, options);
		}
	);
}

function drawChartMain2(){
  
       $.post( 
		'database/reports_graph.php', 			
		{ func: "main_customers" },		 
		function( data ){ 	
			var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
              var data = google.visualization.arrayToDataTable([
                    ['Date','Customers Engaged',{ role: 'annotation' } ],
                    [result[1][0], parseInt(result[0][0]), '']
                  ]);
			for(var i=1 ; i<result[0].length ; i++){
			 data.addRow([result[1][i], parseInt(result[0][i]), '']);
             
			}
            
            
           
            
                  var options = {
                
            		  //title: 'Customers Engaged',
                  legend: { position: 'top', alignment: 'end' },
            	
            		 focusTarget: 'category',
                    isStacked: true,
                     hAxis: { textPosition: 'none' },
                      vAxis: { textPosition: 'none' }	
                  };
            
                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_main_2'));
                    chart.draw(data, options);
		}
	);
}

function drawChartMain3(){
  
        $.post( 
		'database/reports_graph.php', 			
		{ func: "main_responded" },		 
		function( data ){ 	
			var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
              
              var data = google.visualization.arrayToDataTable([
                    ['Feedback Type','Responded',{ role: 'annotation' } ],
                    [result[1][0], parseInt(result[0][0]), '']
                  ]);
			for(var i=1 ; i<result[0].length ; i++){
			 data.addRow([result[1][i], parseInt(result[0][i]), '']);
             
			}
            
            
           
            
                 
            
                  var options = {
                 legend: { position: 'top', alignment: 'end' },
            		  //title: 'Persona',
                       
                     vAxis:{
                     baselineColor: '#fff',
                     gridlineColor: '#fff',
                     textPosition: 'none'
                   },
                   hAxis:{
                     baselineColor: '#fff',
                     gridlineColor: '#fff',
                     textPosition: 'none'
                   },
                 
            	
            		 focusTarget: 'category',
                    isStacked: true,
            		
                  };
            
                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_main_3'));
                    chart.draw(data, options);
		}
	);
}

function drawChartMain4() {
       $.post( 
		'database/reports_graph.php', 			
		{ func: "main_kpi" },		 
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
         
          pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div_main_6'));
        chart.draw(data, options);
		}
	);
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

function feedbackTooltip(positive, negative,date) {
  return '<div style="padding:5px 5px 5px 5px;">' +
	  '<table class="medals_layout">' + '<tr>' +
	  '<td><img src="http://portal.sweetreferrals.com/assets/heart.png" style="width:35px; padding-right:12px; border-right:1px solid #ccc;"/></td>' +
	  '<td><img src="http://portal.sweetreferrals.com/assets/bheart.png" style="width:25px; padding-left:5px;"/></td>' + '</tr>' + '<tr>' +
	  '<td style="text-align:center;">'+positive+'</td>' +
	  '<td style="text-align:center;">'+negative+'</td>' + '</tr>' + 
      '<tr><td colspan="2">Date: '+date+'</tr>'+
      '</table>' + '</div>';
}