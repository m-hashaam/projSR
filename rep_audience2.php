<?php
session_start(); 
if(!(isset($_SESSION['loggedInSR']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
if(!(isset($_SESSION['CurrentProductID']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
include 'database/db.php';
$userid = $_SESSION['idSR'];
$proid = $_SESSION['CurrentProductID'];
$weeks = array();
$query = "SELECT distinct(`ra_week`) AS weeks FROM `rep_audience` WHERE `p_id` = $proid";
$stmt = $db->query($query);
if($row = $stmt->fetch_assoc()){
    $weeks[] = $row['weeks'];
    while($row = $stmt->fetch_assoc()){
        $weeks[] = $row['weeks'];
    }
    
}
if(!isset($_GET['date']) && count($weeks > 0)){                      
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/rep_audience2.php?date='.$weeks[0]);
    die();
}
$query = "SELECT `p_id`, `u_id`, `p_name`, `p_url` FROM `product` WHERE `u_id` = $userid AND `p_id` = $proid";
$stmt = $db->query($query);
if($row = $stmt->fetch_assoc()){
	$pname = $row['p_name'];
	$pid = $row['p_id'];
    
}
else{
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}

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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/rep_audience2.js"></script>



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
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

';
echo $html;

include 'inc/header.php';

include 'inc/sidebar.php';

echo '<div class="page-container">';

include 'inc/top_menu.php';

echo '<div class="page-content"><div class="container-fluid"><div class="row"><div class="profile-content col-md-12 col-sm-12">';


$query = "SELECT `p_islive` FROM `product` WHERE `p_id` = $pid";
$stmt = $db->query($query);
if($row = $stmt->fetch_assoc()){
    if($row['p_islive'] == 1 || $row['p_islive'] == "1"){
        compaignContent($pname);
    }
    else{
        echo "<p style=\"margin-left:auto; margin-right:auto; text-align: center;   font-size: large;\">Reports are not available for draft products. Kindly make your product live to see reports and stats.</p>";
    }
    
}
else{
    echo "<p style=\"margin-left:auto; margin-right:auto; text-align: center;   font-size: large;\">Reports are not available for draft products. Kindly make your product live to see reports and stats.</p>";
}


echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function compaignContent($pname){
      include 'database/db.php';
        $userid = $_SESSION['idSR'];
        $proid = $_SESSION['CurrentProductID'];
        $dateee = $_GET['date'];
         $_SESSION['rep_date'] = $dateee;
	$footer = '<div class="portlet-body">
                   
                         <div id="myownparent">';
               
               echo $footer;
               include 'inc/rep_sidebar.php';
                        
						$footer.='<div id="myowncontent">

                        <a class="hidden" data-toggle="modal" data-backdrop="static" id="category_button" href="#add_category"></a>

                                
                        <div style="      margin-bottom: 20px;  display: flex; width: 50%; margin-left: auto;  margin-right: auto;">
                                <select id="dateSelector" style="width:40%" class="form-control select-lg" >
                                            <option value="3">April 23, 2016 - April 30, 2016</option>
                                        </select>
                                        
                                <button type="button" class="btn blue" onclick="exportModal()">Export</button>
                                </div>
                        
                        
                            <div class="form-body">
                                <button class="product-sticker page-quick-sidebar-toggler side-panel-padding nav-products-truncate tour-compatible" style="left:0; right:inherit;     border-top-right-radius: 45px !important;   border-bottom-left-radius: 0px !important; border-top-left-radius: 0px !important;  border-bottom-right-radius: 45px !important;" onclick="location.href=\'export/export/home.php\'">
                                	<i class="fa fa-bars fa-2x font-white"></i> Export
                                </button>
                                
                                <div class="row">
                                    <div id="map" style="width: 80%; height:500px; margin-left:auto; margin-right:auto;"></div>
								
                                    
                              </div>
                              
                                <div class="row">
                                  
                                    <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                								<th>City</th>
                								<th>Local Audience</th>
                								<th>Percentage of Local Audience</th>
                								<th>Growth</th>
                                                <th>Relative Growth</th>
                							
                							</tr>
                						</thead>
                                        ';
                                           $query = "SELECT `ra_id`, `p_id`, `ra_city`, `ra_local`, `ra_perc_local`, `ra_growth`, `ra_relative_growth`, `ra_week` FROM `rep_audience` WHERE `ra_week` = '$dateee' AND `p_id` = $proid";           
                                            $stmt = $db->query($query);
                                            while($row = $stmt->fetch_assoc()){
                                                $footer.='<tr><td><b>'.$row['ra_city'].'</b></td>
                										<td>'.$row['ra_local'].'</td> 
                										<td>'.$row['ra_perc_local'].'%</td>';
                                                    if($row['ra_growth'] > 0){
                                                        $footer.='<td><img src="assets/up.png" style="    width: 15px; margin-right: 5px;"/>+'.$row['ra_growth'].'</td>';
                                                    }
                                                    else{
                                                        $footer.='<td><img src="assets/down.png" style="    width: 15px; margin-right: 5px;"/>'.$row['ra_growth'].'</td>';
                                                    }
                                                     if($row['ra_relative_growth'] > 0){
                                                        $footer.='<td><img src="assets/up.png" style="    width: 15px; margin-right: 5px;"/>+'.$row['ra_relative_growth'].'</td>';
                                                    }
                                                    else{
                                                        $footer.='<td><img src="assets/down.png" style="    width: 15px; margin-right: 5px;"/>'.$row['ra_relative_growth'].'</td>';
                                                    }
                                            }   
                                                      
                                              $footer.='         
                                        
                                        </table>
                             </div>   </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                <script>

     

      var map, heatmap;

      function initMap() {
        map = new google.maps.Map(document.getElementById(\'map\'), {
          zoom: 6,
          center: {lat: 31.097560, lng: 71.169339}
         
        });
		

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map
        });
      }

      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          \'rgba(0, 255, 255, 0)\',
          \'rgba(0, 255, 255, 1)\',
          \'rgba(0, 191, 255, 1)\',
          \'rgba(0, 127, 255, 1)\',
          \'rgba(0, 63, 255, 1)\',
          \'rgba(0, 0, 255, 1)\',
          \'rgba(0, 0, 223, 1)\',
          \'rgba(0, 0, 191, 1)\',
          \'rgba(0, 0, 159, 1)\',
          \'rgba(0, 0, 127, 1)\',
          \'rgba(63, 0, 91, 1)\',
          \'rgba(127, 0, 63, 1)\',
          \'rgba(191, 0, 31, 1)\',
          \'rgba(255, 0, 0, 1)\'
        ]
        heatmap.set(\'gradient\', heatmap.get(\'gradient\') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set(\'radius\', heatmap.get(\'radius\') ? null : 20);
      }

      function changeOpacity() {
        heatmap.set(\'opacity\', heatmap.get(\'opacity\') ? null : 0.2);
      }

      // Heatmap data: 500 Points
      function getPoints() {
        return [';
        $query = "SELECT `ral_id`, `ral_lat`, `ral_long`, `p_id` FROM `rep_audience_location` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
            $lat = $row['ral_lat'];
            $long = $row['ral_long'];
            $footer.='new google.maps.LatLng('.$lat.','.$long.'),';
        }
          $footer.='new google.maps.LatLng('.$lat.','.$long.')';
        $footer.='];
      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC37RsJwhH4B9xvdkFE56ewh_QnPWKSohs&libraries=visualization&callback=initMap">
    </script>
    
    <!-- Export Modal -->
								<div id="exportModal" class="modal fade" tabindex="-1" data-width="760">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">Export Report</h4>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/aud.php\'">As Excel Sheet</button>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button id="close-popup" type="button" data-dismiss="modal" class="btn btn-default">Close</button>
									</div>
								</div>
                
                
                
                ';

echo $footer;
}


