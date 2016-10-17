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


<title>Sweet Referrals | Reports</title>

<style>


 
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
<script type="text/javascript" src="js/reports.js"></script>



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
	
	$html='<body class=" page-header-menu-fixed  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
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
	$footer = '<div class="portlet-body">
                    <div class="tabbable tabs-left" id="tabs">
                        <ul class="nav nav-tabs">
                            
                            <li id="tab0">
                                <a href="#tab_overview" data-toggle="tab" aria-expanded="false">
                                    <span class="tab-heading">Overview</span>
                                </a>
                            </li>
                            
                            <li id="tab1"  onclick="drawChart2()">
                                <a href="#tab_general" data-toggle="tab" aria-expanded="false">
                                    <span class="tab-heading">KPIs</span>
                                </a>
                            </li>

                            <li id="tab2" onclick="drawChart()">
                                <a href="#tab_images" data-toggle="tab" aria-expanded="false">
                                    <span class="tab-heading">Performance</span>
                                </a>
                            </li>
                             <li id="tab3" onclick="drawChart3()">
                                 <a href="#tab_preview" data-toggle="tab" aria-expanded="false">
                                     <span class="tab-heading">Placement</span>
                                 </a>
                             </li>
                              <li id="tab4" onclick="drawChart4()">
                                 <a href="#tab_fourth" data-toggle="tab" aria-expanded="false">
                                     <span class="tab-heading">Audience</span>
                                 </a>
                             </li>
                              <li id="tab5" >
                                 <a href="#tab_loyalty" data-toggle="tab" aria-expanded="false">
                                     <span class="tab-heading">Loyalty Labs</span>
                                 </a>
                             </li>
                        </ul>

                        <a class="hidden" data-toggle="modal" data-backdrop="static" id="category_button" href="#add_category"></a>

                                
                        <div class="tab-content">
                        
                        <div class="tab-pane" id="tab_overview">
                            
                               
                               <div class="row">
                                    <div class="col-xs-3" style=" width: 20%; overflow: hidden;">
                                       <h3>Feedback on Product</h3>
                                       <div id="chart_div_main_1" style=" width: 100%; overflow: hidden;     margin-left: -15%;"></div>
                                       <div style="float:left; width:50%; text-align:left;">
                                            <p style="margin: 0px;">Average change per day</p>
                                            <p style="margin: 0px;"><img src="assets/down.png" style="    width: 15px; margin-right: 5px;"/>22%</p>
                                       </div>
                                       <div style="float:right; width:50%; text-align:right;">
                                            <p style="margin: 0px;">Overall product rating</p>
                                            <p style="margin: 0px;"><img src="assets/heart.png" style="    width: 15px; margin-right: 5px;"/>33%</p>
                                       </div>
                                       
                                        <div id="chart_div_main_4" style=" width: 100%; overflow: hidden;   padding-top:40px;  margin-left: -15%;"></div>
                                        <p style="margin: 0px; text-align:center;">Most Responsive KPI</p>
                                        <p style="margin: 0px; text-align:center;">Color 63%</p>
                                    
                                    </div>
                                    <div class="col-xs-3" style=" width: 20%; overflow: hidden;">
                                      <h3>Customers Engaged</h3>
                                      <div id="chart_div_main_2" style=" width: 100%; overflow: hidden;    margin-left: -15%;"></div>
                                         <div style="float:left; width:50%; text-align:left;">
                                            <p style="margin: 0px;">Average engagement per day</p>
                                            <p style="margin: 0px;"><img src="assets/up.png" style="    width: 15px; margin-right: 5px;"/>3,400</p>
                                       </div>
                                       <div style="float:right; width:50%; text-align:right;">
                                            <p style="margin: 0px;">Total Engagement</p>
                                            <p style="margin: 0px;">61,857</p>
                                       </div>
                                       <div style="width:50%; margin-left:auto; margin-right:auto; text-align:center;"><img src="assets/faisalm.png" style="    width: 100%;"/></div>
                                       <p style="margin: 0px; text-align:center;">Most Responsive City</p>
                                        <p style="margin: 0px; text-align:center;">68,173 engagement</p>
                                        <p style="margin: 0px; text-align:center;">Islamabad</p>
                                    </div>
                                    <div class="col-xs-3" style=" width: 20%; overflow: hidden;">
                                      <h3>Persona</h3>
                                      <div id="chart_div_main_3" style=" width: 100%; overflow: hidden;    margin-left: -15%;"></div>
                                         <div style="float:left; width:50%; text-align:left;">
                                            <p style="margin: 0px;">Average respnse rate</p>
                                            <p style="margin: 0px;"><img src="assets/up.png" style="    width: 15px; margin-right: 5px;"/>63%</p>
                                       </div>
                                       <div style="float:right; width:50%; text-align:right;">
                                            <p style="margin: 0px;">Most responsive persona</p>
                                            <p style="margin: 0px;">Men 18-24</p>
                                       </div>
                                       
                                        <h1 style="margin: 0px; text-align:center; padding-top: 90px; font-size: 50px;">64%</h1>
                                        <p style="margin: 0px; text-align:center;">Highest Conversion</p>
                                    </div>
                                     <div class="col-xs-3" style=" width: 20%; overflow: hidden;">
                                      <h3>Distribution of Interaction</h3>
                                      <div style=" width: 100%; text-align: center; padding: 0px; border: 1px solid rgba(0, 0, 0, 0.27);">
                                        <p style="    margin-bottom: 0px;"><b>Sampled</b></p>
                                        <p style="    margin-top: 0px;">5638 | 84.6%</p>
                                        <p style="    margin-bottom: 0px;"><b>Called</b></p>
                                        <p style="    margin-top: 0px;">364 | 14%</p>
                                        <p style="    margin-bottom: 0px;"><b>Referred</b></p>
                                        <p style="    margin-top: 0px;">434 | 15%</p>
                                      </div>
                                      
                                      <h2 style="margin: 0px; text-align:center;  padding-top: 110px;font-size: 40px;">3,247</h2>
                                        <p style="margin: 0px; text-align:center;">Sampled Items</p>
                                        
                                    </div>
                              </div>
                              
                              
                              
                              
                          
                        </div>
                        
                        
                        <div class="tab-pane" id="tab_general">
                            <div class="form-body">
                                <button class="product-sticker page-quick-sidebar-toggler side-panel-padding nav-products-truncate tour-compatible" style="left:0; right:inherit;     border-top-right-radius: 45px !important;   border-bottom-left-radius: 0px !important; border-top-left-radius: 0px !important;  border-bottom-right-radius: 45px !important;" onclick="location.href=\'export/export/home.php\'">
                                	<i class="fa fa-bars fa-2x font-white"></i> Export
                                </button>
                                <div class="row">
                                    <div id="columnchart_material" style="width: 100%; padding-top: 20px;padding-left: 15%;background-color: white; "></div>
                                    <div id="dabba4" style="    padding-right: 10px;color: #75758A; position: fixed; top: 26%; right: 0; padding-top: 5px; padding-left: 5px;border: 1px solid rgba(56, 36, 36, 0.48);"><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;"><b>67%</b></p><p style="font-size: small; padding-left: 5px;"><b>Persona Accuracy</b></p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">88%</p><p style="font-size: small; padding-left: 5px;">KPI placement</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">648,671</p><p style="font-size: small; padding-left: 5px;">Responses</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">0.3</p><p style="font-size: small; padding-left: 5px;">CPA</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">0.05</p><p style="font-size: small; padding-left: 5px;">CPM</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">74,400</p><p style="font-size: small; padding-left: 5px;">Frequency</p></div>
                                    <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                								<th>KPI</th>
                								<th>Taste</th>
                								<th>Color</th>
                								<th>Spice</th>
                							
                							</tr>
                						</thead>
                                        
                                                    <tr>
                										<td><b>Positive</b></td>
                										<td>60</td> 
                										<td>40</td>
                										<td>40</td>
                									  </tr>
                                                      <tr>
                										<td><b>Negative</b></td>
                										<td>30</td> 
                										<td>50</td>
                										<td>10</td>
                									  </tr>
                                                       <tr>
                										<td><b>Neutral</b></td>
                										<td>10</td> 
                										<td>10</td>
                										<td>50</td>
                									  </tr>
                                        
                                        </table>
                                </div>
                           </div>
                        </div>

						<div class="tab-pane" id="tab_images">
                           <div class="form-body">
                          <button class="product-sticker page-quick-sidebar-toggler side-panel-padding nav-products-truncate tour-compatible" style="left:0; right:inherit;     border-top-right-radius: 45px !important;   border-bottom-left-radius: 0px !important; border-top-left-radius: 0px !important;  border-bottom-right-radius: 45px !important;" onclick="location.href=\'export/export/performance.php\'">
                                	<i class="fa fa-bars fa-2x font-white"></i> Export
                                </button>
                            <div class="row">
                             <div id="linechart_material" style="width: 100%; padding-top: 20px;padding-left: 15%;background-color: white;"></div>
                                <div id="dabba3" style="    padding-right: 10px;color: #75758A; position: fixed; top: 26%; right: 0; padding-top: 5px; padding-left: 5px;border: 1px solid rgba(56, 36, 36, 0.48);"><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;"><b>72%</b></p><p style="font-size: small; padding-left: 5px;"><b>Response Rate</b></p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">1,123,651</p><p style="font-size: small; padding-left: 5px;">Organic Reach</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">550</p><p style="font-size: small; padding-left: 5px;">Samples</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">88%</p><p style="font-size: small; padding-left: 5px;">Brand Awareness</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">86,000</p><p style="font-size: small; padding-left: 5px;">Event Responses</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">744</p><p style="font-size: small; padding-left: 5px;">Offers Claimed</p></div>
                                <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                								<th>Performance</th>
                								<th>Response Rate</th>
                								<th>Organic Reach</th>
                								<th>Samples Requested</th>
                								<th>Reach</th>
                							</tr>
                						</thead>
                                      
                                        
                                                    <tr>
                										<td><b>15 Feb</b></td>
                										<td>37180</td> 
                										<td>53508</td>
                										<td>41812</td>
                                                        <td>42412</td>
                									  </tr>
                                                      <tr>
                										<td><b>17 Feb</b></td>
                										<td>30190</td> 
                										<td>62805</td>
                										<td>32413</td>
                                                        <td>52534</td>
                									  </tr>
                                                      <tr>
                										<td><b>19 Feb</b></td>
                										<td>37180</td> 
                										<td>53508</td>
                										<td>41812</td>
                                                        <td>42412</td>
                									  </tr>
                                                      <tr>
                										<td><b>21 Feb</b></td>
                										<td>30190</td> 
                										<td>62805</td>
                										<td>32413</td>
                                                        <td>52534</td>
                									  </tr>
                                                      <tr>
                										<td><b>23 Feb</b></td>
                										<td>37180</td> 
                										<td>53508</td>
                										<td>41812</td>
                                                        <td>42412</td>
                									  </tr>
                                                      <tr>
                										<td><b>25 Feb</b></td>
                										<td>30190</td> 
                										<td>62805</td>
                										<td>32413</td>
                                                        <td>52534</td>
                									  </tr>
                                                      <tr>
                										<td><b>27 Feb</b></td>
                										<td>37180</td> 
                										<td>53508</td>
                										<td>41812</td>
                                                        <td>42412</td>
                									  </tr>
                                                      <tr>
                										<td><b>29 Feb</b></td>
                										<td>30190</td> 
                										<td>62805</td>
                										<td>32413</td>
                                                        <td>52534</td>
                									  </tr>
                                                      <tr>
                										<td><b>2 Mar</b></td>
                										<td>30190</td> 
                										<td>62805</td>
                										<td>32413</td>
                                                        <td>52534</td>
                									  </tr>
                                                      <tr>
                										<td><b>4 Mar</b></td>
                										<td>30190</td> 
                										<td>62805</td>
                										<td>32413</td>
                                                        <td>52534</td>
                									  </tr>
                                        
                                        </table>
                            </div>
                           </div>
                        </div>

						<div class="tab-pane" id="tab_preview">
                                <div class="form-body">
                                <button class="product-sticker page-quick-sidebar-toggler side-panel-padding nav-products-truncate tour-compatible" style="left:0; right:inherit;     border-top-right-radius: 45px !important;   border-bottom-left-radius: 0px !important; border-top-left-radius: 0px !important;  border-bottom-right-radius: 45px !important;" onclick="location.href=\'export/export/placement.php\'">
                                	<i class="fa fa-bars fa-2x font-white"></i> Export
                                </button>
                                    <div class="row">
                                     <div id="linechart_material_2" style="width: 100%; padding-top: 20px;padding-left: 15%;background-color: white;"></div>
                                     <div id="dabba2" style="    padding-right: 10px;color: #75758A; position: fixed; top: 26%; right: 0; padding-top: 5px; padding-left: 5px;border: 1px solid rgba(56, 36, 36, 0.48);"><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;"><b>7.4</b></p><p style="font-size: small; padding-left: 5px;"><b>Network Penetration</b></p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">64%</p><p style="font-size: small; padding-left: 5px;">Direct Traffic</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">75%</p><p style="font-size: small; padding-left: 5px;">Unique Views</p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">71%</p><p style="font-size: small; padding-left: 5px;">Conversion Probability</p></div>
                                     <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                								<th>Placement</th>
                								<th>Direct Traffic</th>
                								<th>Facebook</th>
                								<th>Twitter</th>
                								<th>Instagram</th>
                							</tr>
                						</thead>
                                      
                                        
                                                    <tr>
                										<td><b>15 Feb</b></td>
                										<td>37K</td> 
                										<td>53K</td>
                										<td>41K</td>
                                                        <td>42K</td>
                									  </tr>
                                                      <tr>
                										<td><b>17 Feb</b></td>
                										<td>30K</td> 
                										<td>62K</td>
                										<td>32K</td>
                                                        <td>52K</td>
                									  </tr>
                                                      <tr>
                										<td><b>19 Feb</b></td>
                										<td>37K</td> 
                										<td>53K</td>
                										<td>41K</td>
                                                        <td>42K</td>
                									  </tr>
                                                      <tr>
                										<td><b>21 Feb</b></td>
                										<td>30K</td> 
                										<td>62K</td>
                										<td>32K</td>
                                                        <td>52K</td>
                									  </tr>
                                                      <tr>
                										<td><b>23 Feb</b></td>
                										<td>37K</td> 
                										<td>53K</td>
                										<td>41K</td>
                                                        <td>42K</td>
                									  </tr>
                                                      <tr>
                										<td><b>25 Feb</b></td>
                										<td>30K</td> 
                										<td>62K</td>
                										<td>32K</td>
                                                        <td>52K</td>
                									  </tr>
                                                      <tr>
                										<td><b>27 Feb</b></td>
                										<td>37K</td> 
                										<td>53K</td>
                										<td>41K</td>
                                                        <td>42K</td>
                									  </tr>
                                                      <tr>
                										<td><b>29 Feb</b></td>
                										<td>30K</td> 
                										<td>62K</td>
                										<td>32K</td>
                                                        <td>52K</td>
                									  </tr>
                                                      <tr>
                										<td><b>2 Mar</b></td>
                										<td>30K</td> 
                										<td>62K</td>
                										<td>32K</td>
                                                        <td>52K</td>
                									  </tr>
                                                      <tr>
                										<td><b>4 Mar</b></td>
                										<td>30K</td> 
                										<td>62K</td>
                										<td>32K</td>
                                                        <td>52K</td>
                									  </tr>
                                        
                                        </table>
                                    </div>
                                   </div>
                            </div>
                            
                            
                        	<div class="tab-pane" id="tab_fourth">
                                <div class="form-body">
                                <div class="row">
                                    <div id="columnchart_material_4" style="width: 100%; padding-top: 20px;padding-left: 15%;background-color: white;"></div>
                                    <div id="dabba" style="    padding-right: 10px;color: #75758A; position: fixed; top: 26%; right: 0; padding-top: 5px; padding-left: 5px;border: 1px solid rgba(56, 36, 36, 0.48);"><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;"><b>21%</b></p><p style="font-size: small; padding-left: 5px;"><b>Females (24 - 35)</b></p><p style="font-size: larger; padding-left: 5px; margin-bottom: 0px;">36%</p><p style="font-size: small; padding-left: 5px;">Lahore</p></div>
                                </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="tab_loyalty">
                                <div id="svgdiv" style="text-align: center;"></div>
                                <script>
 
                                var width = 720,
                                height = 720,
                                outerRadius = Math.min(width, height) / 2 - 10,
                                innerRadius = outerRadius - 24;
                                 
                                var formatPercent = d3.format(".1%");
                                 
                                var arc = d3.svg.arc()
                                .innerRadius(innerRadius)
                                .outerRadius(outerRadius);
                                 
                                var layout = d3.layout.chord()
                                .padding(.04)
                                .sortSubgroups(d3.descending)
                                .sortChords(d3.ascending);
                                 
                                var path = d3.svg.chord()
                                .radius(innerRadius);
                                 
                                var svg = d3.select("#svgdiv").append("svg")
                                .attr("width", width)
                                .attr("height", height)
                                .append("g")
                                .attr("id", "circle")
                                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
                                 
                                svg.append("circle")
                                .attr("r", outerRadius);
                                 
                                d3.csv("teams.csv", function(cities) {
                                d3.json("matrix.json", function(matrix) {
                                 
                                // Compute the chord layout.
                                layout.matrix(matrix);
                                 
                                // Add a group per neighborhood.
                                var group = svg.selectAll(".group")
                                .data(layout.groups)
                                .enter().append("g")
                                .attr("class", "group")
                                .on("mouseover", mouseover);
                                 
                                // Add a mouseover title.
                                 group.append("title").text(function(d, i) {
                                 return cities[i].name;
                                 });
                                 
                                // Add the group arc.
                                var groupPath = group.append("path")
                                .attr("id", function(d, i) { return "group" + i; })
                                .attr("d", arc)
                                //.style("fill", "url(#img1)");
                                .style("fill", function(d, i) { return cities[i].color; });
                                 
                                 
                                // Add a text label.
                                var groupText = group.append("text")
                                .attr("x", 6)
                                .attr("dy", 15);
                                 
                                groupText.append("textPath")
                                .attr("xlink:href", function(d, i) { return "#group" + i; })
                                .text(function(d, i) { return cities[i].name; });
                                 
                                // Remove the labels that don\'t fit. :(
                                groupText.filter(function(d, i) { return groupPath[0][i].getTotalLength() / 2 - 16 < this.getComputedTextLength(); })
                                .remove();
                                 
                                // Add the chords.
                                var chord = svg.selectAll(".chord")
                                .data(layout.chords)
                                .enter().append("path")
                                .attr("class", "chord")
                                .style("fill", function(d) { return cities[d.source.index].color; })
                                .attr("d", path);
                                 
                                // Add an elaborate mouseover title for each chord.
                                 chord.append("title").text(function(d) {
                                 return cities[d.source.index].name
                                 + " ? " + cities[d.target.index].name
                                 + ": " + formatPercent(d.source.value)
                                 + "\n" + cities[d.target.index].name
                                 + " ? " + cities[d.source.index].name
                                 + ": " + formatPercent(d.target.value);
                                 });
                                 
                                function mouseover(d, i) {
                                chord.classed("fade", function(p) {
                                return p.source.index != i
                                && p.target.index != i;
                                });
                                }
                                });
                                });
                                 
                               
                                </script>
                            </div>
                        
                        </div>

                    </div>
                </div>';

echo $footer;
}


