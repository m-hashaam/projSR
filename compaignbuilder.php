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
if(!($_SESSION['user_type'] == "Admin" || $_SESSION['user_type'] == "Editor")){
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
<script type="text/javascript" src="js/typeahead.js"></script>
<script type="text/javascript" src="js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/bootstrap-tagsinput-angular.js"></script>
<script type="text/javascript" src="js/steps.js"></script>
<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript" src="js/compaign.js"></script>

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
<link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
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
    $query = "SELECT `com_id`, `p_id`, `com_quantity`, `com_storage`, `com_fulfilment`, `com_promotion`, `com_kpi`, `com_cities` FROM `compaign` WHERE `p_id` = $proid";
    //echo $query;
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
    	$quant = $row['com_quantity'];
    	$storage = $row['com_storage'];
        $fulfil = $row['com_fulfilment'];
        $promo = $row['com_promotion'];
        $kpi = $row['com_kpi'];
        $cities = $row['com_cities'];
    }
    else{
        $quant = "";
    	$storage = "";
        $fulfil = "";
        $promo = "";
        $kpi = "";
        $cities = "";
    }
    $db->close();
	$footer = '<div class="form-horizontal form-row-seperated">
           
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
    				    <span class="caption-subject font-green-haze bold uppercase">Compaign Builder </span>
                    </div>

                    <div class="actions btn-set">
                        <button class="btn btn-default rounded-4 save" id="save" onclick="saveandnext()">Save and Next Step</button>
                        <button class="btn green-jungle rounded-4 submit1" id="submit1" onclick="subimtprofile()"><i class="fa fa-check"></i> Submit Compaign</button>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="tabbable tabbable-custom nav-justified" id="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li id="tab1" class="active">
                                <a href="#tab_general" data-toggle="tab" aria-expanded="true">
                                    <span class="tab-heading">1. Compaign Essentials </span>
                                </a>
                            </li>

                            <li id="tab2">
                                <a href="#tab_images" data-toggle="tab" aria-expanded="false">
                                    <span class="tab-heading">2. Add Cities </span>
                                </a>
                            </li>
                        </ul>

	
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                <br>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                
                                    <label class="col-md-3 control-label">Quantity: <span class="required">* </span></label>
                                    <div class="col-md-9">
                                        <div class="nameDiv">
                                            <select type="text" id="cQty" onkeyup="validateNumber()" class="form-control input-lg" name="product[name]" value="'.$quant.'" placeholder="Quantity">
                                            <option value="300" '; if($quant == 300){$footer.='selected';}$footer.='>300</option>
                                            <option value="600" '; if($quant == 600){$footer.='selected';}$footer.='>600</option>
                                            <option value="900" '; if($quant == 900){$footer.='selected';}$footer.='>900</option>
                                            <option value="1200" '; if($quant == 1200){$footer.='selected';}$footer.='>1200</option>
                                            <option value="1500" '; if($quant == 1500){$footer.='selected';}$footer.='>1500</option>
                                            </select>
                                        </div>
                                         <div class="help-tip">
                                				<p>Quantity of samples assigned for compaign.</p>
                                			</div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                
                                    <label class="col-md-3 control-label">Storage : <span class="required">* </span></label>
                                    <div class="col-md-9" id="cate" data-original-title="" title="">
                                     <div class="nameDiv">
                                    <input type="text" id="cStore" class="form-control input-lg cursorCategory" name="category" value="'.$storage.'" placeholder="Storage">
                                     </div>
                                      <div class="help-tip">
                                				<p>Storage of the product.</p>
                                			</div>
                                                                        </div>
                                </div>

                                <div class="form-group">
                                
                                    <label class="col-md-3 control-label">Fulfilment: <span class="required">* </span></label>
                                     <div class="col-md-9">
                                        <div class="nameDiv">
                                            <input type="text" id="cFull" class="form-control input-lg" name="product[name]" value="'.$fulfil.'" placeholder="Fulfilment">
                                        </div>
                                         <div class="help-tip">
                                				<p>Fulfilment of the product.</p>
                                			</div>
                                    </div>
                                </div>

                                
                                </div>
                                <div class="col-md-6">
                                 <div class="form-group">
                                
                                    <label class="col-md-3 control-label">KPI:<span class="required">* </span></label>
                                     <div class="col-md-9">
                                        <div class="nameDiv">
                                            <input type="text" id="cKPI" class="form-control input-lg" data-role="tagsinput" name="product[name]" value="'.$kpi.'" placeholder="KPI (Comma Separated)">
                                        </div>
                                         <div class="help-tip">
                                				<p>KPI\'s for product. Users will give reviews on these KPI\'s</p>
                                			</div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                              
                                    <label class="col-md-3 control-label">Comments :<span class="required">* </span></label>
                                    <div class="col-md-9">
                                        <div class="nameDiv">
                                            <input type="text" id="cPro" class="form-control input-lg" name="certifications" value="'.$promo.'" placeholder="Additional Comments">
                                        </div>
                                           <div class="help-tip">
                                				<p>Comments on the compaign.</p>
                                			</div>
                                    </div>
                                </div>

                               
                            </div>
                            </div>
                                
                           </div>
                        </div>

                                                <div class="tab-pane" id="tab_images">
                            <br>
                            <br>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Cities :<span class="required">* </span></label>
                                    <div class="col-md-9">
                                        <div class="nameDiv">
                                            <input type="text" id="cCity" class="form-control input-lg" name="certifications" value="'.$cities.'" placeholder="Cities (Comma Separated)">
                                        </div>
                                        <div class="help-tip">
                                				<p>Select cities for you compaign.</p>
                                			</div>
                                    </div>
                                </div>
                        </div>

                                                        <div class="tab-pane" id="tab_preview">
                                <div class="center">
                                    <br>
                                    <i id="loader1" class="fa fa-spinner fa-spin fa-3x"></i>
                                    <div id="IframeWrapper" style="position: relative;">
                                        <div id="iframeBlocker" style="position: absolute; top: 0; left: 0; width: 1050px; height: 1000px"></div>
                                        <iframe height="1000px" width="100%" id="preview"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                                                <div class="pull-right">
                            <div class="actions btn-set">
                                <span id="timer"></span>
                                <button type="button" class="btn btn-default btn-lg rounded-4 save" id="save1" onclick="saveandnext()">Save and Next Step</button>
                                <button class="btn btn-lg green-jungle rounded-4 submit1" id="submit1" onclick="subimtprofile()"><i class="fa fa-check"></i> Submit Compaign</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

echo $footer;
}


