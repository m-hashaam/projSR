<?php

class Login {
		
	function successfulLogin(){
		
		require_once 'main.php';
		$main = new main();
		$main->welcome();
	
	}
	
	function doLogin(){
	
		
		include "database/db.php";
		
		$username = $_POST['user'];
		$password = $_POST['pass'];
	 
	  $encryptedPassword = md5($password);
		 
	  
	  $query = "SELECT `s_id`, `s_email`, `s_password`, `s_name`, `s_picture`, `s_post`, `s_address`, `s_city`, `s_added_by`, `s_added_on` FROM `staff` WHERE s_email = '$username' and s_password = '$encryptedPassword'";
	  //echo $query;
	  
	  $result = $db->query($query) or die("Unable to communicate with database");
	  //echo $query;
		  
	  
	  if ($row = $result->fetch_assoc()) {
		

		
		$_SESSION['SRC_email'] = $username;
		$_SESSION['SRC_id'] = $row['s_id'];
		$_SESSION['SRC_name'] = $row['s_name'];
		$_SESSION['SRC_picture'] = $row['s_picture'];
		$_SESSION['SRC_post'] = $row['s_post'];
		$_SESSION['SRC_added'] = $row['s_added_on'];
		$_SESSION['SRC_logged_in'] = 1;
		
		
		$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$server = substr($server,0,strrpos($server,"/"));
		header('Location: http://'.$server.'/index.php');
	  }else{
		$this->printLoginPage("Invalid Username or Password");
	  }
	    
	}
	
	function printLoginPage($error){
		
		
		$body = "		<div  class=\"form-signin wrapper\" id=\"loginFormDiv\">
							<h1 class=\"text-center top-align \">Welcome</h1>
								<br>
								<form  role=\"form\" method=\"post\" action=\"index.php\" >
										
										
										
											<input id=\"login-username\" type=\"text\" id =\"user\" class=\"form-control\" name=\"user\" placeholder=\"Enter Username\" required autofocus>
										
						
											<br>
											
											<input id=\"login-username\" type=\"password\" id =\"pass\" class=\"form-control\" name=\"pass\" placeholder=\"Enter Password\" required >
									
													
													
												
										<br>
										<div class=\"text-center \" >
											<Button class=\"btn btn-success btn-block\" type=\"submit\" >Login</Button>
										</div>	
										<br>
									<div class=\"bg-danger text-center\">
									".$error."
									</div>
								</form>
						</div>
							";
		
		
			$html = '<!DOCTYPE html>
							<html>
								<head>
									<link rel="stylesheet" href="css/bootstrap.min.css">
									<link rel="stylesheet" href="css/mystyle.css">
									<title>
										Sweet Referrals Admin Portal
									</title>
								</head>
								<body>';
								echo $html;
								include 'inc/header.php';
								
								print_header("login", "Admin", "home");
								
								
								echo $body;
								include 'inc/footer.php';
								$html='
								</body>
							</html>
								';
			echo $html;
	}
	
	function handle(){
		
		if (isset($_SESSION['SRC_logged_in'])){
			$this -> successfulLogin();
		}
		else if ((isset($_POST['user']) ) && (isset($_POST['pass']))){
			if($_POST['user'] != null && $_POST['pass'] != null){

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