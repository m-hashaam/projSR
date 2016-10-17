//google.load('visualization', '1.1', {packages: ['line']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load('visualization', '1.1', {packages: ['corechart','line','bar']});
    google.setOnLoadCallback(drawChart4);
      var chart;
      
      function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Age < 15', 'Age 15-30', 'Age > 30', 'Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar'],
          ['Coffee lovers', 60, 20, 10, 15, 30, 25, 10, 5],
          ['Ice Creams', 40, 22, 9 , 10,21,12,05,11],
          ['Tea', 35, 25, 5,5,6,12,32,12],
          ['Milk', 45, 21, 12,11,5,14,6,20],
          ['Spice Lovers', 70, 17, 3,20,21,5,6,11]
        ]);

        var options = {
          chart: {
            title: 'Audience',
            subtitle: 'All values are in percentage.'
          },
            width: 900,
            height: 500
        };

        chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material_4'));

        chart.draw(data, options);
      }
      
      function drawChart5() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Age < 15', 'Age 15-30', 'Age > 30', 'Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar'],
          ['Coffee lovers', 30, 20, 10, 15, 30, 25, 10, 5],
          ['Ice Creams', 20, 22, 9 , 10,24,12,05,11],
          ['Tea', 15, 25, 15,25,36,12,32,42],
          ['Milk', 25, 21, 12,11,35,14,6,20],
          ['Spice Lovers', 23, 17, 43,20,21,51,61,11]
        ]);

        var options = {
          chart: {
            title: 'Audience',
            subtitle: 'All values are in percentage.'
          },
            width: 900,
            height: 500
        };

        chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material_4'));

        chart.draw(data, options);
      }
      
      function drawChart6() {
        var data = google.visualization.arrayToDataTable([
          ['KPI', 'Age < 15', 'Age 15-30', 'Age > 30', 'Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar'],
          ['Coffee lovers', 10, 20, 10, 15, 30, 25, 10, 5],
          ['Ice Creams', 30, 22, 9 , 10,21,12,05,11],
          ['Tea', 30, 35, 5,5,6,12,32,12],
          ['Milk', 35, 21, 16,15,15,25,10,20],
          ['Spice Lovers', 20, 11, 13,20,21,5,6,11]
        ]);

        var options = {
          chart: {
            title: 'Audience',
            subtitle: 'All values are in percentage.'
          },
            width: 900,
            height: 500
        };

        chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material_4'));
        

        chart.draw(data, options);
      }
      
	
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
        console.log("val is "+vall);
        if(vall == 1){
            drawChart4();
            
        }
        else if(vall == 2){
            drawChart5();
            
        }
        else if(vall == 3){
            drawChart6();
            
        }
    });
});


function exportPNG(){
    console.log(chart.getImageURI());
	window.open(chart.getImageURI());
}

function exportModal(){
	$('#exportModal').modal('show');
}
      
function sendEmail(){
    	toastr["success"]("Email Sent");
        $('#exportModal').modal('hide');
}


function firsttab(){
    $('a[href="#tab_fourth"]').click();
}
