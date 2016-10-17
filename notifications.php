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
if(!($_SESSION['user_type'] == "Admin" || $_SESSION['user_type'] == "Normal")){
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


<title>Notifications</title>



<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

 <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

<script type="text/javascript" async="" src="js/"></script>
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



	<style>
			  #map-canvas {
				width: 100%;
				height: 400px;
			  }
			  
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
      
	  
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        
             
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
       
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
        compaignContent($pname);
    }
    
}
else{
     compaignContent($pname);
}


echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function compaignContent($pname){
	include 'database/db.php';
    $footer =     " ";
                        
    
       $myuserid = -1;
        $colName = "";
        if(isset($_SESSION['sub_idSR'])){
            $myuserid = $_SESSION['sub_idSR'];
            $colName = '`su_id`';   
        }
        else{
            $myuserid = $_SESSION['idSR'];
            $colName = '`u_id`';
        }
        
        $query = "SELECT `n_id`, `u_id`, `su_id`, `n_text`, `n_link`, `n_icon`, `n_createdon`,`n_isread`,
                    TIME_TO_SEC(TIMEDIFF(NOW(), `n_createdon`)) seconds
                    FROM `notifications` WHERE $colName = $myuserid ORDER BY `n_createdon` desc";
                   // echo $query;
        $stmt = $db->query($query);
        $notHTML = "";
        $notCount = 0;
        while($row = $stmt->fetch_assoc()){
            $notCount++;
            $sec = $row['seconds'];
            $secText ="";
            if($sec < 60){
                $sec = number_format($sec);
                $secText = "$sec Second(s) Ago";
            }
            else{
                $sec /= 60;
                if($sec < 60){
                    $sec = number_format($sec);
                    $secText = "$sec Minute(s) Ago";
                }
                else{
                    $sec/=60;
                    if($sec < 24){
                        $sec = number_format($sec);
                        $secText = "$sec Hour(s) Ago";
                    }
                    else{
                        $sec/=24;
                        $sec = number_format($sec);
                        $secText = "$sec Day(s) Ago";
                    }
                }
            }
            
            $backcolor = "#f0f0f0";
            if($row['n_isread'] == 1 OR $row['n_isread'] == "1"){
                $backcolor = "#ffffff";
            }
            $notHTML .= '
                    <tr style="cursor:pointer;  background:'.$backcolor.'" onclick="openNotification('.$row['n_id'].')">
                        <td style="text-align:center;" ><img height="30" width="30" src="'.$row['n_icon'].'" ></img></td>
                        <td>'.$row['n_text'].'</td>
                        <td>'.$secText.'</td>
                    </tr>
           ';
        }
       
       
    $footer.=' <table class="classictable dabba table table-striped" style="width: 80%;  margin-left: 10%; margin-right: 10%; margin-top: 30px;">
                						<thead class="table-head">
                							<tr>
                								<th>Picture</th>
                                                <th>Text</th>
                                                <th>Time</th>
                							</tr>
                						</thead>';
                                        
       
          
           $footer.=$notHTML;
          
          
                                                       
                                        
                                        $footer.='</table>';

echo $footer;
}


