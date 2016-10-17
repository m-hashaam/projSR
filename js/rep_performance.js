//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChart);


    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Day');
      data.addColumn('number', 'Response Rate');
      data.addColumn('number', 'Organic Reach');
      data.addColumn('number', 'Samples Requested');
	  data.addColumn('number', 'Reach');

      data.addRows([
        ['15 Feb',  37180, 3508, 41812, 424512],
        ['17 Feb',  30190, 2805, 32413, 525734],
        ['19 Feb',  25140, 2300 ,  25731, 235634],
        ['21 Feb',  11170, 1808, 10521, 462467],
        ['23 Feb',  31190, 1706, 12044, 346834],
        ['25 Feb',  58180, 1306, 11727, 412123],
        ['27 Feb',  47160, 1503, 21196, 352345],
        ['29 Feb',  62130, 2902, 40561, 346732],
        ['2 Mar',   56130, 4902, 51016, 345234],
        ['4 Mar',   66130, 2302, 41026, 345326],
        ['6 Mar',   46130, 2907, 43106, 563235]
       
      ]);

      var options = {
        chart: {
          title: 'Performance',
          subtitle: ''
        },
		animation:{
        duration: 1000,
        easing: 'out',
      },
       
	
	     width: 900,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('linechart_material'));

      chart.draw(data, options);
    
	}
    
    
    
	
$(document).ready(function(){
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
     $('a[href="#tab_images"]').click();
});

function firsttab(){
    $('a[href="#tab_images"]').click();
}
