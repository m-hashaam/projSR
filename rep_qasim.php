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
<script type="text/javascript" src="js/rep_qasim.js"></script>


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
<link rel="stylesheet" type="text/css" href="css/components.css">
<link rel="stylesheet" type="text/css" href="css/plugins.css">
<link rel="stylesheet" type="text/css" href="css/layout.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
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
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        
         <link href=\'http://fonts.googleapis.com/css?family=Roboto\' rel=\'stylesheet\' type=\'text/css\'>
         

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
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=433118806862462";
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
                <div id="myownparent">';
                   
                   echo $footer;
                   include 'inc/rep_sidebar.php';
                            
    						$footer.='<div id="myowncontent">
                            
                             <h1>Status Post By Time</h1>
                                <div>
                                      <div id="curve_chart" style="width: 100%; height: 500px;"></div>
                                      <script>
                                            google.charts.setOnLoadCallback(drawChart2);
                                            function drawChart2() {

                                                    var data = google.visualization.arrayToDataTable([
                                                          [\'Hour\', \'Status Count\'],
                                                          ';
                                                          $query = "SELECT ttime, COUNT(kid) AS status FROM (
SELECT HOUR(FROM_UNIXTIME(`k_time`)) AS ttime,`k_id` AS kid FROM `qasim`) t group by ttime";
                                                          $stmt =  $db->query($query);
                                                          while($row = $stmt->fetch_assoc()){
                                                            $ttime = $row['ttime'];
                                                            $status = $row['status'];
                                                            $footer.='['.$row['ttime'].','.$row['status'].'],';
                                                          }
                                                          $footer.='
                                                          ['.$ttime.','.$status.']
                                                         
                                                        ]);
                                                
                                                        var options = {
                                                          title: \'Status Post By Daily Hours\',
                                                          curveType: \'function\',
                                                          pointSize: 17,
                                                          legend: { position: \'bottom\' }
                                                        };
                                                
                                                        var chart = new google.visualization.LineChart(document.getElementById(\'curve_chart\'));
                                                
                                                        chart.draw(data, options);
                                                }
                                      </script>
                                </div>
                                
                                 <hr>
                            
                            <h1>Facebook Posts</h1>
                            <h3 style="font-weight: bold; text-align: center;">Qasim Sheikh</h3>
                                            <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="firstTable" class="table table-bordered table-hover table-condensed">
                                                <tbody><tr><td style="font-weight: bold;">Timestamp</td>
                                                <td style="font-weight: bold;">Sentiment</td>
                                                <td style="font-weight: bold;">Post</td>
                                                </tr>';
                                                $query = "SELECT `k_id`, `k_time`, `k_post`, `k_sentiment` FROM `qasim` WHERE 1";
                                                $stmt = $db->query($query);
                                                while($row = $stmt->fetch_assoc()){
                                                    $footer.='<tr><td>'.gmdate("Y-m-d H:i:s", $row['k_time']).'</td><td>'.ucfirst($row['k_sentiment']).'</td><td>'.$row['k_post'].'</td></tr>';
                                                }
                                                
                                                $footer.='</tbody></table>
                                                
                                                <div id="piechart" style="width: 100%; height: 400px;"></div>
                                                
                                                
                                        		
                            <hr>
                            
                            <h1>Facebook Posts Interactions</h1>
                            <h3 style="font-weight: bold; text-align: center;">Khalid Latif</h3>
                                            <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="secondTable" class="table table-bordered table-hover table-condensed">
                                                <tbody><tr><td style="font-weight: bold;">Keyword</td>
                                                <td style="font-weight: bold;">Sentiment</td>
                                                <td style="font-weight: bold;">Advocacy Sentiment</td>
                                                </tr>
                                                <tr><td>Pakistan</td><td>Positive</td><td>Neutral</td></tr>
                                                <tr><td>PTI</td><td>Positive</td><td>Positive</td></tr>
                                                <tr><td>Government</td><td>Positive</td><td>Positive</td></tr>
                                                <tr><td>PMLN</td><td>Positive</td><td>Neutral</td></tr>
                                                <tr><td>Political</td><td>Positive</td><td>Positive</td></tr>
                                                <tr><td>Punjab</td><td>Neutral</td><td>Neutral</td></tr>
                                                <tr><td>KP</td><td>Positive</td><td>Positive</td></tr>
                                                <tr><td>System</td><td>Positive</td><td>Neutral</td></tr>
                                                <tr><td>Power</td><td>Positive</td><td>Neutral</td></tr>
                                                <tr><td>Elections</td><td>Positive</td><td>Negative</td></tr>
                                               </tbody></table>
                                                
                                               
                                                
                                                
                                        		
                            <hr>
                           
                            <h1>Emotions Over Time</h1>
                                <div>
                                      <div id="linechart_material" style="width: 100%; height: 500px;"></div>
                                      <script>
                                            
                                            google.charts.setOnLoadCallback(drawChart3);
                                            function drawChart3() {

                                              var data = new google.visualization.DataTable();
                                              data.addColumn(\'string\', \'Date\');
                                              data.addColumn(\'number\', \'Weak Positive\');
                                              data.addColumn(\'number\', \'Strong Positive\');
                                              data.addColumn(\'number\', \'Weak Neutral\');
                                        	  data.addColumn(\'number\', \'Strong Neutral\');
                                        	  data.addColumn(\'number\', \'Weak Negative\');
                                        	  data.addColumn(\'number\', \'Strong Negative\');
                                        
                                              data.addRows([ ';
                                                          $query = "SELECT MONTH(FROM_UNIXTIME(`kw_time`)) AS mm,YEAR(FROM_UNIXTIME(`kw_time`)) AS yy, COUNT(`kw_word`) AS cc, `kw_type`, `kw_pos`, `kw_polarity` FROM `qasim_words` WHERE  `kw_pos` = 'adj' group by yy,mm";
                                                          $stmt =  $db->query($query);
                                                          while($row = $stmt->fetch_assoc()){
                                                            $yy = $row['yy'];
                                                            $mm = $row['mm'];
                                                            if($row['kw_type'] == 'strongsubj' && $row['kw_polarity'] == 'positive'){
                                                                $footer.=' [\''.$row['mm'].' '.$row['yy'].'\' ,null ,'.$row['cc'].' ,null ,null ,null ,null ],';
                                                            }
                                                            else if($row['kw_type'] == 'weaksubj' && $row['kw_polarity'] == 'positive'){
                                                                $footer.=' [\''.$row['mm'].' '.$row['yy'].'\' ,'.$row['cc'].' ,null ,null ,null ,null ,null ],';
                                                            }
                                                            else if($row['kw_type'] == 'weaksubj' && $row['kw_polarity'] == 'negative'){
                                                                $footer.=' [\''.$row['mm'].' '.$row['yy'].'\' ,null ,null ,null ,null ,'.$row['cc'].' ,null ],';
                                                            }
                                                            else if($row['kw_type'] == 'strongsubj' && $row['kw_polarity'] == 'negative'){
                                                                $footer.=' [\''.$row['mm'].' '.$row['yy'].'\' ,null ,null ,null ,null ,null ,'.$row['cc'].' ],';
                                                            }
                                                            else if($row['kw_type'] == 'weaksubj' && $row['kw_polarity'] == 'neutral'){
                                                                $footer.=' [\''.$row['mm'].' '.$row['yy'].'\' ,null ,null ,'.$row['cc'].' ,null ,null ,null ],';
                                                            }
                                                            else if($row['kw_type'] == 'strongsubj' && $row['kw_polarity'] == 'neutral'){
                                                                $footer.=' [\''.$row['mm'].' '.$row['yy'].'\' ,null ,null ,null ,'.$row['cc'].' ,null ,null ],';
                                                            }
                                                            
                                                          }
                                                          $footer.='
                                                          [\''.$mm.' '.$yy.'\' ,null ,null ,null ,null ,null ,null ]
                                                         
                                                       
                                             
                                               
                                              ]);
                                        
                                              var options = {
                                                chart: {
                                                  title: \'Emotions\',
                                                  
                                                  subtitle: \'Adjectives\'
                                                },
                                                interpolateNulls: true,
                                                 curveType: \'function\',
                                                 pointSize: 8,
                                                width: 900,
                                                height: 500
                                              };
                                        
                                              var chart = new google.visualization.LineChart(document.getElementById(\'linechart_material\'));
                                        
                                              chart.draw(data, options);
                                            }
                                      </script>
                                </div>
                                
                                
                                
                               
                          
                                
                               
                           
                             <h1>Live Tweet Analysis (Family friends and followers)</h1>
                             <h5 style="    text-align: center; font-size:18px;">Visit the <a href="http://13.68.215.208:8983/solr/banana/index.html#/dashboard">link</a> for live tweet analysis.</h5>
                           
                         </div>
                        </div>
                    </div>
                    
                    ';
        echo $footer;
	
  
}



