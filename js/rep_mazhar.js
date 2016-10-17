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
    setFilterGrid( "secondTable",table2_Props );
    setFilterGrid( "thirdTable",table2_Props );
    setFilterGrid( "fourthTable",table2_Props ); 
     
});

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart2);
google.charts.setOnLoadCallback(drawChart3);
google.charts.setOnLoadCallback(drawChart4);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Sentiment', 'Tweets'],
      ['Positive',    61],
      ['Negative',     15],
      ['Neutral',     33]
    ]);
    
    var options = {
      title: 'Humayun Mazhar Twitter Analysis'
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}

function drawChart2() {

    var data = google.visualization.arrayToDataTable([
      ['Sentiment', 'Tweets'],
      ['Positive',    94],
      ['Negative',     25],
      ['Neutral',     73]
    ]);
    
    var options = {
      title: 'Mehreen Humayun Twitter Analysis'
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
    
    chart.draw(data, options);
}

function drawChart3() {

    var data = google.visualization.arrayToDataTable([
      ['Sentiment', 'Tweets'],
      ['Positive',    19],
      ['Negative',     41],
      ['Neutral',     51]
    ]);
    
    var options = {
      title: 'Shameel Mazhar Twitter Analysis'
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
    
    chart.draw(data, options);
}

function drawChart4() {

    var data = google.visualization.arrayToDataTable([
      ['Sentiment', 'Tweets'],
      ['Positive',    36],
      ['Negative',     17],
      ['Neutral',     16]
    ]);
    
    var options = {
      title: 'Iman Mazhar Twitter Analysis'
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
    
    chart.draw(data, options);
}

