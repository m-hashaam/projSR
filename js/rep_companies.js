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
							paging_length: 10,  
							rows_counter: true,  
							rows_counter_text: "Tweets:",  
							btn_reset: true,  
							loader: true,  
							loader_text: "Filtering tweets...",
							col_1: "select",
						
							display_all_text: "  Show All  ",
							sort_select: true 
						};
	setFilterGrid( "firstTable",table2_Props );
    //setFilterGrid( "secondTable",table2_Props );
    //setFilterGrid( "thirdTable",table2_Props );
    //setFilterGrid( "fourthTable",table2_Props ); 
     
});

google.charts.load('current', {'packages':['corechart','line','bar']});

google.charts.setOnLoadCallback(drawChart2);

function drawChart2(){
     $.post( 
		'database/public_ajax.php', 			
		{ func: "rep_companies" },		 
		function( data ){ 
		  console.log(data);
		
        
      //var array  = JSON.parse(data);

        //var data = google.visualization.arrayToDataTable(array);
        
        
        	var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
            var colorr = "";
            if(parseInt(result[6][0]) > 0){
                colorr = "#26c281";
            }
            else{
                colorr = "#3366cc";
            }
             var data = google.visualization.arrayToDataTable([
                [ 'Company',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Score' ,{ role: 'annotation' },{ role: 'style' }],
                [ result[0][0],CreateTooltipExpanded(result[0][0],parseFloat(result[1][0]),parseInt(result[2][0]),parseInt(result[3][0]),parseInt(result[4][0]),parseInt(result[5][0]),parseInt(result[6][0]),result[7][0],result[8][0],result[10][0],result[9][0],result[11][0]), parseFloat(result[1][0]),'',colorr ]
              ]);
			for(var i=1 ; i<result[0].length ; i++){
			 if(parseInt(result[6][i]) > 0){
                    colorr = "#26c281";
                }
                else{
                    colorr = "#3366cc";
                }
			 data.addRow( [result[0][i],CreateTooltipExpanded(result[0][i],result[1][i],result[2][i],result[3][i],result[4][i],result[5][i],result[6][i],result[7][i],result[8][i],result[10][i],result[9][i],result[11][i]),parseFloat(result[1][i]),'',colorr ]);
			}
            
        
        
        
                 var options = {
                    focusTarget: 'category',
                    tooltip: { isHtml: true },
                    title: 'Company Scores'
                 };
    
            var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
    
            chart.draw(data, options);
		}
	);
}



function CreateTooltip(name, score, diversity, team,enthu,social,acc,categories,products ) {
  var html =  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>Company Information</h4>' +
    	  '<table border="1" class="medals_layout">' + '<tr>' +
    	  '<td><b>Name</b></td>' +
    	  '<td><b>Product Diversity</b></td>' + 
          '<td><b>Experience and Qualification of Team</b></td>' + 
          '<td><b>Technical and Non Technical Enthusiasm</b></td>' + 
          '<td><b>Social Presense</b></td>' + 
          '<td><b>Accessible</b></td>' + 
          '<td><b>Score</b></td>' + 
          '</tr>' + 
          '<tr>' +
    	  '<td><b>'+name+'</b></td>' +
    	  '<td>'+diversity+'</td>' + 
          '<td>'+team+'</td>' + 
          '<td>'+enthu+'</td>' + 
          '<td>'+social+'</td>' + 
          '<td>'+acc+'</td>' +
          '<td>'+score+'</td>' + 
          '</tr>' +
          '</table></div>';
          
          
          html +=  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>Company Categories</h4>' +
    	  '<table class="medals_layout">' + '<tr>';
          
          for(var i=0 ; i<categories.length ; i++){
            html+='<td>'+categories[i]+'</td>';
            if(i%10 == 0 && i != 0){
                html+='</tr><tr>';
            }
          }
          
          html+= '</tr>' +
          '</table></div>';
          
          
          
          html +=  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>Company Products</h4>' +
    	  '<table class="medals_layout">' + '<tr>';
          
          for(var i=0 ; i<products.length ; i++){
            html+='<td>'+products[i]+'</td>';
            if(i%10 == 0 && i != 0){
                html+='</tr><tr>';
            }
          }
          
          
          html+= '</tr>' +
          '</table></div>';
          
          
       return html;
}

function filter(){
    $value = $('#firstS').val();
    $value += " ";
    $value += $('#secondS').val();
    $value += " ";
    $value += $('#thirdS').val();
    drawChart4($value);
}

function search(){
    $value = $('#fourthS').val();
    drawChart5($value);
}

function drawChart4(values){
     $.post( 
		'database/public_ajax.php', 			
		{ func: "rep_companies2",values:values },		 
		function( data ){ 
		  console.log(data);
		
        
      //var array  = JSON.parse(data);

        //var data = google.visualization.arrayToDataTable(array);
        
        
        	var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
            var colorr = "";
            if(parseInt(result[6][0]) > 0){
                colorr = "#26c281";
            }
            else{
                colorr = "#3366cc";
            }
             var data = google.visualization.arrayToDataTable([
                [ 'Company',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Score' ,{ role: 'annotation' },{ role: 'style' }],
                [ result[0][0],CreateTooltipExpanded(result[0][0],parseFloat(result[1][0]),parseInt(result[2][0]),parseInt(result[3][0]),parseInt(result[4][0]),parseInt(result[5][0]),parseInt(result[6][0]),result[7][0],result[8][0],result[10][0],result[9][0],result[11][0]), parseFloat(result[1][0]),'',colorr ]
              ]);
			for(var i=1 ; i<result[0].length ; i++){
			 if(parseInt(result[6][i]) > 0){
                    colorr = "#26c281";
                }
                else{
                    colorr = "#3366cc";
                }
			 data.addRow( [result[0][i],CreateTooltipExpanded(result[0][i],result[1][i],result[2][i],result[3][i],result[4][i],result[5][i],result[6][i],result[7][i],result[8][i],result[10][i],result[9][i],result[11][i]),parseFloat(result[1][i]),'',colorr ]);
			}
            
        
        
        
                 var options = {
                    focusTarget: 'category',
                    tooltip: { isHtml: true },
                    title: 'Company Scores'
                 };
    
            var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
    
            chart.draw(data, options);
		}
	);
}

function drawChart5(values){
    console.log("value is "+values);
     $.post( 
		'database/public_ajax.php', 			
		{ func: "rep_companies3",values:values },		 
		function( data ){ 
		  console.log(data);
		 
        
        	var result = JSON.parse(data);
            if(result[0].length < 1){
                return;
            }
            var colorr = "";
            if(parseInt(result[6][0]) > 0){
                colorr = "#26c281";
            }
            else{
                colorr = "#3366cc";
            }
             var data = google.visualization.arrayToDataTable([
                [ 'Company',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Score' ,{ role: 'annotation' },{ role: 'style' }],
                [ result[0][0],CreateTooltipExpanded(result[0][0],parseFloat(result[1][0]),parseInt(result[2][0]),parseInt(result[3][0]),parseInt(result[4][0]),parseInt(result[5][0]),parseInt(result[6][0]),result[7][0],result[8][0],result[10][0],result[9][0],result[11][0]), parseFloat(result[1][0]),'',colorr ]
              ]);
			for(var i=1 ; i<result[0].length ; i++){
			 if(parseInt(result[6][i]) > 0){
                    colorr = "#26c281";
                }
                else{
                    colorr = "#3366cc";
                }
			 data.addRow( [result[0][i],CreateTooltipExpanded(result[0][i],result[1][i],result[2][i],result[3][i],result[4][i],result[5][i],result[6][i],result[7][i],result[8][i],result[10][i],result[9][i],result[11][i]),parseFloat(result[1][i]),'',colorr ]);
			}
            
        
        
        
                 var options = {
                    focusTarget: 'category',
                    tooltip: { isHtml: true },
                    title: 'Company Scores'
                 };
    
            var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
    
            chart.draw(data, options);
		}
	);
}

function CreateTooltipExpanded(name, score, diversity, team,enthu,social,acc,categories,products,execs,addreses,catee ) {
  var html =  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>'+name+' Information</h4>' +
    	  '<table border="1" class="medals_layout">' + '<tr>' +
    	  '<td><b>Name</b></td>' +
          '<td><b>Category</b></td>' +
    	  '<td><b>Product Diversity</b></td>' + 
          '<td><b>Experience and Qualification of Team</b></td>' + 
          '<td><b>Technical and Non Technical Enthusiasm</b></td>' + 
          '<td><b>Social Presense</b></td>' + 
          '<td><b>Accessible</b></td>' + 
          '<td><b>Score</b></td>' + 
          '</tr>' + 
          '<tr>' +
    	  '<td><b>'+name+'</b></td>' +
          '<td><b>'+catee+'</b></td>' +
    	  '<td>'+diversity+'</td>' + 
          '<td>'+team+'</td>' + 
          '<td>'+enthu+'</td>' + 
          '<td>'+social+'</td>' + 
          '<td>'+acc+'</td>' +
          '<td>'+score+'</td>' + 
          '</tr>' +
          '</table></div>';
          
          
          html +=  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>'+name+' Categories</h4>' +
    	  '<table class="medals_layout">' + '<tr>';
          
          for(var i=0 ; i<categories.length ; i++){
            html+='<td>'+categories[i]+'</td>';
            if(i%10 == 0 && i != 0){
                html+='</tr><tr>';
            }
          }
          
          html+= '</tr>' +
          '</table></div>';
          
          
          
          html +=  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>'+name+' Products</h4>' +
    	  '<table class="medals_layout">' + '<tr>';
          
          for(var i=0 ; i<products.length ; i++){
            html+='<td>'+products[i]+'</td>';
            if(i%10 == 0 && i != 0){
                html+='</tr><tr>';
            }
          }
          
          
          html+= '</tr>' +
          '</table></div>';
          
          
            html +=  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>'+name+' Executives</h4>' +
    	  '<table class="medals_layout">' + '<tr><td><b>Name</b></td><td><b>Designation</b></td><td><b>Linked In</b></td></tr>';
          
          for(var i=0 ; i<execs[0].length ; i++){
                html+='<tr><td>'+execs[0][i]+'</td><td>'+execs[1][i]+'</td><td>'+execs[2][i]+'</td></tr>';   
          }
          
          html+=  '</table></div>';
          
            html +=  '<div style="padding:5px 5px 5px 5px;">' +
          '<h4>'+name+' Address(es)</h4>' +
    	  '<table class="medals_layout">' + '<tr><td><b>Address</b></td></tr>';
          
          for(var i=0 ; i<addreses.length ; i++){
                html+='<tr><td>'+addreses[i]+'</td></tr>';   
          }
          
          html+=  '</table></div>';
          
          
       return html;
}

