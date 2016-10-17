<?php

if(isset($_GET['link'])){
    $link = $_GET['link'];
    include "database/db.php";
     $query = "SELECT `u_id` FROM `email_verification` WHERE `ev_link` = '$link'";
	  
	  $result = $db->query($query) or die("Unable to communicate with database");
		  
	  
	  if ($row = $result->fetch_assoc()) {
	       $idd = $row['u_id'];
           $query = "UPDATE `user` SET `u_is_verified`= 1 WHERE `u_id`= $idd";
           $db->query($query);
            $query = "DELETE FROM `email_verification` WHERE `ev_link` = '$link'";
           $db->query($query);
           $message = "Email is Activated";
       }
       else{
        $message = "Invalid Activation Link";
       }
}
else{
    $message = "Invlid Activation Link";
}
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

						<form method="POST"  accept-charset="UTF-8" login-form="login-form">
							<h3 class="form-title">Email Activation</h3>
						<div id="login-error" class="alert  " style="text-align: center;">
											<span>'.$message.'</span>
										</div>
                                        <div class="form-group clearfix nobottommargin">
							
							</div>
						
						
								<div class="clear-form-actions">
							</div>
							<div class="create-account">
								<p>
									<a href="index.php" id="register-btn" class="margin-bottom-5 uppercase register-btn-url">Login</a>
								</p>
							</div>
						</form>
						</div>
							</div>
							
						
							
						
					';
					echo $html;
	
								include 'inc/footer.php';
								$html='</body></html>';
			echo $html;
            
            
            
  function generateRandomString($length) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
    		$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
    }