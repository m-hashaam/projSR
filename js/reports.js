//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(doSomething);
    google.setOnLoadCallback(drawChartMain1);
    google.setOnLoadCallback(drawChartMain2);
    google.setOnLoadCallback(drawChartMain3);
    google.setOnLoadCallback(drawChartMain4);


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
    
    
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Positive (%)', 'Negative (%)', 'Neutral (%)'],
          ['Taste', 60, 30, 10],
          ['Color', 40, 50, 10],
          ['Spice', 40, 10, 50]
        ]);

        var options = {
          chart: {
            title: 'KPI'
          },
           
            width: 900,
            height: 500,
            isStacked: true,
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
      
      
      function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Age < 15', 'Age 15-30', 'Age > 30', 'Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar'],
          ['bbq lovers', 60, 20, 10, 15, 30, 25, 10, 5],
          ['sauces', 40, 22, 9 , 10,21,12,05,11],
          ['chicken lovers', 35, 25, 5,5,6,12,32,12],
          ['chicken nuggets', 45, 21, 12,11,5,14,6,20],
          ['chicken fillets', 70, 17, 3,20,21,5,6,11]
        ]);

        var options = {
          chart: {
            title: 'Audience',
            subtitle: 'All values are in percentage.'
          },
            width: 900,
            height: 500
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material_4'));

        chart.draw(data, options);
      }
      
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
    doSomething();
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
});

function doSomething(){
    drawChart2();
	setTimeout(drawChart, 500);
    setTimeout(firsttab, 500);
    setTimeout(drawChart3, 1000);
    setTimeout(drawChart4, 1500);
}

function firsttab(){
    $('a[href="#tab_general"]').click();
}

function drawChartMain1(){
  
        var data = google.visualization.arrayToDataTable([
        ['Feedback Type',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Positive', 'Negative',{ role: 'annotation' } ],
        ['05',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 3, 0.8,''],
        ['06',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 3.5, 0.9,'' ],
        ['07',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 4, 1.1,'' ],
		['08',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 5, 0.5,'' ],
		['09',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 10, 1.5,'' ],
		['10',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 6, 1.1,'' ],
		['11',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 8, 0.4,'' ],
		['12',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 7, 1.4,'' ],
		['13',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 9, 1,'' ],
		['14',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 7, 0.6,'' ]
      ]);

      var options = {
    
		  //title: 'Feedback on Product',
      
		tooltip: { isHtml: true },
		 focusTarget: 'category',
        isStacked: true,
	
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_main_1'));
        chart.draw(data, options);
}

function drawChartMain2(){
  
        var data = google.visualization.arrayToDataTable([
        ['Feedback Type',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Positive', 'Negative',{ role: 'annotation' } ],
        ['05',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 3, 0.8,''],
        ['06',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 3.5, 0.9,'' ],
        ['07',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 4, 1.1,'' ],
		['08',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 5, 0.5,'' ],
		['09',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 10, 1.5,'' ],
		['10',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 6, 1.1,'' ],
		['11',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 8, 0.4,'' ],
		['12',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 7, 1.4,'' ],
		['13',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 9, 1,'' ],
		['14',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 7, 0.6,'' ]
      ]);

      var options = {
    
		  //title: 'Customers Engaged',
     
		tooltip: { isHtml: true },
		 focusTarget: 'category',
        isStacked: true,
	
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_main_2'));
        chart.draw(data, options);
}

function drawChartMain3(){
  
        var data = google.visualization.arrayToDataTable([
        ['Feedback Type',{'type': 'string', 'role': 'tooltip', 'p': {'html': true}}, 'Positive', 'Negative',{ role: 'annotation' } ],
        ['05',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 3, 0.8,''],
        ['06',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 3.5, 0.9,'' ],
        ['07',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 4, 1.1,'' ],
		['08',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 5, 0.5,'' ],
		['09',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 10, 1.5,'' ],
		['10',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 6, 1.1,'' ],
		['11',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 8, 0.4,'' ],
		['12',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 7, 1.4,'' ],
		['13',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 9, 1,'' ],
		['14',createCustomHTMLContent('https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_the_USA.svg', 46, 29, 29), 7, 0.6,'' ]
      ]);

      var options = {
    
		  //title: 'Persona',
     
		tooltip: { isHtml: true },
		 focusTarget: 'category',
        isStacked: true,
		
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_main_3'));
        chart.draw(data, options);
}

function drawChartMain4() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Response'],
          ['Color',     77],
          ['Others',      23]
        ]);

        var options = {
          title: 'Most Responsive KPI',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div_main_4'));
        chart.draw(data, options);
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