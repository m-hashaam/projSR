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
<script type="text/javascript" src="js/jstree.js"></script>
<script type="text/javascript" src="js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/jstreesearch.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="js/company.js"></script>


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
<link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link rel="stylesheet" type="text/css" href="css/hover-min.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-tour.min.css">
<link rel="stylesheet" type="text/css" href="css/imgareaselect-animated.css">
<link rel="stylesheet" type="text/css" href="css/alignment.css">
<link rel="stylesheet" type="text/css" href="css/headings-texts.css">
<link rel="stylesheet" type="text/css" href="css/select-boxes.css">
      
	  <link rel="stylesheet" type="text/css" href="css/style.css">
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
    $query = "SELECT `u_company` FROM `user` WHERE `u_id` = $userid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $cname = $row['u_company'];
    }
    else{
        $cname = "";
    }
    
    $query = "SELECT `ci_id`, `u_id`, `ci_web`, `ci_fb`, `ci_tw`, `ci_li`, `ci_street`, `ci_home`, `ci_city`, `ci_zip`, `ci_state`, `ci_mission`, `ci_awards`, `ci_logo`, `ci_video` FROM `company_information` WHERE `u_id` = $userid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
    	$ci_web = $row['ci_web'];
        $ci_fb = $row['ci_fb'];
        $ci_tw = $row['ci_tw'];
        $ci_li = $row['ci_li'];
        $ci_street = $row['ci_street'];
        $ci_home = $row['ci_home'];
        $ci_city = $row['ci_city'];
        $ci_zip = $row['ci_zip'];
        $ci_state = $row['ci_state'];
        $ci_mission = $row['ci_mission'];
        $ci_awards = $row['ci_awards'];
        $ci_logo = $row['ci_logo'];
        $ci_video = $row['ci_video'];
    }
    else{
        $ci_web = ""; 
        $ci_fb = ""; 
        $ci_tw = ""; 
        $ci_li = ""; 
        $ci_street = "";
        $ci_home = ""; 
        $ci_city = ""; 
        $ci_zip = ""; 
        $ci_state = "";
        $ci_mission = "";
        $ci_awards = ""; 
        $ci_logo = ""; 
        $ci_video = ""; 
    }
    $db->close();
    
    
	$footer = '<div class="page-container">            <div class="page-head">
                <div class="container-fluid">
                    <div class="page-title margin-left-25">
                        <h1>'.$cname.' Profile
<small>company profile page</small>
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
    
    <div class="profile-usermenu usermenu-no-user-info">
        <ul class="nav">
            <li id="account">
                <a href="account.php">
                <i class="icon-user"></i>
                Account Settings </a>
            </li>
            <li id="company" class="active">
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
        <span class="caption-subject font-green-haze bold uppercase">Company Profile <small class="auto-save-class" id="timer"></small></span>
    </div>
           <ul class="nav nav-tabs">
            <li class="active">
                <a href="http://portal.sweetreferrals.com/company.php#basicInfo" data-toggle="tab" aria-expanded="true">Basic information</a>
            </li>
            <li class="">
                <a href="http://portal.sweetreferrals.com/company.php#details" data-toggle="tab" aria-expanded="false">Details</a>
            </li>
            <li class="">
                <a href="http://portal.sweetreferrals.com/company.php#media" data-toggle="tab" aria-expanded="false">Media and Submission</a>
            </li>
        </ul>
