//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChart3);
      
      function drawChart3() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Day');
      data.addColumn('number', 'Direct Traffic');
      data.addColumn('number', 'Facebook');
      data.addColumn('number', 'Twitter');
	  data.addColumn('number', 'Instagram');

      data.addRows([
        ['15 Feb',  37180, 53508, 41812, 42412],
        ['17 Feb',  30190, 62805, 32413, 52534],
        ['19 Feb',  25140, 72300 ,25731, 23634],
        ['21 Feb',  11170, 41808, 10521, 42467],
        ['23 Feb',  31190, 21706, 12044, 36834],
        ['25 Feb',  58180, 51306, 11727, 42123],
        ['27 Feb',  47160, 71503, 21196, 52345],
        ['29 Feb',  62130, 52902, 40561, 46732],
        ['2 Mar',   56130, 74902, 51016, 34234],
        ['4 Mar',   66130, 92302, 41026, 34326],
        ['6 Mar',   46130, 72907, 43106, 56235]
       
      ]);

      var options = {
        chart: {
          title: 'Placement',
          subtitle: 'Sweet Referral Product Page Visits'
        },
		animation:{
        duration: 1000,
        easing: 'out',
      },
       
	
	     width: 900,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('linechart_material_2'));

      chart.draw(data, options);
    
	}
	

	
$(document).ready(function(){
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
    $('a[href="#tab_preview"]').click();
});


function firsttab(){
    $('a[href="#tab_preview"]').click();
}
