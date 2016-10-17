<?php



class Login {
	
	
	function successfulLogin(){
		require_once 'main.php';
		$main = new main();
		$main->welcome();
        //echo "<script>location.href='http://portal.sweetreferrals.com/rep_overview.php'</script>";
	
	}
	
	function doLogin(){
	
		
		include "database/db.php";
		
		$username = $_POST['userSR'];
		$username = str_replace("'","\'",$username);
		$password = $_POST['passSR'];
		$password = str_replace("'","\'",$password);
	 
	  $encryptedPassword = md5($password);
		 
	  
	  $query = "SELECT `u_first_name`,`u_id`,`u_is_verified`,`u_islocked` FROM `user` WHERE `u_email` = '$username' and `u_password` = '$encryptedPassword'";
	  $result = $db->query($query) or die("Unable to communicate with database");
	  if ($row = $result->fetch_assoc()) {
		    if($row['u_is_verified'] == 0 || $row['u_is_verified'] == "0"){
                $this->printEmailActPage($username);
                return;
            }
            if($row['u_islocked'] == 1 || $row['u_islocked'] == "1"){
                $this->printLoginPage("Your account is locked due to failed login attempts. Kindly contact customer support to unlock.");
                return;
            }
			$_SESSION['idSR'] = $row['u_id'];
			$_SESSION['loggedInSR'] = 1;
			$_SESSION['emailSR'] = $username;
            $_SESSION['passSR'] = $password;
            $_SESSION['user_type'] = "Admin";
			$_SESSION['fnameSR'] = $row['u_first_name'];
            $query = "UPDATE `user` SET `u_login_attempts` = 0 WHERE `u_email` = '$username'";
            $stmt = $db->query($query);
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
        echo "<script>location.href='http://portal.sweetreferrals.com/rep_overview.php'</script>";
	  }else{
	   	   $this ->checkSubUser();
	  }
	    
	}
    
    function checkSubUser(){
	
		
		include "database/db.php";
		
		$username = $_POST['userSR'];
		$username = str_replace("'","\'",$username);
		$password = $_POST['passSR'];
		$password = str_replace("'","\'",$password);
	 
	  $encryptedPassword = md5($password);
		 
	  
	  $query = "SELECT `su_first_name`,`u_id`,`su_id`,`su_type`,`su_islocked` FROM `sub_user` WHERE `su_email` = '$username' and `su_password` = '$encryptedPassword'";
	  $result = $db->query($query) or die("Unable to communicate with database");
	  if ($row = $result->fetch_assoc()) {
            if($row['u_islocked'] == 1 || $row['u_islocked'] == "1"){
                $this->printLoginPage("Your account is locked due to failed login attempts. Kindly contact customer support to unlock.");
                return;
            }
			$_SESSION['sub_idSR'] = $row['su_id'];
            $_SESSION['idSR'] = $row['u_id'];
			$_SESSION['loggedInSR'] = 1;
        	$_SESSION['user_type'] = $row['su_type'];
			$_SESSION['emailSR'] = $username;
            $_SESSION['passSR'] = $password;
			$_SESSION['fnameSR'] = $row['su_first_name'];
            $query = "UPDATE `sub_user` SET `su_login_attempts` = 0 WHERE `su_email` = '$username'";
            $stmt = $db->query($query);
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
        echo "<script>location.href='http://portal.sweetreferrals.com/rep_overview.php'</script>";
	  }else{
	   	$query = "UPDATE `user` SET `u_login_attempts` = `u_login_attempts`+1 WHERE `u_email` = '$username'";
        $stmt = $db->query($query);
        $query = "UPDATE `user` SET `u_islocked` = (CASE WHEN `u_login_attempts`>=5 THEN 1 ELSE 0 END)";
        $stmt = $db->query($query);
        $query = "UPDATE `sub_user` SET `su_login_attempts` = `su_login_attempts`+1 WHERE `su_email` = '$username'";
        $stmt = $db->query($query);
        $query = "UPDATE `sub_user` SET `su_islocked` = (CASE WHEN `su_login_attempts`>=5 THEN 1 ELSE 0 END)";
        $stmt = $db->query($query);
		$this->printLoginPage("Invalid Email or Password");
	  }
	    
	}
	
