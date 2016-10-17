<?php

session_start();
if(!(isset($_SESSION['SRC_logged_in']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}

function addUser(){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$addr = $_POST['address'];
	$post = $_POST['post'];
	$email = $_POST['email'];
	$con_pass = $_POST['con_pass'];
	$city = $_POST['city'];
	if($pass == $con_pass){
		include "database/db.php";
		if($pass != ""){
			
			$pic = file_get_contents($_FILES['picture']['tmp_name']);
			$fileName = $_FILES["picture"]["name"];
			while (file_exists("profilepics/" .$fileName)) {
				$fileName = "2".$fileName;
			}
			file_put_contents("profilepics/" .$fileName,$pic);
			$pic = "profilepics/" . $_FILES["picture"]["name"];
	
			include "database/db.php";
			$pass = md5($pass);
			
			$theemail = $_SESSION['SRC_email'];
			$theid = $_SESSION['SRC_id'];
			$thename = $_SESSION['SRC_name'];
			$thepicture = $_SESSION['SRC_picture'];
			$thepost = $_SESSION['SRC_post'];
			$theadded = $_SESSION['SRC_added'];
	
			$query = "INSERT INTO `staff`(`s_email`, `s_password`, `s_name`, `s_address`, `s_post`,`s_picture`,`s_city`,`s_added_by`) 
										VALUES ('$email','$pass','$user','$addr','$post','$pic','$city','$theid')";
			$stmt = $db->query($query);
			
			$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$server = substr($server,0,strrpos($server,"/"));
			header('Location: http://'.$server.'/staff.php');
		}else{
			printPage("Passwords field cannot be empty !");
		}
	}
	else{
		printPage("Passwords did not match. Please try again !");
	}
}


function printPage($error){

	include "database/db.php";	
	$query = "SELECT `c_id`, `c_name`, `c_province`, `c_pro_abbr` FROM `cities` order by `c_name`";
	$stmt = $db->query($query);
	$citiess = "";
	while($row = $stmt->fetch_assoc()){
		$citiess.="<option value=\"".$row['c_name']."\">".$row['c_name']."</option>";
	}
	$db->close();
	
	$body = "
			
			
			
						<div class=\"box\">
								<div class=\"box-header\">
								  <h3 class=\"box-title\">Add Staff Member</h3>
								</div>
								<!-- /.box-header -->
								<div class=\"box-body\">
							<form role=\"form\" method=\"post\" action=\"adduser.php\" class\"form-horizontal\" enctype=\"multipart/form-data\">
									
									<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Name</label>
												<div class=\"col-sm-10\">
													<input type=\"text\" name=\"user\" id=\"user\" class=\"form-control input-sm\" placeholder=\"*Name\" autofocus required>
												</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Email</label>
												<div class=\"col-sm-10\">
												<input type=\"email\" name=\"email\" id=\"email\" class=\"form-control input-sm\" placeholder=\"*Email Address\" required>
												</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Address</label>
												<div class=\"col-sm-10\">
												<input type=\"text\" name=\"address\" id=\"address\" class=\"form-control input-sm\" placeholder=\"*Address\" required>
												</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">City</label>
												<div class=\"col-sm-10\">
												<select type=\"text\" name=\"city\" id=\"city\" class=\"form-control select2 input-sm\">
													".$citiess."</select>
												</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Picture</label>
												<div class=\"col-sm-10\">
												<input type=\"file\" name=\"picture\" id=\"picture\" class=\"form-control input-sm\" placeholder=\"*Picture\" required>
												</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Post</label>
												<div class=\"col-sm-10\">
												<input type=\"text\" name=\"post\" id=\"post\" class=\"form-control input-sm\" placeholder=\"*Post\" required>
												</div>
											</div>
										</div>
									</div>
								
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Password</label>
												<div class=\"col-sm-10\">
													<input type=\"password\" name=\"pass\" id=\"pass\" class=\"form-control input-sm\" placeholder=\"*Password\" required>
												</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Confirm Password</label>
												<div class=\"col-sm-10\">
												<input type=\"password\" name=\"con_pass\" id=\"con_pass\" class=\"form-control input-sm\" placeholder=\"*Confirm Password\" required>
												</div>
											</div>
										</div>
									</div>
									
								
									<div class=\"row\">
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<button style=\"width: 20%; margin-left: auto; margin-right: auto;\" type=\"button\" class=\"btn btn-danger btn-block\" onclick=\"cancel();\">Cancel</button>
											</div>
						
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<input style=\"width: 20%; margin-left: auto; margin-right: auto;\" type=\"submit\" value=\"Add\" class=\"btn btn-success btn-block\">
											</div>
											
									</div>
									<br>
									<div class=\"bg-danger text-center\">
									".$error."
									</div>
							</form>
						</div>
						</div>
					";
		
		
			$html = "<!DOCTYPE html>
							<html>
								<head>
					
								<title>
										SweetReferrals | Add Staff
								</title>";
			echo $html;
			include 'inc/headscripts.php';
								
			 $html="</head>
				  <body class=\"hold-transition skin-blue sidebar-mini\">
				  <div class=\"wrapper\">
							";
		
		
		///////////////////
		$username = $_SESSION['SRC_email'];
		echo $html;
		include 'inc/newheader.php';
		print_header("loggedin", $username, "");
		
		
			include 'inc/newsidebar.php';

		///////////////////	
	
		
	$html = '<div class="content-wrapper">
					
					<section class="content-header">
					  <h1>
						Staff
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li><a href="staff.php"><i class="fa fa-group"></i>Staff</a></li>
						<li class="active"><a href="adduser.php">Add Staff</a></li>
					  </ol>
					</section>

					<section class="content">';
					
			echo $html;
			echo $body;
										
			$html='				</section>
				  </div>';
	
		echo $html;
		include 'inc/newfooter.php';
			
			
			echo '<div class="control-sidebar-bg"></div>
					</div>';
			include 'inc/footerscripts.php';
			

			
			
			echo $html;
			echo "	</body>
					<script type=\"text/javascript\">
						function cancel(){
							var name = \"staff.php\";
							window.location = name;
						}
						$('.col-sm-6').css(\"margin-bottom\",\"10px\")
					</script>
					</html>
					";
			
		


}
if(isset($_SESSION['SRC_logged_in'])){

		if ((isset($_POST['user']) ) && 
			(isset($_POST['pass'])) && 
			(isset($_POST['con_pass']))
			){
			if($_POST['user'] != null && $_POST['pass'] != null){
				addUser();
			}else{
				printPage("Please enter valid parameters");
			}
				
						
		}else {
			printPage("");
		}
}

				
