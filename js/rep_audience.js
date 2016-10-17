//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChart4);
      
      
      function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Age < 15', 'Age 15-30', 'Age > 30', 'Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar'],
          ['bbq lovers', 60, 20, 10, 15, 30, 25, 10, 5],
          ['Ice Creams', 40, 22, 9 , 10,21,12,05,11],
          ['Tea', 35, 25, 5,5,6,12,32,12],
          ['Milk', 45, 21, 12,11,5,14,6,20],
          ['Chiken Lovers', 70, 17, 3,20,21,5,6,11]
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
      
	
$(document).ready(function(){
    $('.ul-navigator-margin').css({"margin-bottom":"1%"});
    $('a[href="#tab_fourth"]').click();
});



function firsttab(){
    $('a[href="#tab_fourth"]').click();
}