	function printLoginPage($error){
		
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
						   
						</head>
						<body class="login  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
					  <div class="pace-progress-inner"></div>
					</div>
					<div class="pace-activity"></div></div>
							
						<div class="row">
                        <div class="col-sm-6">
                        <div class="content rounded-4" style="margin-top:10%">
									
						<div class="login-form-div">

						<form method="POST" action="index.php" accept-charset="UTF-8" login-form="login-form">
							<div class="logo" style="margin-top:0px; padding-top:15%;">
								<a href="http://portal.sweetreferrals.com/">
								<img src="assets/logo_white.png" style="height:75px;">
								</a>
							</div>
							<div class="form-group">
								<label for="Email" class="control-label visible-ie8 visible-ie9">Email</label>
								<input class="form-control placeholder-no-fix" placeholder="Email" id="email" name="userSR" type="email">
							</div>
							<div class="form-group">
								<label for="Password" class="control-label visible-ie8 visible-ie9">Password</label>
								<input class="form-control form-control-solid placeholder-no-fix" placeholder="Password" id="password" name="passSR" type="password" value="">
							</div>
							<div id="error" hidden="" class="alert alert-danger">
							</div>
							<div class="form-group clearfix">
								<a style="color: white;" class="forget-password forget pull-right" id="forget-password" onclick="forgotPassowrd()">Forgot Password?</a>
							</div>
							';
							if($error != ""){
								$html.='<div id="login-error" class="alert alert-danger ">
											<span>'.$error.'</span>
										</div>';
							}
							
							$html.='<div class="form-group clearfix nobottommargin">
								<Button class="btn btn-lg green-meadow rounded-4 col-sm-12" type="submit" >SIGN IN</Button>
                                    </div>
                                    
                                    
						
						
						
						</form>
                        
                         <div class="copyright font-grey-silver" style="    color: white !important;padding-bottom: 0px; margin-bottom: 0px;padding-top: 15%;">
                                        2016 &copy; Reserved to Sweet Referrals
                                    </div>
						</div>
							</div>
                            
                            </div>
                            
                            <div class="col-sm-6">
                                <div style="width:100%; text-align: center;">
                                <img src="assets/flow_diagram.png" style="margin-top:10%; float:center;">
                                
                                <div class="copyright font-grey-silver" style="  float:center;  color: #009ECC !important;padding-bottom: 0px; margin-bottom: 0px;">  
                                        CONNECT WITH THE RIGHT CONSUMER FOR YOUR BRAND
                                    </div>
                                    
                                </div>
                                    
                                   
                            </div>
                            </div>
                            
                           
                            <a style="color: #009ECC; position:fixed; bottom:0; left: 25%; margin-top: 10px; margin-bottom: 10px;"  class="forget-password forget pull-right">TERMS OF SERVICE</a>
                            <a style="color: #009ECC; position:fixed; bottom:0; left: 48%; margin-top: 10px; margin-bottom: 10px;" class="forget-password forget pull-right" href="">CORPORATE WEBSITE</a>
                            <a style="color: #009ECC; position:fixed; bottom:0; right:25%; margin-top: 10px; margin-bottom: 10px;" class="forget-password forget pull-right" href="http://www.sweetreferrals.com">COMSUMER WEBSITE</a>
                            	
                            
							
							<!-- Reset Password Modal -->
								<div id="resetpassModal" class="modal fade" tabindex="-1" data-width="760">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">Reset Password</h4>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<input class="form-control placeholder-no-fix" placeholder="Email" id="emailreset"  type="email" style="width: 50%; margin-left: auto; margin-right: auto;">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button id="close-popup" type="button" data-dismiss="modal" class="btn btn-default">Close</button>
										<button id="email-admin" type="button" class="btn blue" onclick="resetpass()">Reset</button>
									</div>
								</div>
							
						
					';
					echo $html;
	
								//include 'inc/footer.php';
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
	
	function handle(){
		
		if (isset($_SESSION['loggedInSR'])){
		
			$this -> successfulLogin();
		}
		else if ((isset($_POST['userSR']) ) && (isset($_POST['passSR']))){
			if($_POST['userSR'] != null && $_POST['passSR'] != null){

				$this->doLogin();
			}else{
				$this -> printLoginPage("");	
			}
			
			
		}
		else{
			// echo $_SESSION['type'];
			$this -> printLoginPage("");	
			}
		}
	
	}