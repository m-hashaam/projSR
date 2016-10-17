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
<script type="text/javascript" src="js/metronic.js"></script>
<script type="text/javascript" src="js/layout.js"></script>
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
<script src="http://d3js.org/d3.v3.js"></script>



<link rel="stylesheet" href="css/jquery.range.css">


<link href="css/jquery-multi-step-form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/uniform.default.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
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
  <script src="js/jquery.range.js"></script>
 
  <script type="text/javascript" src="js/rep_something1.js"></script>
  <script type="text/javascript" src="js/rep_something1_onclicks.js"></script>
  <script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/ui-extended-modals.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-modal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal-bs3patch.css">
         

  <!-- use the font -->
  <style>
    body {
      font-family: \'Roboto\', sans-serif;
    }
  </style>
       
    </head>';
	
	echo $html;
	
	$html='<body style="    background: #fafafa; color: rgba(0, 0, 0, 0.65);" class=" page-header-menu-fixed  pace-done">
    <div id="backdull" style="    display: none; position: fixed; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(4, 4, 4, 0.67); z-index: 99999;"></div>
      <div id="aroundloading" style=" visibility: collapse; background-color: #EAEAEA; width: 100px; height: 100px; position: fixed; top: 50%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
    	<img id="loadingimg" src="assets/loading6.gif" style="   display: none;   padding-left: 20px; padding-top: 17px; z-index: 9999;">
      </div>
    <div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div class="pace-progress-inner"></div>
</div>

<div class="pace-activity"></div></div>

';
echo $html;

include 'inc/header.php';

include 'inc/sidebar.php';

echo '<div class="page-container">';