</div>
<div class="portlet-body">
    <div class="tab-content">
        <div class="tab-pane active" id="basicInfo">
            <div class="portlet-body form">
                <form action="javascript:;" class="horizontal-form">
                    <div class="form-body" style="margin-top: -14px">
                            <span class="caption-subject">Fill out this information to help consumers know more about your company</span>
                        <br>
                        <div class="form-group" style="margin-top: 10px">
                            <label class="control-label">Website <span class="required">* </span></label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                </span>
                                <input type="url" id="cWeb" class="form-control"  value="'.$ci_web.'" placeholder="http://www.yoursite.com"  title="">
                                </div>
                        </div>
                        <div></div>
                        <label class="control-label">Social Media</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                                <i class="fa fa-facebook"></i>
                                        </span>
                                    <input type="url" id="cFb" class="form-control" placeholder="www.facebook.com/fanpage" value="'.$ci_fb.'" title="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                                <i class="fa fa-twitter"></i>
                                        </span>
                                        <input type="url" class="form-control" id="cTw" placeholder="www.twitter.com/yourhandle" value="'.$ci_tw.'" title="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                        <i class="fa fa-linkedin"></i>
                                </span>
                               <input type="url" class="form-control" id="cLi" placeholder="www.linkedin.com/yourcompany/etc" value="'.$ci_li.'"  title="">
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" id="cStreet" placeholder="Street Address" class="form-control" value="'.$ci_street.'"  title="">
                        </div>
                        <div></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="cHome" placeholder="Ste/Apt" value="'.$ci_home.'"  title="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="cCity"  placeholder="City" value="'.$ci_city.'"  title="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <input type="text" class="form-control" id="cState"  placeholder="State" value="'.$ci_state.'"  title="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Zipcode" id="cZip" value="'.$ci_zip.'" title="">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="form-actions">
                     <div class="row">
                       <div class="col-md-9">
                          <button class="btn btn-default btn-lg rounded-4" id="save_info_basic" onclick="saveAll()">Save</button>
                          <button type="button" class="btn btn-lg green-jungle rounded-4" id="save_info_basic_next" onclick="saveAll2()">Save &amp; Next &nbsp;</button>
                       </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="details">
            <div class="form-group">
                <label class="control-label">Our Mission <span class="required">* </span></label>
                <textarea id="cMission" rows="7" class="form-control" style="resize: vertical">'.$ci_mission.'</textarea>
            </div>
            <div></div>
            <div class="form-group col-md-4" style="margin-left: -13px">
                <label class="control-label">Awards</label>
                <input type="text" class="form-control"  placeholder="Awards" id="cAwards" value="'.$ci_awards.'" title="">
            </div>

         

            <div></div>
              <div class="form-actions">
                 <div class="row">
                   <div class="col-md-9">
                      <button class="btn btn-default btn-lg rounded-4" id="save_info_detail" onclick="saveAll()">Save</button>
                      <button type="button" data-dismiss="modal" class="btn btn-lg green-jungle rounded-4" id="save_info_detail_next" onclick="saveAll3()">Save &amp; Next &nbsp;</button>
                   </div>
                 </div>
              </div>
        </div>
        <div class="tab-pane" id="media">
            <div class="row">
                <div class="col-md-6">
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="row fileupload-buttonbar">

                                <form action="upload.php?company=1" method="post" enctype="multipart/form-data">
                                    <div class="col-md-3" id="addPictureLabel" data-trigger="click" data-placement="top" data-toggle="popover" data-content="Please wait, your picture is being uploaded." data-original-title="" title="">
                                        <label class="font-blue-dark fileinput-button uploadButton" for="inputImage" id="pictureButtonSpan" title="Upload image file">
                                            <a class="js-choose-computer btn green-haze">
                                                <i class="fa fa-plus" for="inputImage"></i>
                                                <span for="inputImage">';
                                                if($ci_logo == null || $ci_logo == ""){
                                                    $footer.='Add Company Logo';
                                                }
                                                else{
                                                    $footer.='Edit Company Logo';
                                                }
                                                
                                                
                                                $footer.='</span>
                                            </a>
                                            <input type="file" multiple="" class="sr-only hide" id="inputImage" name="file" accept="image/*">
                                        </label>
                                            <input type="hidden" id="x" name="x" />
                                          <input type="hidden" id="y" name="y" />
                                          <input type="hidden" id="w" name="w" />
                                          <input type="hidden" id="h" name="h" />
                                          <input type="submit" value="submit" id="submitid" style="    display: none;"/>
                                        </div>
    
                                    
                                </form>

                                <br><br><br>
                                
                                <img style="padding-left:15px;" id="uploadPreview" src="'.$ci_logo.'" />

                                <div id="imageDiv">
                                                                        </div>
                            </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Company Youtube Video</label>
                           <input type="text" id="cVideo" class="form-control" value="'.$ci_video.'" placeholder="https://www.youtube.com/embed/sample"  title="">
                    </div>
                   

                   
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-9">
                        <br>
                       
                        <a class="btn btn-lg green-jungle rounded-4 submit" data-toggle="modal" id="submit" onclick="saveAllAll()">
                            <i class="fa fa-check"></i>
                            Submit Company Profile
                        </a>
                       
                    </div>
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
        </div> ';

    echo $footer;
}


