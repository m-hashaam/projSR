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
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">


<title>Sweet Referrals | Reports</title>

<style>


#myownsidebar {
    position: fixed;
    top: 51px;
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
<script type="text/javascript" src="js/rightsidebar.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyBWpbaip-9o3QsORq6aer7lfHlpTNSTH7k"></script>
<script type="text/javascript" src="js/chroma.min.js"></script>
<script type="text/javascript" src="js/rep_something2.js"></script>
<style>
			  
			  
			  .controls {
				margin-top: 16px;
				border: 1px solid transparent;
				border-radius: 2px 0 0 2px;
				box-sizing: border-box;
				-moz-box-sizing: border-box;
				height: 32px;
				outline: none;
				box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			  }
              .invertcolor{
                	-webkit-filter:invert(80%);
                	filter:progid:DXImageTransform.Microsoft.BasicImage(invert=\'0.8\');
                	
                	  
                	
                	  
                }

			  #pac-input {
				background-color: #fff;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				margin-left: 12px;
				padding: 0 11px 0 13px;
				text-overflow: ellipsis;
				width: 400px;
			  }

			  #pac-input:focus {
				border-color: #4d90fe;
			  }

			  .pac-container {
				font-family: Roboto;
			  }

			  #type-selector {
				color: #fff;
				background-color: #4d90fe;
				padding: 5px 11px 0px 11px;
			  }

			  #type-selector label {
				font-family: Roboto;
				font-size: 13px;
				font-weight: 300;
			  }
			</style>



<link href="css/jquery-multi-step-form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/css">
<link rel="stylesheet" type="text/css" href="css/rightsidebar.css">
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

//include 'inc/top_menu.php';

