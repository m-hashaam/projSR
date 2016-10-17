<?php

if(!(isset($_SESSION['loggedInSR']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
if(($_SESSION['user_type'] == "Pawn")){
    $server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
	
Class main{
		 
	function welcome(){
		include "database/db.php";
		
          $iddd = $_SESSION['idSR'];
          $username = $_SESSION['emailSR'];
          $query = "SELECT `u_first_name`,`u_id`,`u_is_verified` FROM `user` WHERE `u_id` = $iddd ";
	  
    	  $result = $db->query($query) or die("Unable to communicate with database");
    		  
    	  
    	  if ($row = $result->fetch_assoc()) {
                if($row['u_is_verified'] == 0 || $row['u_is_verified'] == "0"){
                    $this->printEmailActPage($username);
                    return;
                }
    	  }
        
        
        
        if(isset($_GET['step'])){
			$step = $_GET['step'];
		}
		else{
			$step = 1;
		}
		$userid = $_SESSION['idSR'];
        $GLOBALS['plive'] = 0;
		$query = "SELECT count(`p_id`) AS cc,`p_islive` FROM `product` WHERE `u_id` = $userid";
		$stmt = $db->query($query);
		if($row = $stmt->fetch_assoc()){
			
            if($row['cc'] == 0){
				$this->steps($step);
			}
			else if($step != 1){
				$this->steps($step);
			}
			else{
				$this->print_main_page();
			}
		}
		
	}
	
	function print_main_page(){
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

<script type="text/javascript" src="js/persona.js"></script>


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
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
       
       
       
  
    </head>';
	
	echo $html;
	
	$html='<body class=" page-header-menu-fixed  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

';
echo $html;

include 'database/db.php';
$userid = $_SESSION['idSR'];
if(!isset($_SESSION['CurrentProductName'])){
	$query = "SELECT `p_id`, `u_id`, `p_name`, `p_url` FROM `product` WHERE `u_id` = $userid";
	$stmt = $db->query($query);
	if($row = $stmt->fetch_assoc()){
		$_SESSION['CurrentProductName'] = $row['p_name'];
		$_SESSION['CurrentProductID'] = $row['p_id'];
	}
	else{
		$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$server = substr($server,0,strrpos($server,"/"));
		header('Location: http://'.$server.'/index.php?step=3');
	}
}
    $ppid = $_SESSION['CurrentProductID'];
    $query = "SELECT `p_islive` FROM `product` WHERE `p_id` = $ppid";
	$stmt = $db->query($query);
	if($row = $stmt->fetch_assoc()){
		$pislive = $row['p_islive'];
	}
    
    $db->close();
    
	include 'inc/header.php';

	include 'inc/sidebar.php';

	echo '<div class="page-container">';

	include 'inc/top_menu.php';

	echo '<div class="page-content"><div class="container-fluid"><div class="row"><div class="profile-content col-md-12 col-sm-12">
    
           ';
           
  

	$this->printMainPage();
    
    if($pislive == 0 || $pislive == "0"){
         
         $this->printContentDraft();    
    }
    else{
         $this->printContentActive();  
    }
    
    //include 'inc/main_page_left.php';

	//include 'inc/main_page_right.php';

	echo '</div></div></div></div></div>';

	include 'inc/footer2.php';

	echo '</body>';




		
	}
    
    function printContentActive(){
        
    
    include 'database/db.php';
    $proid = $_SESSION['CurrentProductID'];
    $userid = $_SESSION['idSR'];
    $query = "SELECT `p_id`, `u_id`, `p_name`, `p_url`, `p_category`, `p_certifications`, `p_features`, `p_keywords`, `p_awards`, `p_desc`, `p_picture`, `p_islive` FROM `product` WHERE `p_id` = $proid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
    	$pname = $row['p_name'];
    	$pid = $row['p_id'];
        $purl = $row['p_url'];
        $pcat = $row['p_category'];
        $pcert = $row['p_certifications'];
        $pfeat = $row['p_features'];
        $pkey = $row['p_keywords'];
        $pawa = $row['p_awards'];
        $pdesc = $row['p_desc'];
        $ppic = $row['p_picture'];
    }
    $query = "SELECT `com_cities` FROM `compaign` WHERE `p_id` = $proid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $cities = $row['com_cities'];
    }
   
	$footer = '<div class="page-container">
           
            <div class="page-content">
                <div class="container-fluid">
                  
                    <div class="row margin-top-10">
                        <div class="col-md-3 col-sm-3">

                            <!-- ============================ PAGE SIDEBAR START ========================== -->
                            
        
    ';
    
       
       if($ppic == null || $ppic == ""){
             $footer.='<div class="MyWrapper1">';
             //$footer.='<img style="max-width:50%; max-height:50%; border: 2px; border-style: solid; border-color: #009ECC;" id="uploadPreview" src="assets/no-foto.png" />';
        }
        else{
             $footer.='<div class="MyWrapper1" style=" background: url('.$ppic.') no-repeat !important; background-size: cover !important;">';
             
             //$footer.='<div class="MyWrapper1" ><img src="'.$ppic.'"></img>';
        }
          
    $footer.='<div onclick="location.href=\'edit.php\'" class="MyWrapper2">
                    Upload Picture
                </div>
                
</div>

    


                            <!-- ============================= PAGE SIDEBAR END =========================== -->

                        </div>
                        <div class="profile-content col-md-9 col-sm-9">
                            <div class="portlet light">

                                <!-- ======================= PAGE PROFILE CONTENT START ======================= -->
                              
<div class="portlet-body">

    <div>
            <table><tr><td>
                    <h1 style="font-weight: bold;">'.strtoupper($pname).'</h1>
                </td>
                <td>
                    <h3 style="margin-left: 35%;  padding-top: 7px; color: #00E561; padding-left: 22px;  background-position-y: 70% !important;  background: url(http://portal.sweetreferrals.com/assets/icon_live.png) no-repeat;">LIVE</h3>
                </td>
                </tr>
            </table>
        <div style="    width: 100%; height:1px; border: 1px solid #00C6FF;"></div>
        <h4 style="color: #00C6FF; font-weight: bold;">SUMMARY</h4>
    </div>
    
<div class="row" style="text-align: left; width: 70%;">

    <div class="form-group">
        <label class="col-md-3 control-label">Product Name: </label>
        <div class="col-md-9">
            <div id="nameDiv">
                <input style="margin-bottom: 15px;" disabled="disabled" type="text" id="proname" class="form-control input-lg" name="product[name]" value="'.$pname.'" >
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Category: </label>
        <div class="col-md-9">
            <div id="nameDiv">
                <input style="margin-bottom: 15px;" disabled="disabled" type="text" id="proname" class="form-control input-lg" name="product[name]" value="'.$pcat.'" >
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Region: </label>
        <div class="col-md-9">
            <div id="nameDiv">
                <input style="margin-bottom: 15px;" disabled="disabled" type="text" id="proname" class="form-control input-lg" name="product[name]" value="'.$cities.'" >
            </div>
        </div>
    </div>
    
    ';

echo $footer;

	include 'modals/personas.php';
					 $db->close();
                     echo '<div class="form-group">
                                <label class="col-md-3 control-label">Consumer Archetypes: </label>
                                <div class="col-md-9">
                                    <div id="nameDiv">
                                        <div style="display:inline-block; position:relative; width: 100%;">
                                            <input style="margin-bottom: 15px; cursor: pointer;" disabled="disabled" type="text" id="asd" class="form-control input-lg" name="product[name]" value="Click to view" >
                                            <div onclick="jQuery(\'#responsive\').modal(\'show\');" style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer;"> &nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    
$footer='</div>

 

  


                                <!-- ======================== PAGE PROFILE CONTENT END ======================== -->

                            </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>';

    echo $footer;
    }
    
    
    function printContentDraft(){
        
    
    include 'database/db.php';
    $proid = $_SESSION['CurrentProductID'];
    $userid = $_SESSION['idSR'];
    $query = "SELECT `p_id`, `u_id`, `p_name`, `p_url`, `p_category`, `p_certifications`, `p_features`, `p_keywords`, `p_awards`, `p_desc`, `p_picture`, `p_islive` FROM `product` WHERE `p_id` = $proid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
    	$pname = $row['p_name'];
    	$pid = $row['p_id'];
        $purl = $row['p_url'];
        $pcat = $row['p_category'];
        $pcert = $row['p_certifications'];
        $pfeat = $row['p_features'];
        $pkey = $row['p_keywords'];
        $pawa = $row['p_awards'];
        $pdesc = $row['p_desc'];
        $ppic = $row['p_picture'];
    }
    
    $pname = $_SESSION['CurrentProductName'];
    $pid = $_SESSION['CurrentProductID'];
    
    $qqq = "SELECT `p_category`,  `p_desc`, `p_picture`,`p_islive` FROM `product` WHERE `p_id` = $pid";
    $sss = $db->query($qqq);
    if($rrr = $sss->fetch_assoc()){
        $pcat = $rrr['p_category'];
        $pdesc = $rrr['p_desc'];
        $ppic = $rrr['p_picture'];
        $plive = $rrr['p_islive'];
    }
    else{
       $pcat = "";
       $pdesc = "";
       $ppic = ""; 
       $plive = 0;
    }
     
    $query = "SELECT `com_id` FROM `compaign` WHERE `p_id` = $pid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $com = 1;
    }
    else{
        $com = 0;
    }
    $db->close();
	$footer = '<div class="page-container">
           
            <div class="page-content">
                <div class="container-fluid">
                  
                    <div class="row margin-top-10">
                        <div class="col-md-3 col-sm-3">

                            <!-- ============================ PAGE SIDEBAR START ========================== -->
                            <div class="portlet light profile-sidebar-portlet">
   
    <div class="profile-usermenu usermenu-no-user-info" style="text-align: center;">
        
    ';
    
       
       if($ppic == null || $ppic == ""){
             $footer.='<div class="MyWrapper1">';
             //$footer.='<img style="max-width:50%; max-height:50%; border: 2px; border-style: solid; border-color: #009ECC;" id="uploadPreview" src="assets/no-foto.png" />';
        }
        else{
             $footer.='<div class="MyWrapper1" style=" background: url('.$ppic.') no-repeat !important; background-size: contain !important;">';
        }
          
    $footer.='<div class="MyWrapper2" onclick="location.href=\'edit.php\'">
                    Upload Picture
                </div>
                </div>
                  
       
    </div>
</div>

    


                            <!-- ============================= PAGE SIDEBAR END =========================== -->

                        </div>
                        <div class="profile-content col-md-9 col-sm-9">
                            <div class="portlet light">

                                <!-- ======================= PAGE PROFILE CONTENT START ======================= -->
                              
<div class="portlet-body">

    <div>
            <table><tr><td>
                    <h1 style="font-weight: bold;">'.strtoupper($pname).'</h1>
                </td>
                <td>
                    <h3 style="margin-left: 35%;  padding-top: 7px; color: #FF5050; padding-left: 22px;  background-position-y: 70% !important;  background: url(http://portal.sweetreferrals.com/assets/icon_draft.png) no-repeat;">DRAFT</h3>
                </td>
                </tr>
            </table>
        <div style="    width: 100%; height:1px; border: 1px solid #00C6FF;"></div>
    </div>
    
    <div style="width:100%; text-align: center;">
        <img src="assets/icon_alert.png" style="margin-top:5%; ">
        
        <div class="copyright font-grey-silver" style="  float:center;  color: #009ECC !important;padding-bottom: 0px; margin-bottom: 0px; margin-top: 5%;">  
                Go to Product Info to Complete Product Profile
            </div>
            
    </div>
    	
        <table style="margin-right: auto; margin-left: auto; margin-top: 15%;">
            <tr>
                <td style="margin:0; padding:0;  width: 10%;"><img  src="assets/complete.png" style="    width: 100%;" /></td>
                <td style="margin:0; padding:0; "><img  src="assets/Connector.png" style="   width: 100%;" /></td>
                <td style="margin:0; padding:0; width: 10%;">';
                if($pcat != "" && $pdesc != "" && $ppic != ""){
                    $oneOK = 1;
                    $footer.='<img  src="assets/complete.png" style="  width: 100%;" />';
                }
                else{
                    $footer.='<img  src="assets/incomplete.png" style="cursor: pointer;  width: 100%;" onclick="location.href=\'edit.php\'" />';
                }
                $footer.='
                </td><td style="margin:0; padding:0; "><img  src="assets/Connector.png" style="   width: 100%;" /></td>
                <td style="margin:0; padding:0; width: 10%;">';
                if($com != 1){
                     $footer.='<img  src="assets/incomplete.png" style=" cursor: pointer;  width: 100%;" onclick="location.href=\'compaignbuilder.php\'" />';
                }
                else{
                    $twoOK = 1;
                    $footer.='<img  src="assets/complete.png" style="  width: 100%;" />';
                }    
                $footer.='</td>
                <td style="margin:0; padding:0; "><img  src="assets/Connector.png" style="   width: 100%;" /></td>
                <td style="margin:0; padding:0; width: 10%;">';
                if($plive == 0 || $plive == "0"){
                    if($oneOK == 1 && $twoOK == 1){
                        $footer.='<img  src="assets/incomplete.png" style=" cursor: pointer;  width: 100%;" onclick="makeitlive()"/>';
                    }
                    else{
                        $footer.='<img  src="assets/incomplete.png" style=" width: 100%;" />';
                    }
                }
                else{
                    $footer.='<img  src="assets/complete.png" style="  width: 100%;" />';
                }
                $footer.='</td>
            </tr>
            <tr>
                <td style="margin:0; padding:0; "><p style="   text-align: center;" >Add Product Name</p></td>
                <td style="margin:0; padding:0; "><p  ></p></td>
                <td style="margin:0; padding:0; "><p style="   text-align: center;" >Complete Product Profile</p></td>
                <td style="margin:0; padding:0; "><p ></p></td>
                <td style="margin:0; padding:0; "><p style="   text-align: center;" >Submit Compaign Request</p></td>
                <td style="margin:0; padding:0; "><p  ></p></td>
                 <td style="margin:0; padding:0; "><p style=" text-align: center;" >Compaign is Live</p></td>
            </tr>
        </table>
        
       



                                <!-- ======================== PAGE PROFILE CONTENT END ======================== -->

                            </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>';

    echo $footer;
    }
    
    function printMainPage(){
        $html = '';
        $html.='<img type="button" data-toggle="modal" src="assets/button_add_new.png" data-backdrop="static" href="http://portal.sweetreferrals.com/product/1435082663#add_product" style="position: fixed; bottom: 20px; width: 50px; right: 35px; z-index: 5500; cursor: pointer;"/>
                <div id="add_product" class="modal fade" tabindex="-1" data-width="500">
                    <input type="hidden" id="productId">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Enter name of new product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control input-lg clearable" id="product_name_field_sidebar" placeholder="Enter name of new product..." value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey rounded-4" data-dismiss="modal" id="categoryCancel"> Cancel</button>
                        <button type="button" onclick="addnewproduct()"class="btn green-jungle rounded-4" id="add_new_product_sidebar" hidden=""><i class="fa fa-check"></i> Add</button>
                    </div>
                </div>';
        
        echo $html;
    }
	
	
	function steps($count){
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
<script type="text/javascript" src="js/steps.js"></script>



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
        
        
       
    </head>
	
	<body class=" background-body   pace-done" style="overflow: auto;"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">

	

 <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
        
        <div class="content rounded-4">

          
            <div class="background-body">
	<a>
		<img src="assets/Logo_4b.png" style="height: 60px !important; margin: 20px;">
	</a>
</div>
<div class="row margin-bottom-30 animated fadeIn">
	<div class="col-md-12" style="height: 100%; margin-left: -15px; margin-top: -5px; position:absolute;">
		<div id="multistepform-example-container" class="background-body multistepform" style="position: absolute; top: 0px; width: 100%; height: 100%; z-index: 9999;"><div id="multistepform"><div class="bg"></div><div class="close"></div><div id="multistepform-container">
			<ul id="multistepform-progressbar">
				';
				if($count == 1){
					$html.='<li class="active">Welcome</li>
				<li>Consumer Experience</li>
				<li>Add Product</li>
				<li>Finish</li>';
				}
				else if($count ==2){
					$html.='<li>Welcome</li>
				<li class="active">Consumer Experience</li>
				<li>Add Product</li>
				<li>Finish</li>';
				}
				else if($count ==3){
					$html.='<li>Welcome</li>
				<li>Consumer Experience</li>
				<li class="active">Add Product</li>
				<li>Finish</li>';
				}
				else if($count ==4){
					$html.='<li>Welcome</li>
				<li>Consumer Experience</li>
				<li>Add Product</li>
				<li class="active">Finish</li>';
				}
			$html.='</ul>
			
			
			
			
			
			
			';
			
			echo $html;
			if($count == 1){
				include 'inc/step1.php';
			}
			else if($count ==2){
				include 'inc/step2.php';
			}
			else if($count ==3){
				include 'inc/step3.php';
			}
			else if($count ==4){
				include 'inc/step4.php';
			}
			else{
				$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$server = substr($server,0,strrpos($server,"/"));
				header('Location: http://'.$server.'/index.php');
			}
			
			$html = '		</div></div></div>
	</div>
</div>

           

        </div>';
		echo $html;
		
		$html='</body></html>';
		echo $html;
	}
    
    
    function printEmailActPage($error){
		
		$html='<!DOCTYPE html>
					<html lang="en">
					<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta charset="utf-8">


					<title>Email Not Activated - Sweet Refferals</title>



					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta content="width=device-width, initial-scale=1.0" name="viewport">
							
							

					<link rel="icon" href="assets/favicon.ico" type="image/x-icon">
						   
						   
						   
					<script async="" src="js/"></script>
					<script async="" src="js/"></script>
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
					<script type="text/javascript" src="js/login.js"></script>




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
						   
						</head>
						<body class="login  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
					  <div class="pace-progress-inner"></div>
					</div>
					<div class="pace-activity"></div></div>
							<div class="logo">
								<a href="http://portal.sweetreferrals.com/">
								<img src="assets/logo_white.png" style="height:75px;">
								</a>
							</div>
							<div class="content rounded-4">
									
						<div class="login-form-div">

						<form method="POST" action="resendactivation.php?email='.$error.'" accept-charset="UTF-8" login-form="login-form">
							<h3 class="form-title">Email Not Activated</h3>
						<div id="login-error" class="alert alert-danger ">
											<span>Click button below to resend email</span>
										</div>
                                        <div class="form-group clearfix nobottommargin">
								<Button class="btn btn-lg green-meadow rounded-4 col-sm-12" type="submit" >Resend Activation Link</Button>
							</div>
							<div class="form-group">
								<p class="text-center check">Looking for our consumer site? <a href="http://sweetreferrals.com/" id="consumer-site">Click Here!</a></p>
							</div>
						
							
						</form>
						</div>
							</div>
							
						
							
						
					';
					echo $html;
	
								include 'inc/footer.php';
								$html='</body></html>';
			echo $html;
            	$_SESSION = array(); 
	session_destroy(); 
	}
		
}