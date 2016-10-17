<?php



class Signup {
	
	
	function successfulLogin(){
		
		$username = $_SESSION['username'];
		require_once 'main.php';
		$main = new main();
		$main->welcome();
	
	}
    
    function generateRandomString($length) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
    		$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
    }
	
	function doLogin(){
	
		
		include "database/db.php";
		
		$first = $_POST['firstNameSR'];
		$last = $_POST['lastNameSR'];
		$conpass = $_POST['passwordConfirmSR'];
		$password = $_POST['passwordSR'];
		$email = $_POST['emailSR'];
		$company = $_POST['companySR'];
		$first = str_replace("'","\'",$first);
		$last = str_replace("'","\'",$last);
		$conpass = str_replace("'","\'",$conpass);
		$password = str_replace("'","\'",$password);
		$email = str_replace("'","\'",$email);
		$company = str_replace("'","\'",$company);
	
		if($company == ""){
			$this->printLoginPage("Company name is required");
			return;
		}
		if($first == ""){
			$this->printLoginPage("First name is required");
			return;
		}
		if($last == ""){
			$this->printLoginPage("Last name is required");
			return;
		}
		if($conpass == ""){
			$this->printLoginPage("Password confirmation is required");
			return;
		}
		if($password == ""){
			$this->printLoginPage("Password is required");
			return;
		}
		if($email == ""){
			$this->printLoginPage("Email name is required");
			return;
		}
        if (strpos($email, '@yahoo') !== false) {
            $this->printLoginPage("Business email address is required");
			return;
        }
        if (strpos($email, '@hotmail') !== false) {
            $this->printLoginPage("Business email address is required");
			return;
        }
        if (strpos($email, '@ymail') !== false) {
            $this->printLoginPage("Business email address is required");
			return;
        }
        if (strpos($email, '@live') !== false) {
            $this->printLoginPage("Business email address is required");
			return;
        }
        if (strpos($email, '@gmail') !== false) {
            $this->printLoginPage("Business email address is required");
			return;
        }
		if($password != $conpass){
			$this->printLoginPage("Passwords do not match");
			return;
		}
		if(strlen($password) < 6){
			$this->printLoginPage("Password must be atleast 6 characters");
			return;
		}
		if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))
		{
			$encryptedPassword = md5($password);
		}
        
		else{
			$this->printLoginPage("Password must contain a letter and a number");
			return;
		}
		
		
		
		 
	  
	  $query = "INSERT INTO `user`( `u_email`, `u_password`, `u_company`, `u_first_name`, `u_last_name`) 
								VALUES ('$email','$encryptedPassword','$company','$first','$last')";
                                
    
	  
	  $result = $db->query($query) or die("Unable to communicate with database");
		  
	  if($result){
		  $idd = $db->insert_id;
          
       
			$_SESSION['idSR'] = $idd;
			$_SESSION['loggedInSR'] = 1;
			$_SESSION['emailSR'] = $email;
			$_SESSION['fnameSR'] = $first;
            
            $passlink = $this->generateRandomString(50);
            $query = "INSERT INTO `email_verification`(`ev_link`, `u_id`) VALUES ('$passlink',$idd)";
            $db->query($query);
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
            $body = str_replace('%message%', "Welcome to SweetReferrals.com. Your email activation Link is : http://portal.sweetreferrals.com/activateemail.php?link=$passlink", $body);			
            $mail->Subject = "Sweet Referrals | Email Activation";
            $mail->MsgHTML($body);
            $mail->Send();
    		
    		if(!$mail->Send()) {
    		 //echo "Mail Error: " . $mail->ErrorInfo;
    		}
            else{
               // echo "Email successfully sent to address specified";
            }
		
		
		$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$server = substr($server,0,strrpos($server,"/"));
		header('Location: http://'.$server.'/index.php');
	  }
	  else{
		  $this->printLoginPage("Something went wrong, Please try again later");
	  }
	  
	    
	}
	
	function printLoginPage($error){
		
		$html='<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">


<title>Sign up - SweetRefferals</title>



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

            <!-- ======================================= PAGE CONTENT START ======================================= -->
            <form method="POST" action="signup.php" accept-charset="UTF-8" signup-form="signup-form">
    <h3 class="form-title">Sign Up</h3>
    <p class="hint">
        No credit card required. Get started in minutes.
    </p>
    <div class="form-group">
        <label for="Company" class="control-label visible-ie8 visible-ie9">Company</label>
        <input class="form-control placeholder-no-fix" placeholder="Company" name="companySR" type="text">
        <span id="company_error" class="help-block has-error"></span>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="First name" class="control-label visible-ie8 visible-ie9">First Name</label>
            <input class="form-control placeholder-no-fix" placeholder="First Name" name="firstNameSR" type="text">
            <span id="firstname_error" class="help-block has-error col-span"></span>
        </div>
        <div class="form-group col-md-6">
            <label for="Last name" class="control-label visible-ie8 visible-ie9">Last Name</label>
            <input class="form-control placeholder-no-fix" placeholder="Last Name" name="lastNameSR" type="text">
        </div>
    </div>
    <div class="form-group">
        <label for="Email" class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control placeholder-no-fix" placeholder="Email" name="emailSR" type="email">
        <span id="email_error" class="help-block has-error"></span>
    </div>

    <p class="hint">
        Pick a password <small>(6 or more characters &amp; at least one number)</small>
    </p>
    <div class="form-group" data-toggle="popover" data-placement="top" id="password-popover" data-original-title="" title="">
        <label for="Password" class="control-label visible-ie8 visible-ie9" id="password">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" placeholder="Password" name="passwordSR" type="password" value="">
    </div>
    <div class="form-group">
        <label for="Re-type your password" class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" placeholder="Confirm Password" name="passwordConfirmSR" type="password" value="">
    </div>

							';
							if($error != ""){
								$html.='<div id="login-error" class="alert alert-danger ">
											<span>'.$error.'.</span>
										</div>';
							}
							
							$html.=' <div class="form-group topmargin-xs bottommargin-xs">
                <label class="check">
            <div class="checker" id="uniform-tos"><span class="checked"><input type="checkbox" name="tos" id="tos" checked=""></span></div><small>
            I agree to the <a id="terms-of-service" href="http://sweetreferrals.com/privacy-policy/">Terms of Service </a></small>
        </label>
        <span id="tos_error" class="help-block has-error"></span>
    </div>
    <div class="form-actions">
        <a href="index.php" id="register-back-btn" class="margin-top-20">Go back to login page</a>
        <Button class="btn btn-lg green-meadow rounded-4 col-sm-12" type="submit" >Sign Up</Button>
    </div>
    <div class="form-group nobottommargin">
        <p class="text-center check nobottommargin">Looking for our consumer site? <a href="http://sweetreferrals.com/" id="consumer-site">Click Here!</a></p>
    </div>
</form>
<a id="email-error-popup" class="hidden" data-toggle="modal" ></a>


          

        </div>
						
					';
					echo $html;
	
								include 'inc/footer.php';
								$html='</body></html>';
			echo $html;
	}
	
	function handle(){
		
		if (isset($_SESSION['loggedInSR'])){
		
			$this -> successfulLogin();
		}
		else if ((isset($_POST['firstNameSR']) ) && (isset($_POST['lastNameSR'])) && (isset($_POST['passwordConfirmSR'])) && (isset($_POST['passwordSR'])) && (isset($_POST['emailSR'])) && (isset($_POST['companySR']))){
			if($_POST['emailSR'] != null && $_POST['passwordSR'] != null && $_POST['passwordConfirmSR'] != null && $_POST['lastNameSR'] != null && $_POST['firstNameSR'] != null  && $_POST['companySR'] != null){

				$this->doLogin();
			}else{
				$this -> printLoginPage("Please fill all the fields");	
			}
			
			
		}
		else{
			// echo $_SESSION['type'];
			$this -> printLoginPage("");	
			}
		}
	
	}