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
if((isset($_SESSION['sub_idSR']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/saccount.php');
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
<script type="text/javascript" src="js/account.js"></script>


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

compaignContent($pname);

echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function compaignContent($pname){
    
    include 'database/db.php';
    $proid = $_SESSION['CurrentProductID'];
    $userid = $_SESSION['idSR'];
    $query = "SELECT `u_id`, `u_email`, `u_password`, `u_company`, `u_first_name`, `u_last_name`, `u_is_verified`, `u_mobile`, `u_job` FROM `user` WHERE `u_id` = $userid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
    	$email = $row['u_email'];
    	$fname = $row['u_first_name'];
        $lname = $row['u_last_name'];
        $mob = $row['u_mobile'];
        $job = $row['u_job'];
    }
    else{
        $email = "";
    	$fname = "";
        $lname = "";
        $mob = "";
        $job = "";
    }
    $db->close();
	$footer = '<div class="page-container">
            <div class="page-head">
                <div class="container-fluid">
                    <div class="page-title margin-left-25">
                        <h1>Account Settings
<small>Configure your account</small>
</h1>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                  
                    <div class="row margin-top-10">
                        <div class="col-md-3 col-sm-3">

                            <!-- ============================ PAGE SIDEBAR START ========================== -->
                            <div class="portlet light profile-sidebar-portlet">
    <div class="profile-usertitle profile-user-fluid-title">
        <div class="profile-usertitle-name">
            '.$fname.' '.$lname.'
        </div>
        <div class="profile-usertitle-job">
            
        </div>
    </div>
    <div class="profile-usermenu usermenu-no-user-info">
        <ul class="nav">
            <li id="account" class="active">
                <a href="account.php">
                <i class="icon-user"></i>
                Account Settings </a>
            </li>
            <li id="company">
                <a href="company.php">
                    <i class="fa fa-globe"></i>
                    Company Profile </a>
            </li>
        </ul>
    </div>
</div>

    


                            <!-- ============================= PAGE SIDEBAR END =========================== -->

                        </div>
                        <div class="profile-content col-md-9 col-sm-9">
                            <div class="portlet light">

                                <!-- ======================= PAGE PROFILE CONTENT START ======================= -->
                                <div class="portlet-title tabbable-line">
    <div class="caption caption-md">
        <i class="icon-globe theme-font hide"></i>
        <span class="caption-subject font-green-haze bold uppercase">Profile Information</span>
    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="http://portal.sweetreferrals.com/account.php#tab_1_1" data-toggle="tab">Personal Info</a>
        </li>
        <li>
            <a id="changePasswordTab" href="http://portal.sweetreferrals.com/account.php#tab_1_3" data-toggle="tab">Change Password</a>
        </li>
    </ul>
</div>
<div class="portlet-body">
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">
            <form role="form" action="changeaccount.php" id="form_sample_2" novalidate="novalidate">
                <div class="form-group field-div has-success">
                    <label class="control-label">First Name <span class="required" aria-required="true">* </span></label>
                    <div class="input-icon right">
                        <i class="fa fa-check" id="first_name" data-original-title=""></i>
                        <input type="text" placeholder="John" value="'.$fname.'" class="form-control" name="fname" id="fname" aria-required="true" aria-describedby="firstName-error">
                    </div>
                </div>
                <div class="form-group field-div has-success">
                    <label class="control-label">Last Name <span class="required" aria-required="true">* </span></label>
                    <div class="input-icon right">
                        <i class="fa fa-check" id="last_name" data-original-title=""></i>
                        <input type="text" placeholder="Doe" value="'.$lname.'" class="form-control" name="lname" id="lname" aria-required="true" aria-describedby="lastName-error">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Mobile Number</label>
                    <div class="input-icon right">
                        <i class="fa fa-check" id="mobile_number"></i>
                        <input type="text" placeholder="xxx-xxx-xxxx" value="'.$mob.'" class="form-control" name="mob" id="mobile">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Job Title</label>
                    <div class="input-icon right">
                        <i class="fa fa-check" id="job_title"></i>
                        <input type="text" placeholder="Brand Manager" value="'.$job.'" class="form-control" name="job" id="title">
                    </div>
                </div>
                <div class="form-group field-div has-success">
                    <label class="control-label">Email <span class="required" aria-required="true">* </span></label>
                    <div class="input-icon right">
                        <i class="fa fa-check" id="user_email" data-original-title=""></i>
                        <input type="text" placeholder="ali@sweetreferrals.com" class="form-control" value="'.$email.'" name="email" id="email" aria-required="true" aria-describedby="email-error">
                    </div>
                </div>
            </form>
            <div class="row">
            <div class="margin-top-10 col-md-2" id="save_changes_popover" data-toggle="popover" data-placement="right" data-content="Please fill the required fields to enable this option." data-original-title="" title="">
                <button id="save_changes" class="btn btn-lg green-jungle rounded-4" onclick="saveChanges()">
                    Save Changes
                </button>
            </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1_3">
            <div class="form-group">
                <label class="control-label">Current Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="current_password" placeholder="Your current password">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="newPassword" placeholder="Your new password">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                </div>
                    <label class="hidden" id="result"></label>
             </div>
            <div class="form-group">
                <label class="control-label">Re-type New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Re-type new password">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                </div>
                <br>
                <div id="confirmPasswordError" class="green-haze"></div>
            </div>

            <div class="row">
                <div class="margin-top-10 col-md-2" id="save_password_popover" data-toggle="popover" data-placement="right" data-content="" data-original-title="" title="">
                    <button id="changePassword" class="btn btn-lg green-jungle rounded-4" onclick="changePassword()">
                        Change Password
                    </button>
                </div>
            </div>
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

    echo $footer;
}


