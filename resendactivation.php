<?php
error_reporting(E_ERROR | E_PARSE);

if(isset($_GET['email'])){
    $email = $_GET['email'];
    include "database/db.php";
     $query = "SELECT `u_first_name`,`u_id`,`u_is_verified` FROM `user` WHERE `u_email` = '$email'";
	  
	  $result = $db->query($query) or die("Unable to communicate with database");
		  
	  
	  if ($row = $result->fetch_assoc()) {
	       $idd = $row['u_id'];
           $namee = $row['u_first_name'];
	        $passlink = generateRandomString(50);
            $query = "INSERT INTO `email_verification`(`ev_link`, `u_id`) VALUES ('$passlink',$idd)";
            $db->query($query);
            $query = "SELECT `ev_link` FROM `email_verification` WHERE `u_id` = $idd";
            $stmt = $db->query($query);
            if($row = $stmt->fetch_assoc()){
                $passlink = $row['ev_link'];   
            }
            require_once('mail/phpmailer/class.phpmailer.php');
            $mail = new PHPMailer();
            //$mail->SMTPSecure = 'tls';
            $mail->Username   = "noreply@sweetreferrals.com";  // GMAIL username
            $mail->Password   = "NoReply1";  
            $mail->AddAddress($email);
            $mail->FromName = "Sweet Referrals Portal";
            $mail->Host       = "sweetreferrals.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 587;   
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->IsHTML(true);
            $mail->CharSet="utf-8";
            $mail->From = $mail->Username;
            $body = file_get_contents("mail/welcome/Welcome.html");
            $body = str_replace('%user%', "Welcome $first", $body);
            $body = str_replace('%message%', "Your email activation Link is : http://portal.sweetreferrals.com/activateemail.php?link=$passlink", $body);			
            $mail->Subject = "Sweet Referrals | Email Activation";
            $mail->MsgHTML($body);
            $mail->Send();
            $message = "Email verification link has been sent";
    		
    		if(!$mail->Send()) {
    		 //echo "Mail Error: " . $mail->ErrorInfo;
    		}
            else{
                //echo "Email successfully sent to address specified";
            }
       }
       else{
        $message = "Invalid Email Address";
       }
}
else{
    $message = "Invlid Email Address";
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

						<form method="POST"  accept-charset="UTF-8" login-form="login-form">
							<h3 class="form-title">Resend Activation Link</h3>
						<div id="login-error" class="alert  " style="text-align: center;">
											<span>'.$message.'</span>
										</div>
                                        <div class="form-group clearfix nobottommargin">
							
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
            
            
            
  function generateRandomString($length) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
    		$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
    }