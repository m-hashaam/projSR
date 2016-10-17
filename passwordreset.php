<?php

function doChange(){
	if(isset($_GET['link'])){
		$link = $_GET['link'];
	}
	else{
		printPage("Invalid password reset link");
		return;
	}
	$password = $_POST['pass'];
	$conpass = $_POST['conpass'];
	if($password != $conpass){
		printPage("Passwords do not match");
		return;
	}
	if(strlen($password) < 6){
		printPage("Password must be atleast 6 characters");
		return;
	}
	if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))
	{
		$encryptedPassword = md5($password);
	}
	else{
		printPage("Password must contain a letter and a number");
		return;
	}
	$pass = md5($pass);
	include "database/db.php";
	$query = "SELECT `u_id` FROM `reset_pass` WHERE `rp_link` = '$link'";
    //echo $query;
	$result = $db->query($query);
	if($row = $result->fetch_assoc()){
		$id = $row['u_id'];
		$query = "UPDATE `user` SET `u_password` = '$pass', u_devid = 'cleared' WHERE `u_id` = $id";
		$result = $db->query($query);
		$query = "DELETE FROM `reset_pass` WHERE `u_id` = $id ";
		$result = $db->query($query);
		printPage("Password Successfully Changed");
		return;
	}
	else{
		printPage("Invalid or expired password reset link");
		return;
	}
}

function printPage($error){
	if(isset($_GET['link'])){
		$link = $_GET['link'];
	}
	
	$html='<!DOCTYPE html>
					<html lang="en">
					<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta charset="utf-8">


					<title>Login - Sweet Refferals</title>



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
                            
                                 
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
						   
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

						<form method="POST" action="passwordreset.php?link='.$link.'" accept-charset="UTF-8" login-form="login-form">
							<h3 class="form-title">Reset Password</h3>
							<div class="form-group">
								<label for="Email" class="control-label visible-ie8 visible-ie9">Password</label>
								<input class="form-control placeholder-no-fix" placeholder="Password" id="email" name="pass" type="password">
							</div>
							<div class="form-group">
								<label for="Password" class="control-label visible-ie8 visible-ie9">Confirm Password</label>
								<input class="form-control form-control-solid placeholder-no-fix" placeholder="Confirm Password" id="password" name="conpass" type="password" >
							</div>
						
						
							';
							if($error != ""){
								$html.='<div id="login-error" class="alert alert-danger ">
											<span>'.$error.'</span>
										</div>';
							}
							
							$html.='<div class="form-group clearfix nobottommargin">
								<Button class="btn btn-lg green-meadow rounded-4 col-sm-12" type="submit" >Change Password</Button>
							</div>
						
						
						
						</form>
						</div>
							</div>
							
						
							
						
					';
					echo $html;
	
								include 'inc/footer.php';
								$html='</body></html>';
			echo $html;
		
}
		
if ((isset($_POST['pass']) ) && (isset($_POST['conpass']))){
	if($_POST['conpass'] != null && $_POST['pass'] != null){

		doChange();
	}else{
		if(isset($_GET['link'])){
			printPage("");
		}
		else{
			printPage("Invalid password reset link");
		}	
	}
	
	
}
else{
	if(isset($_GET['link'])){
		printPage("");
	}
	else{
		printPage("Invalid password reset link");
	}	
}