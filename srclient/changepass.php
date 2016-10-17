<?php

session_start();
if(!(isset($_SESSION['SRC_logged_in']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}



function changePass(){
	
	$pass = $_POST['pass'];
	$new_pass = $_POST['new_pass'];
	$username = $_SESSION['SRC_email'];

	if($pass == $new_pass){
		include "database/db.php";
		$pass = md5($pass);
			$query = "UPDATE `admin` SET `u_password` = '$pass' WHERE `u_username` = '$username';";
			$stmt = $db->query($query) or DIE ("Change PASSWORD : Unable to communicate with Database");
	
		ECHO $query . $stmt;	
	
			$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$server = substr($server,0,strrpos($server,"/"));
			header('Location: http://'.$server.'/index.php');
	
	}else{
		printPage("Passwords did not match. Please try again !");
	}
}


function printPage($error){

	
	$body = "<div class=\"container\">
				<ol class=\"breadcrumb\">
					  
 			<img src=\"assets/home.png\" height=\"15\" width=\"15\"> 
					  <li>Home</li>
					  <li class=\"active\">Change Password</li>
					</ol>
			</div>
	
	<div class=\"container\" >
			
			
			<div style = \"padding-top:4%;\" class=\"row centered-form \">
				<div class=\"col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4\">
					<div class=\"shadow-box panel panel-default\">
						<div class=\"panel-heading text-center\">
							<h2>Change Password</h2>
						</div>
						<div class=\"panel-body\">
							<form role=\"form\" method=\"post\" action=\"changepass.php\">
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<input type=\"password\" name=\"pass\" id=\"pass\" class=\"form-control input-sm\" placeholder=\"New Password\" autofocus required>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<input type=\"password\" name=\"new_pass\" id=\"new_pass\" class=\"form-control input-sm\" placeholder=\"Confirm Password\" required>
											</div>
										</div>
									</div>
								
								
								
									<div class=\"row\">
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<button type=\"button\" class=\"btn btn-danger btn-block\" onclick=\"cancel();\">Cancel</button>
											</div>
						
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<input type=\"submit\" value=\"Change Password\" class=\"btn btn-success btn-block\">
											</div>
											
									</div>
									<br>
									<div class=\"bg-danger text-center\">
									".$error."
									</div>
							</form>
						</div>
					</div>
				</div>
		</div>
</div>";
		
		
			$html = "<!DOCTYPE html>
							<html>
								<head>
					
								<link rel=\"stylesheet\" href=\"css/bootstrap.css\">
								<link href=\"css/simple-sidebar.css\" rel=\"stylesheet\">
								
								<script type=\"text/javascript\" src=\"js/jquery.min.js\" ></script>
								<script type=\"text/javascript\" src=\"js/bootstrap-min.js\" ></script>
								<script type=\"text/javascript\" src=\"js/velocity.min.js\"></script>
								<script type=\"text/javascript\" src=\"js/sidebar.js\"></script>
								<title>
										SweetReferrals | Admin Portal | Change Password
								</title>
								
								</head>
								<body>
								
								
								";
		
		
		///////////////////
		echo $html;
		$username = $_SESSION['SRC_email'];
		include 'inc/header.php';
		print_header("loggedin", $username, "changepass");

		///////////////////	
	
		
		$html = "
		<div id=\"wrapper\">";
		
						
		echo $html;
			include 'inc/sidebar.php';
		
				$html = "<div class=\"container\">
					<ol class=\"breadcrumb\">
						  
				<img src=\"assets/home.png\" height=\"15\" width=\"15\"> 
						  <li class=\"active\">Home</li>
						</ol>
				</div>";

		///////////////////	
	
		
	$html = "
			
								
										". $body ."
								
										</div>";
										
			include 'inc/footer.php';
			echo $html;
			echo "	</body>
					<script type=\"text/javascript\">
						function cancel(){
							var name = \"index.php\";
							window.location = name;
						}
					</script>
					</html>
					";
			
		


}


		if ( 
			(isset($_POST['pass'])) && 
			(isset($_POST['new_pass']))
			){
			if($_POST['pass'] != null && $_POST['new_pass'] != null){
				echo "";
				changePass();
			}else{
				printPage("Password Mismatch");
				echo "";
			}
				
						
		}else {
			printPage("");
			echo "";
		}


				