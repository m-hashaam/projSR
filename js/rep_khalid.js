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
google.charts.setOnLoadCallback(drawChart);


function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Sentiment', 'Tweets'],
      ['Positive',    61],
      ['Negative',     109],
      ['Neutral',     162]
    ]);
    
    var options = {
      title: 'Khalid Latif Facebook Analysis'
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}