echo '<div style="    height: 100%;" class="page-content"><div style="    height: 100%;" class="container-fluid"><div style="    height: 100%;" class="row"><div style="    height: 100%;" class="profile-content col-md-12 col-sm-12">';


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
    $query = "SELECT SUM(`reach`) AS treach,SUM(`socialindex`)/COUNT(`socialindex`) AS social, SUM(`sentiment`)/COUNT(`sentiment`) AS senti, SUM(`residents`) AS resi, SUM(`household`) AS house,SUM(`housewives`) AS hw,SUM(`employed`) AS empl, SUM(`businessmen`) AS busi, SUM(`unemployed`) AS unemp, SUM(`students`) AS stu FROM `rep_tempdata8_geoarea` WHERE 1";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $treach = $row['treach'];
        $social =  $row['social'];
        $senti =  $row['senti'];
        $resi =  $row['resi'];
        $house =  $row['house'];
        $top3 = array();
        $top3['House Wives'] = $row['hw'];
        $top3['Students'] = $row['stu'];
        $top3['Employed'] = $row['empl'];
        $top3['Unemployed'] = $row['unemp'];
        $top3['Businessmen'] = $row['busi'];
        asort($top3);
        $hw =  $row['hw'];
        $stu =  $row['stu'];
        $empl =  $row['empl'];
        $unemp =  $row['unemp'];
        $busi =  $row['busi'];
        $treach = number_format($treach,0);
        $social = number_format($social,0);
        $senti = number_format($senti,0);
        $resi = number_format($resi,0);
        $house = number_format($house,0);
        if($senti > 0){
            $senti.="% +ve";
        }
        else{
            $senti *= -1;
            $senti.="% -ve";
        }
    }
    else{
          $footer = '<div class="portlet-body">
                        <p style="text-align:center;">Either your product is not live or no reporting data is available</p>
                    </div>';
          exit();
    }
    
    
    
    
    $footer = '<div style="    height: 100%;" class="portlet-body">
                    <div style="    height: 100%;" id="myownparent">';
               
               echo $footer;
               include 'inc/rep_sidebar.php';
                        
						$footer.='<div style="    height: 100%;" id="myowncontent">
                               <div id="rightsidebarwrapper">
                            		<div id="sidebar-rightsidebarwrapper">
                            			<div onclick="sidebar()" id="sidebar-button">
                            			</div>
                                        <div class="sidebarheads">
                                            <h1>All Cities</h1>
                                        </div>
                                        
                                        <div class="sidebarrightloading hidemyclass">
                                            <img width="125" height="100" src="assets/spinner.gif" />
                                        </div>
                                        <div class="sidebarrightcontent">
                                            <div class="row">
                                                <select class="form-group">
                                                    <option value="1">Social Coverage</option>
                                                    <option value="2">Retail Overview</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img style="float: left; margin-left: 18%;" height="40" width="40" src="assets/contri.png">
                                                    <p style="float: left; margin-left: 3%; margin-top: 12%;" id="side_contri">100%</p>
                                                    <p style="    margin-top: 48px; margin-bottom: 18px;">Contribution</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <img style="float: left; margin-left: 18%;" height="40" width="40" src="assets/reachicon.png">
                                                    <p style="float: left; margin-left: 3%; margin-top: 12%;" id="side_reach">'.$treach.'</p>
                                                    <p style="    margin-top: 48px; margin-bottom: 18px;">Reach</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img style="float: left; margin-left: 18%;" height="40" width="40" src="assets/socialindex.png">
                                                    <p style="float: left; margin-left: 3%; margin-top: 12%;" id="side_social">'.$social.'</p>
                                                    <p style="    margin-top: 48px; margin-bottom: 18px;">Social Index</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <img style="float: left; margin-left: 18%;" height="40" width="40" src="assets/sentiment.jpg">
                                                    <p style="float: left; margin-left: 3%; margin-top: 12%;" id="side_sentiment">'.$senti.'</p>
                                                    <p style="    margin-top: 48px; margin-bottom: 18px;">Sentiment</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img style="float: left; margin-left: 18%;" height="40" width="40" src="assets/residents.jpg">
                                                    <p style="float: left; margin-left: 3%; margin-top: 12%;" id="side_resident">'.$resi.'</p>
                                                    <p style="    margin-top: 48px; margin-bottom: 18px;">Residents</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <img style="float: left; margin-left: 18%;" height="40" width="40" src="assets/household.png">
                                                    <p style="float: left; margin-left: 3%; margin-top: 12%;" id="side_household">'.$house.'</p>
                                                    <p style="    margin-top: 48px; margin-bottom: 18px;">HouseHolds</p>
                                                </div>
                                            </div>
                                            
                                            <hr>
                                            
                                             <div class="row">
                                                 <div class="col-md-6">
                                                    <div id="piechart" style="   width:180px; margin-left: -30px; height: 90px;"></div>
                                                 </div>
                                                 <div class="col-md-6">
                                                    <div id="chart_div" style=" width:200px;    margin-left: -55px; height: 90px;"></div>
                                                 </div>
                                             </div>
                                            
                                              <hr>
                                              
                                              <div class="row" style="  height: 100px;">
                                                    <div class="col-md-4">
                                                        <p  id="side_pro1name" style="margin-bottom: 0;">'.array_keys($top3)[4].'</p>
                                                        <h3 id="side_pro1val" style="margin: 0;">'.number_format($top3[array_keys($top3)[4]]).'</h3>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p  id="side_pro2name" style="margin-bottom: 0;">'.array_keys($top3)[3].'</p>
                                                        <h3 id="side_pro2val" style="margin: 0;">'.number_format($top3[array_keys($top3)[3]]).'</h3>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p  id="side_pro3name" style="margin-bottom: 0;">'.array_keys($top3)[2].'</p>
                                                        <h3 id="side_pro3val" style="margin: 0;">'.number_format($top3[array_keys($top3)[2]]).'</h3>
                                                    </div>
                                              </div>
                                        </div>
                            		</div>
                              
                               <input id="pac-input" class="controls" type="text" placeholder="Search Box">
						       <div style="left: 200px !important; right: 0px !important; top: 51px !important; bottom: 0px !important; position: fixed !important;">
                                <div style="width:100%; height:100%;" id="map-canvas" ></div>
                               </div>
                              </div>
                              
                              
                              
                          </div>
						  
						  </div>
                        
                        
                        
                        
                        
                        

                    
                </div>';

echo $footer;
}


