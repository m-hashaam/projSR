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
<script type="text/javascript" src="js/rep_overview.js"></script>



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
    $query = "SELECT `rmpv_id`, `p_id`, `rmpv_agg_con`, `rmpv_avg_change`, `rmpv_pro_rating`, `rmpv_res_city`, `rmpv_res_val`, `rmpv_avg_engagement`, `rmpv_total_engagement`, `rmpv_avg_response`, `rmpv_res_per_name`, `rmpv_res_per_val` FROM `rep_main_page_values` WHERE `p_id` = $proid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $agg_con = $row['rmpv_agg_con'];
        $avg_change =  $row['rmpv_avg_change'];
        $pro_rating =  $row['rmpv_pro_rating'];
        $res_city =  $row['rmpv_res_city'];
        $res_val =  $row['rmpv_res_val'];
        $total_engg =  $row['rmpv_total_engagement'];
        $avg_engg =  $row['rmpv_avg_engagement'];
        $res_per_val =  $row['rmpv_res_per_val'];
        $res_per_name =  $row['rmpv_res_per_name'];
        $avg_response =  $row['rmpv_avg_response'];
        
    }
    else{
          $footer = '<div class="portlet-body">
                        <p style="text-align:center;">Either your product is not live or no reporting data is available</p>
                    </div>';
          exit();
    }
    $query = "SELECT `rmf_id`, `p_id`, `rmf_first_name`, `rmf_first_val`, `rmf_others_val` FROM `rep_main_feedback` WHERE `p_id` = $proid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $first_name =  $row['rmf_first_name'];
        $first_val =  $row['rmf_first_val'];
    }
    else{
          $footer = '<div class="portlet-body">
                        <p style="text-align:center;">Either your product is not live or no reporting data is available</p>
                    </div>';
          exit();
    }
    
    $footer = '<div class="portlet-body">
                    <div id="myownparent">';
               
               echo $footer;
               include 'inc/rep_sidebar.php';
                        
						$footer.='<div id="myowncontent">
                        

                        <a class="hidden" data-toggle="modal" data-backdrop="static" id="category_button" href="#add_category"></a>

                                
                       
                          
                       
                            
                               
                               <div class="row">
                                    <div class="col-xs-4" style=" overflow: hidden;">
                                       <h3>Feedback on Product</h3>
                                       <div style="height:300px;">
                                           
                                           
                                            
                                            <div id="chart_div_main_6"></div>
                                            <p style="margin: 0px; text-align:center;">Most Responsive KPI</p>
                                            <p style="margin: 0px; text-align:center;">'.$first_name.' '.$first_val.'%</p>
                                        </div>
                                        <div id="chart_div_main_1" style=" width: 100%; overflow: hidden;     margin-bottom: 20px;"></div>
                                        <div style="float:left; width:50%; text-align:left;">
                                                <p style="margin: 0px;">Average change per day</p>
                                                <p style="margin: 0px;"><img src="assets/down.png" style="    width: 15px; margin-right: 5px;"/>'.$avg_change.'%</p>
                                           </div>
                                           <div style="float:right; width:50%; text-align:right;">
                                                <p style="margin: 0px;">Overall product rating</p>
                                                <p style="margin: 0px;"><img src="assets/heart.png" style="    width: 15px; margin-right: 5px;"/>'.$pro_rating.'%</p>
                                           </div>
                                    </div>
                                    <div class="col-xs-4" style=" overflow: hidden;">
                                      <h3>Customers Engaged</h3>
                                      
                                         <div style="height:300px;">
                                            
                                           <div style="width:50%; margin-left:auto; margin-right:auto; text-align:center;"><img src="assets/faisalm.png" style="   padding-top:15%; width: 100%;"/></div>
                                           <p style="margin: 0px; text-align:center;">Most Responsive City</p>
                                            <p style="margin: 0px; text-align:center;">'.number_format ($res_val).' engagement</p>
                                            <p style="margin: 0px; text-align:center;">'.$res_city.'</p>
                                        </div>
                                        <div id="chart_div_main_2" style=" width: 100%; overflow: hidden;    margin-bottom: 20px;"></div>
                                         <div style="float:left; width:50%; text-align:left;">
                                                <p style="margin: 0px;">Average engagement per day</p>
                                                <p style="margin: 0px;"><img src="assets/up.png" style="    width: 15px; margin-right: 5px;"/>'.number_format ($avg_engg).'</p>
                                           </div>
                                           <div style="float:right; width:50%; text-align:right;">
                                                <p style="margin: 0px;">Total Engagement</p>
                                                <p style="margin: 0px;">'.number_format ($total_engg).'</p>
                                           </div>
                                    </div>
                                    <div class="col-xs-4" style=" overflow: hidden;">
                                      <h3>Persona</h3>
                                      
                                         <div style="height:300px;">
                                            
                                           
                                            <h1 style="margin: 0px; text-align:center; padding-top: 40%; font-size: 50px; font-weight: 400; color: #18ff01;">'.$agg_con.'%</h1>
                                            <p style="margin: 0px; text-align:center;">Aggregated Conversion</p>
                                        </div>
                                        <div id="chart_div_main_3" style=" width: 100%; overflow: hidden;    margin-bottom: 20px;"></div>
                                         <div style="float:left; width:50%; text-align:left;">
                                                <p style="margin: 0px;">Average response rate</p>
                                                <p style="margin: 0px;"><img src="assets/up.png" style="    width: 15px; margin-right: 5px;"/>'.$avg_response.'%</p>
                                           </div>
                                           <div style="float:right; width:50%; text-align:right;">
                                                <p style="margin: 0px;">Most responsive persona</p>
                                                <p style="margin: 0px;">'.$res_per_name.'</p>
                                           </div>
                                    </div>
                                    
                              </div>
                              
                              
                              
                              
                          </div>
						  
						  </div>
                        
                        
                        
                        
                        
                        

                    
                </div>';

echo $footer;
}


