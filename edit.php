<?php
session_start(); 
if(!(isset($_SESSION['loggedInSR']))){
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
    $db->close();
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
<script type="text/javascript" src="js/steps.js"></script>
<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript" src="js/jstree.js"></script>
<script type="text/javascript" src="js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/jstreesearch.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="js/edit.js"></script>


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
       <link rel="stylesheet" type="text/css" href="css/MyTabs.css">
       
            
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

echo '<div class="page-content"><div class="container-fluid"><div class="row"><div class="col-md-12">';

editPageContent($pname);

echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function editPageContent($pname){
    include 'database/db.php';
    $proid = $_SESSION['CurrentProductID'];
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
    $db->close();
	$footer = '<div class="form-horizontal form-row-seperated">
           
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
    				    <span class="caption-subject font-green-haze bold uppercase">Edit Product </span>
                        <span class="caption-helper">'.$pname.'</span> &nbsp;
                    </div>

                    <div class="actions btn-set">
                        <button class="btn btn-default rounded-4 save" id="save" onclick="saveandnext()">Save and Next Step</button>
                        <button class="btn green-jungle rounded-4 submit1" id="submit1" onclick="subimtprofile()"><i class="fa fa-check"></i> Submit Profile</button>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="tabbable tabs-left" id="tabs">
                        <ul class="nav nav-tabs">
                            <li id="tab1" class="active">
                                <a href="#tab_general" data-toggle="tab" aria-expanded="true">
                                    <span class="tab-heading">1. Product Essentials </span>
                                </a>
                            </li>

                            <li id="tab2">
                                <a href="#tab_images" data-toggle="tab" aria-expanded="false">
                                    <span class="tab-heading">2. Product Images </span>
                                </a>
                            </li>
                        </ul>

	

                                <div id="add_category" class="modal fade" tabindex="-1" data-width="500">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Select your product category</h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="javascript:;" class="alert alert-success alert-borderless">
                                                    <input type="text" class="form-control input-lg clearable" id="categorySearch" placeholder="Type here to search for category..." value="">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                            <div class="categoryTreeHeight box jstree jstree-1 jstree-default jstree-default-responsive" id="productCategory" role="tree"></div>
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn green-haze rounded-4" data-dismiss="modal" id="categoryOk" hidden=""><i class="fa fa-check"></i> Select
                                        </button>
                                        <button type="button" class="btn grey rounded-4" data-dismiss="modal" id="categoryCancel"> Cancel
                                        </button>
                                    </div>
                                </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                <br>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <div class="help-tip">
                    				<p>Name of the product.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Name: <span class="required">* </span></label>
                                    <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="proname" class="form-control input-lg" name="product[name]" value="'.$pname.'" placeholder="Name of Product">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                 <div class="help-tip">
                    				<p>Select one category for the product.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Category : <span class="required">* </span></label>
                                    <div class="col-md-9" id="cate" data-original-title="" title="">
									<input type="text" id="categories" class="form-control input-lg cursorCategory" name="category" value="'.$pcat.'" placeholder="Category of Product">
                                       
                                                                        </div>
                                </div>

                                <div class="form-group">
                                 <div class="help-tip">
                    				<p>A small description of the product.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Description: <span class="required">* </span></label>
                                     <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="prodesc" class="form-control input-lg" name="product[name]" value="'.$pdesc.'" placeholder="Description of Product">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                 <div class="help-tip">
                    				<p>Any certifications related to the product.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Certifications :</label>
                                    <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="procert" class="form-control input-lg" name="certifications" value="'.$pcert.'" placeholder="Certifications">
                                        </div>
                                    </div>
                                </div>
                              
                                 <div class="form-group">
                                  <div class="help-tip">
                    				<p>Unique features of the product.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Features:</label>
                                     <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="profeat" class="form-control input-lg" name="product[name]" data-role="tagsinput" value="'.$pfeat.'" placeholder="Features (Comma Separated)">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                  <div class="help-tip">
                    				<p>Users can find your product using these keywords.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Keywords:</label>
                                     <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="prokey" class="form-control input-lg" name="product[name]" data-role="tagsinput" value="'.$pkey.'" placeholder="Keywords (Comma Separated)">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                  <div class="help-tip">
                    				<p>Any award won by the product.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Awards:</label>
                                     <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="proawards" class="form-control input-lg" name="product[name]" data-role="tagsinput" value="'.$pawa.'" placeholder="Awards (Comma Separated)">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                  <div class="help-tip">
                    				<p>Web URL of the product page.</p>
                    			</div>
                                    <label class="col-md-3 control-label">Website:</label>
                                     <div class="col-md-9">
                                        <div id="nameDiv">
                                            <input type="text" id="proweb" class="form-control input-lg" name="product[name]" value="'.$purl.'" placeholder="Product Website">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                                <input id="reactFeatures" type="hidden" value="">
                                <input id="reactAwards" type="hidden" value="">
                           </div>
                        </div>

                                                <div style="text-align:center;" class="tab-pane" id="tab_images">
                            <br>
                            <br>
                            <div class="row fileupload-buttonbar">

                                <form action="upload.php?proid='.$proid.'" method="post" enctype="multipart/form-data">
                                    <div class="col-md-3" id="addPictureLabel" data-trigger="click" data-placement="top" data-toggle="popover" data-content="Please wait, your picture is being uploaded." data-original-title="" title="">
                                        <label class="font-blue-dark fileinput-button uploadButton" for="inputImage" id="pictureButtonSpan" title="Upload image file">
                                            <a class="js-choose-computer btn green-haze">
                                                <i class="fa fa-plus" for="inputImage"></i>
                                                <span for="inputImage">';
                                                if($ppic == null || $ppic == ""){
                                                    $footer.='Add Product Picture';
                                                }
                                                else{
                                                    $footer.='Change Product Picture';
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
    
                                    <div class="col-md-9 upload-tip">
                                        <p class="help-block" style="text-align: center;">Tip : Picture should be .jpg or .png and recommended dimensions are 470 X 394. Each picture can be up to 5MB.</p>
                                    </div>
                                </form>

                                <br><br><br>
                                
                                <img style="    max-width: 90%; padding-left:15px;" id="uploadPreview" src="'.$ppic.'" />

                                <div id="imageDiv">
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
                                <button type="button" class="btn btn-default btn-lg rounded-4 save" id="save1" onclick="saveandnextt()">Save and Next Step</button>
                                <button class="btn btn-lg green-jungle rounded-4 submit1" id="submit1" onclick="sumit()"><i class="fa fa-check"></i> Submit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

echo $footer;
}


