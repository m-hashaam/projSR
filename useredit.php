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
if($_SESSION['user_type'] != "Admin"){
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


<title>Sweet Referrals</title>



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
<script type="text/javascript" src="js/useredit.js"></script>


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

if(isset($_GET['userid'])){
    $userrid = $_GET['userid'];
    $query = "SELECT `su_job` FROM `sub_user` WHERE `u_id` = $userid AND `su_id` = $userrid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        compaignContent($pname);
    }
    else{
        displayEror('You do not have permission to edit this user');
    }
}
else{
    displayEror('Please specify a user');
}


echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';

$db->close();


function compaignContent($pname){
    
    include 'database/db.php';
    $proid = $_SESSION['CurrentProductID'];
    $userid = $_SESSION['idSR'];
    $userrid = $_GET['userid'];
    $_SESSION['temp_userid'] = $userrid;
    $query = "SELECT `su_id`, `su_email`, `su_password`, `su_type`, `su_first_name`, `su_last_name`, `su_login_attempts`, `su_islocked`, `u_id`, `su_mobile`, `su_job` FROM `sub_user` WHERE `u_id` = $userid AND `su_id` = $userrid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
    	$email = $row['su_email'];
    	$fname = $row['su_first_name'];
        $lname = $row['su_last_name'];
        $mob = $row['su_mobile'];
        $job = $row['su_job'];
        $type = $row['su_type'];
    }
    else{
        $email = "";
    	$fname = "";
        $lname = "";
        $mob = "";
        $job = "";
    }
   
	$footer = '<div class="page-container">
            <div class="page-head">
                <div class="container-fluid">
                    <div class="page-title margin-left-25">
                        <h1>Manage User Accounts
<small>Edit User Accounts</small>
</h1>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                  
                    <div class="row margin-top-10">
                        
                        <div class="profile-content col-md-12 col-sm-12">
                            <div class="portlet light" style="    width: 60%;  margin-left: auto; margin-right: auto;">

                                <!-- ======================= PAGE PROFILE CONTENT START ======================= -->
                               
<div class="portlet-body">
    
            <form role="form" action="edituser.php" id="form_sample_2" novalidate="novalidate">
                <div class="form-group field-div has-success">
                    <label class="control-label">First Name <span class="required" aria-required="true">* </span></label>
                    <div class="input-icon right">
                        
                        <input type="text" placeholder="John"  value="'.$fname.'" class="form-control" name="fname" id="fname" aria-required="true" aria-describedby="firstName-error">
                    </div>
                </div>
                <div class="form-group field-div has-success">
                    <label class="control-label">Last Name <span class="required" aria-required="true">* </span></label>
                    <div class="input-icon right">
                        
                        <input type="text" placeholder="Doe" value="'.$lname.'" class="form-control" name="lname" id="lname" aria-required="true" aria-describedby="lastName-error">
                    </div>
                </div>lname
                <div class="form-group">
                    <label class="control-label">Mobile Number</label>
                    <div class="input-icon right">
                        
                        <input type="text" placeholder="xxx-xxx-xxxx" value="'.$mob.'" class="form-control" name="mob" id="mobile">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Job Title</label>
                    <div class="input-icon right">
                        
                        <input type="text" placeholder="Brand Manager" value="'.$job.'" class="form-control" name="job" id="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <div class="input-icon right">
                       
                        <input type="email" placeholder="xxx@xx.xx" value="'.$email.'" class="form-control" name="new_email" id="email">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Type</label>
                    <div class="input-icon right">
                        <select type="text" id="user_type" class="form-control input-lg" name="user_type"  placeholder="User Type">
                            ';
                            if($type == "Admin"){
                                $footer.='
                                 <option value="Admin" >Admin - All Access, Can add edit or remove users</option>
                                <option value="Normal" >Normal - All Access but cannot add edit or remove users</option>
                                <option value="Editor" >Editor - Can edit product info, create compaign and view reports</option>
                                <option value="Pawn" >Pawn - Can only view reports</option>';
                            }
                            else if($type == "Editor"){
                                $footer.='
                                 <option value="Editor" >Editor - Can edit product info, create compaign and view reports</option>
                                 <option value="Admin" >Admin - All Access, Can add edit or remove users</option>
                                <option value="Normal" >Normal - All Access but cannot add edit or remove users</option>
                                
                                <option value="Pawn" >Pawn - Can only view reports</option>';
                            }
                            else if($type == "Normal"){
                                $footer.='
                                <option value="Normal" >Normal - All Access but cannot add edit or remove users</option>
                                 <option value="Admin" >Admin - All Access, Can add edit or remove users</option>
                                
                                <option value="Editor" >Editor - Can edit product info, create compaign and view reports</option>
                                <option value="Pawn" >Pawn - Can only view reports</option>
                                ';
                            }
                            else if($type == "Pawn"){
                                $footer.='
                                <option value="Pawn" >Pawn - Can only view reports</option>
                                <option value="Normal" >Normal - All Access but cannot add edit or remove users</option>
                                 <option value="Admin" >Admin - All Access, Can add edit or remove users</option>
                                
                                <option value="Editor" >Editor - Can edit product info, create compaign and view reports</option>
                                
                                ';
                            }
                            
                        $footer.='</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <div class="input-icon right">
                        
                        <input type="password" placeholder="Leave empty if you don\'t want to change" class="form-control" name="new_password" id="newpassword">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="input-icon right">
                        
                        <input type="password" placeholder="Leave empty if you don\'t want to change" class="form-control" name="new_cof_password" id="newconpassword">
                    </div>
                </div>
               
            </form>
            <div class="row">
            <div class="margin-top-10 col-md-2" id="save_changes_popover" data-toggle="popover" data-placement="right" data-content="Please fill the required fields to enable this option." data-original-title="" title="">
                <button id="save_changes" class="btn btn-lg green-jungle rounded-4" onclick="saveChanges()">
                    Edit User
                </button>
            </div>
            </div>
        </div>
      

                                <!-- ======================== PAGE PROFILE CONTENT END ======================== -->

                            </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>';
 $db->close();
    echo $footer;
}

function displayEror($error){
    
    
   
	$footer = '<div class="page-container">
            <div class="page-head">
                <div class="container-fluid">
                    <div class="page-title margin-left-25">
                        <h1>Manage User Accounts
<small>Add or Remove User Accounts</small>
</h1>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                  
                    <div class="row margin-top-10">
                        
                        <div class="profile-content col-md-12 col-sm-12">
                            <div class="portlet light" style="    width: 60%;  margin-left: auto; margin-right: auto;">

                                <!-- ======================= PAGE PROFILE CONTENT START ======================= -->
                               
<div class="portlet-body">
    
            
           '.$error.'
            
            </div>
        </div>
      

                                <!-- ======================== PAGE PROFILE CONTENT END ======================== -->

                            </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>';
    echo $footer;
}