//include 'inc/top_menu.php';

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
    $daysRange = 7;
    $currentDate = '2016-10-08';
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
    
    
    $query = "SELECT `rt4_aspect`,SUM(`rt4_engg`) AS engg
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= '".$currentDate."' 
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                AND `rt4_product` = '$proid'
                GROUP BY `rt4_aspect`
                ORDER BY engg DESC";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $imp1_aspect = $row['rt4_aspect'];
        $imp1_engg = $row['engg'];
    }
    else{
          $footer = '<div class="portlet-body"> <p style="text-align:center;">Either your product is not live or no reporting data is available</p></div>';
          exit();
    }
    
    $query = "SELECT `rt4_aspect`,SUM(`rt4_engg`) AS engg
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                AND `rt4_aspect` = '".$imp1_aspect."'
                AND `rt4_product` = '$proid'";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $imp1_engg2 = $row['engg'];
        if($imp1_engg2 > $imp1_engg){
            $imp1_trend = "Down";
        }
        else{
            $imp1_trend = "Up";
            $imp1_perc = ($imp1_engg / $imp1_engg2)*100;
            $imp1_perc = number_format($imp1_perc,0);
        }
    }
    else{
          $footer = '<div class="portlet-body"> <p style="text-align:center;">Either your product is not live or no reporting data is available</p></div>';
          exit();
    }
    
    $query = "SELECT `rt5_topic`,SUM(`rt5_engg`) AS engg 
                FROM `rep_tempdata5` 
                WHERE `rt5_aspect` = '".$imp1_aspect."'
                AND `rt5_date` <= '".$currentDate."' 
                AND `rt5_date` >= DATE_ADD('".$currentDate."',INTERVAL -7 DAY)
                AND `rt5_product` = $proid
                GROUP BY `rt5_topic`
                ORDER BY engg DESC";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $imp2_topic =  $row['rt5_topic'];
        $imp2_engg =  $row['engg'];
    }
    
    $query = "SELECT `rt5_topic`,SUM(`rt5_engg`) AS engg 
                FROM `rep_tempdata5` 
                WHERE `rt5_aspect` = '".$imp1_aspect."'
                AND `rt5_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                AND `rt5_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                AND `rt5_product` = $proid
                AND `rt5_topic` = '".$imp2_topic."'";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $imp2_engg2 = $row['engg'];
        if($imp2_engg2 > $imp2_engg){
            $imp2_trend = "Down";
        }
        else{
            $imp2_trend = "Up";
            $imp2_perc = ($imp2_engg / $imp2_engg2)*100;
            $imp2_perc = number_format($imp2_perc,0);
        }
    }
    
    
    
    $query = "SELECT `rt4_aspect`,SUM(`rt4_engg`) AS engg
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= '".$currentDate."' 
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                AND `rt4_product` = '$proid'
                GROUP BY `rt4_aspect`
                ORDER BY engg";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $limp1_aspect = $row['rt4_aspect'];
        $limp1_engg = $row['engg'];
    }
    else{
          $footer = '<div class="portlet-body"> <p style="text-align:center;">Either your product is not live or no reporting data is available</p></div>';
          exit();
    }
    
    $query = "SELECT `rt4_aspect`,SUM(`rt4_engg`) AS engg
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                AND `rt4_aspect` = '".$limp1_aspect."'
                AND `rt4_product` = '$proid'";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $limp1_engg2 = $row['engg'];
        if($limp1_engg2 > $limp1_engg){
            $limp1_trend = "Down";
        }
        else{
            $limp1_trend = "Up";
            $limp1_perc = ($limp1_engg / $limp1_engg2)*100;
            $limp1_perc = number_format($limp1_perc,0);
        }
    }
    else{
          $footer = '<div class="portlet-body"> <p style="text-align:center;">Either your product is not live or no reporting data is available</p></div>';
          exit();
    }
    
    $query = "SELECT `rt5_topic`,SUM(`rt5_engg`) AS engg 
                FROM `rep_tempdata5` 
                WHERE `rt5_aspect` = '".$limp1_aspect."'
                AND `rt5_date` <= '".$currentDate."' 
                AND `rt5_date` >= DATE_ADD('".$currentDate."',INTERVAL -7 DAY)
                AND `rt5_product` = $proid
                GROUP BY `rt5_topic`
                ORDER BY engg";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $limp2_topic =  $row['rt5_topic'];
        $limp2_engg =  $row['engg'];
    }
    
    $query = "SELECT `rt5_topic`,SUM(`rt5_engg`) AS engg 
                FROM `rep_tempdata5` 
                WHERE `rt5_aspect` = '".$limp1_aspect."'
                AND `rt5_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                AND `rt5_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                AND `rt5_product` = $proid
                AND `rt5_topic` = '".$limp2_topic."'";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $limp2_engg2 = $row['engg'];
        if($limp2_engg2 > $limp2_engg){
            $limp2_trend = "Down";
        }
        else{
            $limp2_trend = "Up";
            $limp2_perc = ($limp2_engg / $limp2_engg2)*100;
            $limp2_perc = number_format($limp2_perc,0);
        }
    }
    
    
    $query = "SELECT SUM(`rt4_reach`) AS reachs 
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= '".$currentDate."' 
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                AND `rt4_product` = '$proid'";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $thereach =  $row['reachs'];
    }
    
    $query = "SELECT SUM(`rt6_conversion`) AS cons 
                FROM `rep_tempdata6` 
                WHERE `rt6_date` >= DATE_ADD('".$currentDate."',INTERVAL - $daysRange DAY)
                AND `rt6_date` <= '".$currentDate."' 
                AND `rt6_product` = $proid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $conv1 =  $row['cons'];
    }
    
    $query = "SELECT SUM(`rt6_conversion`) AS cons 
                FROM `rep_tempdata6` 
                WHERE `rt6_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                AND `rt6_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                AND `rt6_product` = $proid";
                //echo $query; 
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $conv2 = $row['cons'];
        if($conv2 > $conv1){
            $conv_trend = "Down";
        }
        else{
            $conv_trend = "Up";
            $conv_perc = ($conv1 / $conv2)*100;
            $conv1 = $conv1 / $thereach;
            $conv1 *= 100;
            $conv1 = number_format($conv1,0);
            $conv_perc = number_format($conv_perc,0);
        }
    }
    
    $qq = "SELECT `color`, `shade` FROM `colors` ORDER BY `color`";
    $ss = $db->query($qq);
    $rr = $ss->fetch_assoc();
    $color = $rr['color'];
    //echo "first color is ".$color;
    $query = "SELECT `rt_aspect`, SUM(`rt_mag`) AS tmag, SUM(`rt_effec`) AS teffec, SUM(`rt_reach`) AS treach FROM `rep_tempdata` WHERE `p_id` = $proid GROUP BY `rt_aspect`";
    $stmt = $db->query($query);
    $cnames = array();
    $ccolors = array();
    $aspectOptions = "";
    while($row = $stmt->fetch_assoc()){
        //echo "inside first query";
        while($color == $rr['color']){
            $rr = $ss->fetch_assoc();   
        }
        $cnames[] = $row['rt_aspect'];
        $aspectOptions.="<option value=\"".$row['rt_aspect']."\">".$row['rt_aspect']."</option>";
        $color = $rr['color'];
        $ccolors[] = $rr['color'];
    }
    
    $query = "SELECT distinct(`rt4_persona`) AS persona FROM `rep_tempdata4` WHERE 1";
    $stmt = $db->query($query);
    $personaOptions = "";
    while($row = $stmt->fetch_assoc()){
        $personaOptions.="<option value=\"".$row['persona']."\">".$row['persona']."</option>";
    }
    //echo "counnt of color is"
    $topFirstTR = "<tr>";
    $topSecTR = "<tr>";
    for($i=0 ; $i<count($ccolors) ; $i++){
        $topFirstTR .= "<td style\"    cursor: pointer;\"><div onclick=\"topClicked('".$cnames[$i]."')\" style=\"   margin-top:5px;     cursor: pointer; margin-left: auto; margin-right: auto;width:20px; height:20px; border-radius:25px !important; background:#".$ccolors[$i].";\"></div></td>";
        $topSecTR .= "<td onclick=\"topClicked('".$cnames[$i]."')\" style=\" margin-bottom:5px;    cursor: pointer;\"><p style=\"margin-top: 4px; margin-bottom: 4px;\">".$cnames[$i]."</p></td>";
    }
    $topFirstTR .= "<td style\"    cursor: pointer;\"><img onclick=\"topClicked('Reset')\" src=\"assets/reset.png\" style=\"  margin-top:5px; cursor: pointer;   margin-left: auto; margin-right: auto;width:20px; height:20px;\"></img></td>";
    $topSecTR .= "<td onclick=\"topClicked('Reset')\" style\"  margin-bottom:5px;  cursor: pointer;\"><p style=\"margin-top: 4px; margin-bottom: 4px;\">Reset</p></td>";
    $topFirstTR .= "</tr>";
    $topSecTR .= "</tr>";
    
    
    $footer = '<div class="portlet-body">
                    <div id="myownparent">';
               
               echo $footer;
               include 'inc/rep_sidebar.php';
                        
						$footer.='<div id="myowncontent">
                                  <div class="row">
                                  <div class="col-md-10 col-lg-10">
                                    <div class="row" style="  display:none;  margin-left: -15px;">
                                        <div class="toptable" style="     margin-top: 5px;
                                                                            width: 60%;
                                                                            align-items: right;
                                                                            align-content: center;
                                                                            float: right;
                                                                            margin-bottom: -6PX;
                                                                            border-bottom: 0px;">
                                            <table style="table-layout: fixed;
                                                            width: 100%;
                                                            text-align: center;
                                                            border: 1px solid #b8b8b8;
                                                            margin: 5px;
                                                            right: 0;
                                                            border-bottom: 0px;">
                                                '.$topFirstTR.'
                                                '.$topSecTR.'
                                            </table>
                                        </div>
                                    </div>
                               <div class="row">
                                    <div class="col-md-3 col-lg-3" style="   padding:0; overflow: hidden; text-align: center; color: grey;  0px;">
                                        <div class="mydabba" style=" height: 109px; " id="mostImpAspectDabba"> 
                                        
                                            <p style="margin-bottom: 0; margin-top:2%;font-size: 11px;text-align: left;margin-left: 3%;">Most Important Aspect</p>
                                            <h3 style="color: #2FB1C4; margin: 0;  font-size: 15px; font-weight: 500; text-align: left;margin-left: 3%;">'.$imp1_aspect.'</h3>
                                            <img style=" position: absolute; right: 11%; top: 17%;" height="10" width="13" src="assets/'; if($imp1_trend == "Up"){$footer.="up";}else{$footer.="down";}$footer.='.png"/>
                                            <p style=" font-size: 10px; position: absolute; right: 8%; top: 27%;" >'.$imp1_perc.'%</p>
                                            
                                            <hr style="       border-top: 1px solid #b8b8b8; margin:13px;">
                                             
                                             <p style="margin-bottom: 0;font-size: 11px;text-align: left;margin-left: 3%;">Most Important Topic</p>
                                             <img height="10" width="13" src="assets/'; if($imp2_trend == "Up"){$footer.="up";}else{$footer.="down";}$footer.='.png" style=" position: absolute; right: 11%; top: 63%;"/>
                                             <h3 style="color: #2FB1C4; margin: 0; margin-bottom:3%;   font-size: 15px; font-weight: 500; text-align: left;margin-left: 2%;">'.$imp2_topic.'</h3>
                                             <p style=" font-size: 10px; position: absolute; right: 8%; top: 71%;" >'.$imp2_perc.'%</p>
                                         </div>
                                        
                                    </div>
                                    <div class="col-md-3 col-lg-3" style="  padding:0; text-align: center; color: grey;">
                                         
                                         <div class="mydabba" style=" height: 109px; " id="leastImpAspectDabba"> 
                                             <p style="margin-bottom: 0; margin-top:2%;font-size: 11px;text-align: left;margin-left: 3%;">Least Important Aspect</p>
                                             <img height="10" width="13" src="assets/'; if($limp1_trend == "Up"){$footer.="up";}else{$footer.="down";}$footer.='.png" style=" position: absolute; right: 11%; top: 17%;"/>
                                             <h3 style="color: #9ECB2A; margin: 0;  font-size: 15px; font-weight: 500;  text-align: left;margin-left: 3%;">'.$limp1_aspect.'</h3>
                                             <p style=" font-size: 10px; position: absolute; right:8%; top: 27%;" >'.$limp1_perc.'%</p>
                                             
                                             <hr style="       border-top: 1px solid #b8b8b8; margin:13px;">
                                             
                                             <p style="margin-bottom: 0;font-size: 11px;text-align: left;margin-left: 3%;">Most Important Topic</p>
                                             <img height="10" width="13" src="assets/'; if($limp2_trend == "Up"){$footer.="up";}else{$footer.="down";}$footer.='.png" style=" position: absolute; right: 11%; top: 63%;"/>
                                             <h3 style="color: #9ECB2A; margin: 0;  margin-bottom:3%;   font-size: 15px; font-weight: 500;    text-align: left;margin-left: 2%;">'.$limp2_topic.'</h3>
                                             <p style="font-size: 10px; position: absolute; right: 8%; top: 71%;" >'.$limp2_perc.'%</p>
                                         </div>
                                         
                                    </div> 
                                    <div class="col-md-3 col-lg-3" style=" padding:0;  overflow: hidden; text-align: center; color: grey;">
                                        <div class="mydabba" style="height: 109px; " id="topConversionDabba"> 
                                            <div id="backdullconv" style="    display: none;    position: inherit; height: 100%; width: 100%; z-index: 99999;"></div>
                                              <div id="aroundloadingconv" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                            	<img id="loadingimgconv" src="assets/Loading1.gif" style="  width:100%;  display: none;  padding-top: 17px; z-index: 9999;">
                                              </div>
                                            <p style="    margin-bottom: 0;
                                                            text-align: center;
                                                            margin-top: 11px;
                                                            margin-left: 14px;
                                                            font-size: small;">Conversion Rate</p>
                                            <hr style="    border-top: 1px solid #b8b8b8;
                                                            /* margin: 13px; */
                                                            width: 131px;
                                                            margin-top: 2px;
                                                            margin-bottom: 1px;
                                                            margin-left: 39px">
                                            <h3 style="    color: #9958A5;
                                                            margin: 0;
                                                            float: left;
                                                            margin-top: 16px;
                                                            margin-left: 39px;">'.$conv1.'%</h3>
                                            <img style="    margin-top: 6%;
                                                            float: right;
                                                            margin-right: 43px;
                                                            width: 13px;
                                                            height: 10px;" height="10" width="13" src="assets/'; if($conv_trend == "Up"){$footer.="up";}else{$footer.="down";}$footer.='.png"/>
                                             <p style="    float: right;
                                                            margin-right: -24px;
                                                            font-size: 12px;
                                                            margin-top: 25px;">'.$conv_perc.'%</p> 
                                        </div>
                                    </div>  
                                    <div class="col-md-3 col-lg-3" style="  padding:0; overflow: hidden; text-align: center; color: grey; ">
                                        <div class="mydabba" style=" height: 109px;"> 
                                             <div id="backdullreach" style="    display: none;    position: inherit; height: 100%; width: 100%; z-index: 99999;"></div>
                                              <div id="aroundloadingreach" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                            	<img id="loadingimgreach" src="assets/Loading1.gif" style="  width:100%;  display: none;  padding-top: 17px; z-index: 9999;">
                                              </div>
                                             
                                             <p style="margin-bottom: 0;">Reach</p>
                                             <h3 id="reachval" style="color:  #2FB1C4; margin: 0;">'.number_format($thereach,0).'</h3>
                                             
                                             <div id="fourth" style="     width: 130%; margin-left: -15%; margin-top: 4.2%;height: 70px;"></div>
                                        </div>
                                    </div>       
                               </div>
                               <div class="row">
                                    <div class="col-md-6 col-lg-6 mydabbacol">
                                         
                                        
                                        <div class="mydabba">
                                            <div class="mydabbahead">
                                                <p><b>Persona Contribution</b></p>
                                                <img onclick="showModalHelp(\'Persona Contribution\',\'help\')" src="assets/infoi.png" height="15" width="15"/>
                                            </div>
                                            <div class="mydabbabody" style="height:320px;">
                                                <div id="backdulldonut" style="   margin-top: -45px; display: none;   position: inherit; height: 100%; width: 100%;   z-index: 99999;"></div>
                                                  <div id="aroundloadingdonut" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                                	<img id="loadingimgdonut" src="assets/Loading1.gif" style="   width:100%; display: none;  padding-top: 17px; z-index: 9999;">
                                                  </div>
                                                <div style="display:none;" id="code_hierarchy_legend">&nbsp;</div>
                                                <div style="margin-top:-45px;" id="code_hierarchy">&nbsp;</div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6 col-lg-6 mydabbacol" >
                                        <div class="mydabba">
                                            <div class="mydabbahead">
                                                <p><b id="impactheading">Aspect Impact</b></p>
                                                <img onclick="showModalHelp(\'Aspect Impact\',\'help\')" src="assets/infoi.png" height="15" width="15"/>
                                            </div>
                                            <div class="mydabbabody">
                                                <div id="backdullscatter" style="    display: none;  position: inherit; height: 100%; width: 100%;   z-index: 99999;"></div>
                                                  <div id="aroundloadingscatter" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                                	<img id="loadingimgscatter" src="assets/Loading1.gif" style="   width:100%; display: none;  padding-top: 17px; z-index: 9999;">
                                                  </div>
                                                <div id="scatter_dual_y" style="width: 100%; height: 250px; "></div>
                                            </div>
                                        </div>
                                    </div>     
                               </div>
                               
                               <div class="row">
                                    <div class="col-md-6 col-lg-6 mydabbacol">
                                         
                                        
                                        <div class="mydabba">
                                            <div class="mydabbahead">
                                                <p><b>Sentiment vs Conversion</b></p>
                                                <img onclick="showModalHelp(\'Sentiment vs Conversion\',\'help\')" src="assets/infoi.png" height="15" width="15"/>
                                            </div>
                                            <div class="mydabbabody">
                                                <div id="backdullarea" style="    display: none;   position: inherit; height: 100%; width: 100%; z-index: 99999;"></div>
                                                  <div id="aroundloadingarea" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                                	<img id="loadingimgarea" src="assets/Loading1.gif" style="  width:100%; display: none;  padding-top: 17px; z-index: 9999;">
                                                  </div>
                                                <div id="areachart" style="width: 100%; height: 250px;"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6 col-lg-6 mydabbacol" >
                                        <div class="mydabba">
                                            <div class="mydabbahead">
                                                <p><b>Table Topic Data</b></p>
                                                <img onclick="showModalHelp(\'Table Topic Data\',\'help\')" src="assets/infoi.png" height="15" width="15"/>
                                            </div>
                                            <div class="mydabbabody" style="    margin-bottom: -10px;" id="tableTopicDataBox">
                                                <div id="backdulltable" style="    display: none;   position: inherit; height: 100%; width: 100%;  z-index: 99999;"></div>
                                                  <div id="aroundloadingtable" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                                	<img id="loadingimgtable" src="assets/Loading1.gif" style="   width:100%; display: none;  padding-top: 17px; z-index: 9999;">
                                                  </div>
                                                <table style=" margin-top: 10px; width: 100% !important;" id="firstTable" class="table table-bordered  table-condensed">
                                                   <tr style="  height: 44px !important;  background: #fafafa;">
                                                        <td style="vertical-align: middle;"><b>Topic</b></td>
                                                        <td style="vertical-align: middle;"><b>Aspect</b></td>
                                                        <td style="vertical-align: middle;"><b>Engagement</b></td>
                                                        <td style="vertical-align: middle;"><b>Sentiment</b></td>
                                                        
                                                   </tr>
                                                    ';
                                                    echo $footer;
                                                    
                                                   
                                                        
                                                  
                                                    $query = "SELECT `rt5_aspect`, `rt5_topic`, SUM(`rt5_reach`) AS reachs, SUM(`rt5_engg`) AS engg, SUM(`rt5_senti`) AS senti 
                                                                FROM `rep_tempdata5` 
                                                                WHERE `rt5_product` = '$proid'
                                                                AND `rt5_date` <= '$currentDate'
                                                                AND `rt5_date` >= DATE_ADD('$currentDate',INTERVAL - $daysRange DAY)
                                                                GROUP BY `rt5_aspect`,`rt5_topic`
                                                                ORDER BY engg DESC limit 5";
                                                    $stmt = $db->query($query);
                                                 
                                                    while($row = $stmt->fetch_assoc()){
                                                      
                                                        
                                                        $ass = $row['rt5_aspect'];
                                                        $ass = str_replace(" ","-",$ass);
                                                        
                                                        $newq = "SELECT `rt5_aspect`, `rt5_topic`, SUM(`rt5_reach`) AS reachs, SUM(`rt5_engg`) AS engg, SUM(`rt5_senti`) AS senti 
                                                                FROM `rep_tempdata5` 
                                                                WHERE `rt5_product` = '$proid'
                                                                AND `rt5_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                                                                AND `rt5_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                                                                AND rt5_aspect = '".$row['rt5_aspect']."'
                                                                AND rt5_topic = '".$row['rt5_topic']."'";
                                                        $stmtnew = $db->query($newq);
                                                         if($rownew = $stmtnew->fetch_assoc()){
                                                            $secval = $rownew['senti'];
                                                            $firstval = $row['senti'];
                                                            if($secval > $firstval){
                                                                $trend = "down";
                                                                $trendval = ($firstval / $secval)*100;
                                                                if($trendval > 0){
                                                                    $trendval *= -1;
                                                                }
                                                                $trendval = number_format($trendval,0);
                                                            }
                                                            else{
                                                                $trend = "up";
                                                                $trendval = ($firstval / $secval)*100;
                                                                if($trendval < 0){
                                                                    $trendval *= -1;
                                                                }
                                                                $trendval = number_format($trendval,0);
                                                            }
                                                            
                                                            $secval = $rownew['engg'];
                                                            $firstval = $row['engg'];
                                                            if($secval > $firstval){
                                                                $etrend = "down";
                                                                $etrendval = ($firstval / $secval)*100;
                                                                if($etrendval > 0){
                                                                    $etrendval *= -1;
                                                                }
                                                                $etrendval = number_format($etrendval,0);
                                                            }
                                                            else{
                                                                $etrend = "up";
                                                                $etrendval = ($firstval / $secval)*100;
                                                                if($etrendval < 0){
                                                                    $etrendval *= -1;
                                                                }
                                                                $etrendval = number_format($etrendval,0);
                                                            }
                                                        }
                                                        else{
                                                            $trend = "";
                                                            $trendval = '-';
                                                        }
                                                        
                                                        $footer='<tr style="height: 44px !important;" class="'.$ass.' tabletr">
                                                                        <td style="vertical-align: middle;">'.$row['rt5_topic'].'</td>
                                                                        <td style="vertical-align: middle;">'.$row['rt5_aspect'].'</td>
                                                                        <td style="vertical-align: middle;"><p style="margin-bottom: 0;float: left; margin-top: 4px;">'.$row['engg'].'</p>
                                                                        <img style="    margin-top: 2px; float: right; margin-right: 5px;" height="10" width="13" src="assets/'.$etrend.'.png"/><p style="margin: 0; font-size: 10px;  float: right; margin-top: 13px; margin-right: -20px;">'.$etrendval.'%</p></td>
                                                                        <td style="vertical-align: middle;"><p style="margin-bottom: 0;float: left; margin-top: 4px;">'.$row['senti'].'</p>
                                                                        <img style="    margin-top: 2px; float: right; margin-right: 5px;" height="10" width="13" src="assets/'.$trend.'.png"/><p style="margin: 0; font-size: 10px;    float: right; margin-top: 13px; margin-right: -20px;">'.$trendval.'%</p></td>
                                                                        
                                                                </tr>';
                                                        echo $footer;
                                                       
                                                    }
                                                    $footer='
                                               </table>
                                            </div>
                                        </div>
                                    </div>     
                               </div>
                               
                              </div>
                              <div class="col-md-2 col-lg-2 mydabbacol">
                                    <div style="     margin-top: 12px;" class="mydabba">
                                            <div class="mydabbahead">
                                                <p><b>Filter</b></p>
                                                <img onclick="showModalHelp(\'Filter\',\'help\')" src="assets/infoi.png" height="15" width="15"/>
                                            </div>
                                            <div class="mydabbabody" style="    height: inherit;  margin-top: 5px; margin-bottom: 5px;">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="timeline">Timeline:</label>
                                                        <select style="    width: 80%;margin-left: auto;margin-right: auto;font-size: 10px;height: 28px;" class="form-control" id="timeline">
                                                            <option value="7">All</option>
                                                            <option value="7">Last 7 Days</option>
                                                            <option value="15">Last 15 Days</option>
                                                            <option value="30">Last 30 Days</option>
                                                            <option value="45">Last 45 Days</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="aspectf">Aspect:</label>
                                                        <select style="    width: 80%;margin-left: auto;margin-right: auto;font-size: 10px;height: 28px;" class="form-control" id="aspectf">
                                                            <option onchange="aspectChanged()" value="all">All</option>
                                                            '.$aspectOptions.'
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="aspectf">Persona:</label>
                                                        <select style="    width: 80%;margin-left: auto;margin-right: auto;font-size: 10px;height: 28px;" class="form-control" id="personaf">
                                                            <option value="all">All</option>
                                                            '.$personaOptions.'
                                                        </select>
                                                    </div>
                                                </form>
                                                
                                                <p style="margin-bottom: 0; display:none;">
                                                  <label style="margin-bottom: 0;" for="reach">Reach:</label>
                                                  <input type="text" id="reach" readonly style="border:0;     text-align: center; font-weight:bold;">
                                                </p>
                                                <div style=" width: 80%; margin-left: auto; margin-right: auto;" id="slider-reach"></div>
                                                
                                                <p style="margin-bottom: 0; display:none;    margin-top: 15px;">
                                                  <label style="margin-bottom: 0;" for="effect">Effectiveness:</label>
                                                  <input type="text" id="effect" readonly style="border:0;     text-align: center; font-weight:bold;">
                                                </p>
                                                <div style=" width: 80%; margin-left: auto; margin-right: auto;" id="slider-effect"></div>
                                                <button style="    margin-top: 14px; font-size: 12px;" type="button" class="btn blue" onclick="filter()">Apply Filter</button>
                                                <button style="    margin-top: 14px; font-size: 12px;" type="button" class="btn blue" onclick="clearfilter()">Clear Filter</button>
                                            </div>
                                    </div>
                                    <div class="mydabba" style="    margin-top: 20px !important;">
                                            <div class="mydabbahead">
                                                <p><b>Legend</b></p>
                                                <img onclick="showModalHelp(\'Legend\',\'help\')" style="      position: relative; float: right; right: 0px; top: -17px;" src="assets/infoi.png" height="15" width="15"/>
                                            </div>
                                            <div class="mydabbabody" style="    height: inherit; margin-left: 5%; text-align: left;  margin-top: 5px; margin-bottom: 5px;">
                                                <div id="legendtablediv" ></div>
                                            </div>
                                    </div>
                              </div>
                              
                            </div>
                              
                          </div>
                          
                          
						  
						  </div>
                        
                        
                      
                        <!-- Reset Password Modal -->
								<div id="resetpassModal" class="modal fade" tabindex="-1" data-width="760" style="display: block;  margin-left: -12% !important; margin-top: -10% !important; border-radius: 20px !important; height: 200px !important; width: 300px !important;">
									<div class="modal-header" style="text-align:center;">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title" id="modalhead"></h4>
									</div>
									<div class="modal-body" style="text-align:center;">
										<div class="row">
											<div class="col-md-12">
												<p id="modaltext"></p>
											</div>
										</div>
									</div>
								</div>
                        

                    
                </div>';

echo $footer;
}


