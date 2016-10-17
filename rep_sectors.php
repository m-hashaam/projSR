<?php
session_start(); 
include 'database/db.php';
$userid = $_SESSION['idSR'];
$proid = $_SESSION['CurrentProductID'];

$html='<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
 


<title>Sweet Referrals | Reports</title>

<style>



#myownsidebar {
    position: fixed;
    top: 49px;
    left: 0px;
    bottom: 0px;
    width: 200px;
    background-color: #fafafa;
}
#myownparent {
    margin-left: 200px;
    margin-bottom:100px;
}

.sidebarli{
    padding-left: 10%;
     cursor: pointer;
     padding-top:7px;
     padding-bottom:7px;
     margin:0;
}

.sidebarli:hover{
    background: #ddd;    
}


 
#circle circle {
fill: none;
pointer-events: all;
}
 
.group path {
fill-opacity: .5;
}
 
path.chord {
stroke: #000;
stroke-width: .25px;
}
 
#circle:hover path.fade {
display: none;
}
 
</style>
<script src="http://d3js.org/d3.v2.min.js?2.8.1"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

 <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.blockui.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<script type="text/javascript" src="js/jquery.cokie.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/metronic.js"></script>
<script type="text/javascript" src="js/layout.js"></script>
<script type="text/javascript" src="js/ui-extended-modals.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/toastr.min.js"></script>
<script type="text/javascript" src="js/components-pickers.js"></script>
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/pace.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/helpers.js"></script>
<script type="text/javascript" src="js/steps.js"></script>
<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="js/pager.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="js/rep_segmentReach.js"></script>


<link rel="stylesheet" type="text/css" href="css/filtergrid.css">
<link href="css/jquery-multi-step-form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/uniform.default.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal-bs3patch.css">
<link rel="stylesheet" type="text/css" href="css/select2.css">
<link rel="stylesheet" type="text/css" href="css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="bcss/components.css">
<link rel="stylesheet" type="text/css" href="css/plugins.css">
<link rel="stylesheet" type="text/css" href="bcss/layout.css">
<link rel="stylesheet" type="text/css" href="bcss/default.css">
<link rel="stylesheet" type="text/css" href="css/tooltipster.css">
<link rel="stylesheet" type="text/css" href="css/pace-theme-flash.css">
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" type="text/css" href="css/tasks.css">
<link rel="stylesheet" type="text/css" href="css/components-rounded.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-fileinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.css">
<link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.Metronic.css">
<link rel="stylesheet" type="text/css" href="css/introLoader.min.css">
<link rel="stylesheet" type="text/css" href="css/timeline.css">
<link rel="stylesheet" type="text/css" href="css/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/flaticon(1).css">
<link rel="stylesheet" type="text/css" href="css/flaticon(2).css">
<link rel="stylesheet" type="text/css" href="css/fontcustom.css">
<link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link rel="stylesheet" type="text/css" href="css/hover-min.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-tour.min.css">

<link rel="stylesheet" type="text/css" href="css/alignment.css">
<link rel="stylesheet" type="text/css" href="css/headings-texts.css">
<link rel="stylesheet" type="text/css" href="css/select-boxes.css">
      
	   <link rel="stylesheet" type="text/css" href="css/MyTabs.css">
        <link rel="stylesheet" type="text/css" href="bcss/custom.css">
        
         <link href=\'http://fonts.googleapis.com/css?family=Roboto\' rel=\'stylesheet\' type=\'text/css\'>
         
              
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
         

  <!-- use the font -->
  <style>
    body {
      font-family: \'Roboto\', sans-serif;
    }
  </style>
  
       
    </head>';
	
	echo $html;
	
	$html='<body style="color: rgba(0, 0, 0, 0.65);" class=" page-header-menu-fixed  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=433118806862462";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

';
echo $html;

include 'inc/public_header.php';

//include 'inc/sidebar.php';

echo '<div class="page-container">';

include 'inc/top_menu.php';

echo '<div class="page-content"><div class="container-fluid"><div class="row"><div class="profile-content col-md-12 col-sm-12">';


compaignContent($pname); 


echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function compaignContent($pname){
    include 'database/dbkhalid.php';
    
    $userid = $_SESSION['idSR'];
    $proid = $_SESSION['CurrentProductID'];
   
    
    
    

    	$footer = '<div class="portlet-body">        
                ';
                   
                   echo $footer;
                  
                            
    						$footer.='
                            
                             <h1 style="    text-align: center;">Sales Feasibility for Sweetreferrals</h1>
                             
                               
                                
                          <div id="mychart" style="min-width: 600px; height: 500px; margin: 0 auto"></div>
                            <script>
                            $(function () {
                            
                                $(\'#mychart\').highcharts({
                            
                                    chart: {
                                        polar: true,
                                        type: \'line\'
                                    },
                                    
                            
                                    title: {
                                        text: \'\',
                                        x: -80
                                    },
                            
                                    pane: {
                                        size: \'90%\'
                                    },
                            
                                    xAxis: {
                                        categories: [\'Marketing Share\', \'Average Enthusiasm and Qualification of Executives\', \'Current Technology State\'],
                                        tickmarkPlacement: \'on\',
                                        lineWidth: 0
                                    },
                            
                                    yAxis: {
                                        gridLineInterpolation: \'polygon\',
                                        lineWidth: 0,
                                        min: 0
                                    },
                            
                                    tooltip: {
                                        shared: true,
                                        pointFormat: \'<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>\'
                                    },
                            
                                    legend: {
                                        align: \'right\',
                                        verticalAlign: \'top\',
                                        y: 70,
                                        layout: \'vertical\',
                                        itemStyle: {
                                                
                                                
                                                fontSize: \'18px\'
                                            }
                                    },
                            
                                    series: [{
                                        name: \'FMCG\',
                                        data: [23,7,4],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Fashion & Life Style\',
                                        data: [18,9,3],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Telcos\',
                                        data: [6,9,8],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Real Estate\',
                                        data: [13,6,4],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Banks\',
                                        data: [6,8,5],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Government\',
                                        data: [14,5,2],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Electronics\',
                                        data: [2,7,6],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Hospitality\',
                                        data: [5,5,7],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Education\',
                                        data: [9,5,4],
                                        pointPlacement: \'on\'
                                    }, {
                                        name: \'Pharmaceutical\',
                                        data: [2,6,3],
                                        pointPlacement: \'on\'
                                    }]
                            
                                });
                            });
                            </script>
                                     
                                </div>
                                
                                 <hr>
                                 
                                   <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                								<th><b>Sr. No</b></th>
                                                <th><b>Sector</b></th>
                                                <th><b>Score</b></th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                            <tr><td>1</td><td>FMCG</td><td>3.43</td></tr>
                                            <tr><td>2</td><td>Fashion & Life Style</td><td>3.36</td></tr>
                                            <tr><td>3</td><td>Telcos</td><td>3.02</td></tr>
                                            <tr><td>4</td><td>Real Estate</td><td>2.51</td></tr>
                                            <tr><td>5</td><td>Banks</td><td>2.50</td></tr>
                                            <tr><td>6</td><td>Government</td><td>2.14</td></tr>
                                            <tr><td>7</td><td>Electronics</td><td>2.10</td></tr>
                                            <tr><td>8</td><td>Hospitality</td><td>2.01</td></tr>
                                            <tr><td>9</td><td>Education</td><td>1.99</td></tr>
                                            <tr><td>10</td><td>Pharmaceutical</td><td>1.60</td></tr>
                                         </tbody>
                                    </table>
                                    
                                     <hr>
                                 <h2 style="    text-align: center;">FMCG Categories</h2>
                                  <p style="    text-align: center;">(Sales feasibility of FMCG market segments)</p>
                                   <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                                            <th><b>Sr. No</b></th>
                								<th><b>Category</b></th>
                                                <th><b>Score</b></th>
                                            </tr>
                                         </thead>
                                         <tbody>';
                                            $nn = 1;
                                            $query = "SELECT count(`s_score`) AS counts ,SUM(`s_score`) AS sums,`s_category` FROM `scores` WHERE `s_s_category` = 'Dairy'";
                                            $stmt = $db->query($query);
                                            $dairy = 0;
                                            if($row = $stmt->fetch_assoc()){
                                                $dairy = $row['sums'] / 96;
                                            }
                                            
                                            $query = "SELECT count(`s_score`) AS counts ,SUM(`s_score`) AS sums,`s_category` FROM `scores` WHERE `s_category` != '' GROUP BY `s_category` ORDER BY SUM(`s_score`)/96 DESC";
                                            $stmt = $db->query($query);
                                            while($row = $stmt->fetch_assoc()){
                                                $catt = $row['s_category'];
                                                $scc = $row['sums'] / 96;
                                                if($scc < $dairy){
                                                    $footer.='<tr><td>'.$nn.'</td><td>'.ucfirst("Dairy").'</td><td>'.number_format($dairy,2).'</td></tr>';
                                                    $dairy = 0;
                                                    $nn++;
                                                }
                                                $footer.='<tr><td>'.$nn.'</td><td>'.ucfirst($catt).'</td><td>'.number_format($scc,2).'</td></tr>';
                                                $nn++;
                                            }
                                            $footer.='
                                            
                                         </tbody>
                                    </table>
                                    <p style="    text-align: center;">For more information, visit <a href=\'http://portal.sweetreferrals.com/rep_companies.php\'>this</a> link.</p>
                                    
                                    <hr>
                             <h2 style="    text-align: center;">FMCG Segment Reach Heatmap</h2>
                            
                             <div class="row">
                                    <div style="float:left; width:70%;">
                                        <div id="map" style="width: 80%; height:500px; margin-left:auto; margin-right:auto;"></div>
								    </div>
                                    <div style="float:right; width:30%;">
                                         <form  action="">
                                          <input type="radio" checked name="gender" value="1"> Confectionary</br>
                                          <input type="radio" name="gender" value="2"> Dairy Products</br>
                                          <input type="radio" name="gender" value="3"> Bakery Products </br>
                                          <input type="radio" name="gender" value="4"> Personal care & Hygiene </br>
                                          <input type="radio" name="gender" value="5"> Food </br>
                                          <input type="radio" name="gender" value="6"> Juice & Beverages </br>
                                          <input type="radio" name="gender" value="7"> Sanitary & Home Care </br>
                                          <input type="radio" name="gender" value="8"> Tea & Coffee </br>
                                          <input type="radio" name="gender" value="9"> Tobacco </br>
                                        </form>
                                    </div>
                                    
                              </div>
                              
                                <script async defer
                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC37RsJwhH4B9xvdkFE56ewh_QnPWKSohs&libraries=visualization&callback=initMap">
                                </script>
                          
                          
                                
                                
                                
                               
                          
                                
                               
                           
                         </div>
                       
                    
                    ';
        echo $footer;
	
  
}



