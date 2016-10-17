<?php

session_start();


function updateUser(){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];
	$addr = $_POST['address'];
	$post = $_POST['post'];
	$con_pass = $_POST['con_pass'];
	$city = $_POST['city'];
	if($pass == $con_pass){
		include "database/db.php";
		$idd = $_GET["username"];
		$query = "SELECT `s_email` FROM `staff` WHERE `s_id` = '$idd'";
		$stmt = $db->query($query);
		if($row = $stmt->fetch_assoc()){
			$prev_name = $row['s_email'];
		}
		
		$stmt = $db->prepare("SELECT `s_email` FROM `staff` WHERE `s_email` =  ? ")
		or die("Unable to communicate with database");
			
			
		// Bind the input parameters to the prepared statement
		$stmt->bind_param('s', $email);
		
		// Execute the query
		$stmt->execute();
		
		// Store the result so we can determine how many rows have been returned
		$stmt->store_result();
		
		if (($stmt->num_rows == 1 ) && ($email != $prev_name)) {
			printPage("Email Already Exists !");
		}else{
		
			if($_FILES['picture']['error']==0){
				$pic = file_get_contents($_FILES['picture']['tmp_name']);
				$fileName = $_FILES["picture"]["name"];
				while (file_exists("profilepics/" .$fileName)) {
					$fileName = "2".$fileName;
				}
				file_put_contents("profilepics/" .$fileName,$pic);
				$pic = "profilepics/" . $_FILES["picture"]["name"];
				if($pass == ""){
					$query = "UPDATE `staff` SET `s_email`='$email',`s_name`='$user',`s_address`='$addr',`s_picture` = '$pic',`s_city` = '$city',`s_post`='$post' WHERE `s_id` = '$idd'";
				}
				else{
					$enctypedPassword = md5($pass);
					$query = "UPDATE `staff` SET `s_email`='$email',`s_password`='$enctypedPassword',`s_picture` = '$pic',`s_city` = '$city',`s_name`='$user',`s_address`='$addr',`s_post`='$post' WHERE `s_id` = '$idd'";
				}
			}
			else{
				if($pass == ""){
					$query = "UPDATE `staff` SET `s_email`='$email',`s_name`='$user',`s_city` = '$city',`s_address`='$addr',`s_post`='$post' WHERE `s_id` = '$idd'";
				}
				else{
					$enctypedPassword = md5($pass);
					$query = "UPDATE `staff` SET `s_email`='$email',`s_password`='$enctypedPassword',`s_city` = '$city',`s_name`='$user',`s_address`='$addr',`s_post`='$post' WHERE `s_id` = '$idd'";
				}
			}
			
			
			$stmt = $db->query($query) or DIE ("Update Admin : Unable to communicate with Database");
			
	
	
			$server = $_SERVER['SERVER_NAME'];
			$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$server = substr($server,0,strrpos($server,"/"));
			header('Location: http://'.$server.'/staff.php');
		}
	}else{
		printPage("Passwords did not match. Please try again !");
	}
}


function printPage($error){

	include "database/db.php";
	$name = $_GET["username"];
	$get_details = $db->query("SELECT `s_id`, `s_email`, `s_password`, `s_name`, `s_address`,`s_city`, `s_post` FROM `staff` WHERE `s_id` = '$name'");
	
	if(!($row = $get_details->fetch_assoc())) {
		
		echo "INVALID USER NAME";
		return ;
	
	}
	
	$query2 = "SELECT `c_id`, `c_name`, `c_province`, `c_pro_abbr` FROM `cities` order by `c_name`";
	$stmt2 = $db->query($query2);
	$citiess = "<option value=\"".$row['s_city']."\">".$row['s_city']."</option>";
	while($row2 = $stmt2->fetch_assoc()){
		$citiess.="<option value=\"".$row2['c_name']."\">".$row2['c_name']."</option>";
	}
	
	// $name = $row["u_name"];
	$body = "<div class=\"box\">
								<div class=\"box-header\">
								  <h3 class=\"box-title\">Update Staff Member</h3>
								</div>
								<!-- /.box-header -->
								<div class=\"box-body\">
							<form role=\"form\" enctype=\"multipart/form-data\" method=\"post\" action=\"updateadmin.php?username=$name\">
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Name</label>
												<div class=\"col-sm-10\">
													<input value=\"".$row["s_name"]."\" type=\"text\" name=\"user\" id=\"user\" class=\"form-control input-sm\" placeholder=\"*Name\" autofocus required>
												</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Email</label>
												<div class=\"col-sm-10\">
												<input value=\"".$row["s_email"]."\" type=\"email\" name=\"email\" id=\"email\" class=\"form-control input-sm\" placeholder=\"*Email Address\" required>
												</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Address</label>
												<div class=\"col-sm-10\">
												<input value=\"".$row["s_address"]."\" type=\"text\" name=\"address\" id=\"address\" class=\"form-control input-sm\" placeholder=\"*Address\" required>
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
												<input value=\"".$row["s_post"]."\" type=\"text\" name=\"post\" id=\"post\" class=\"form-control input-sm\" placeholder=\"*Post\" required>
												</div>
											</div>
										</div>
									</div>
								
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Password</label>
												<div class=\"col-sm-10\">
													<input type=\"password\" name=\"pass\" id=\"pass\" class=\"form-control input-sm\" placeholder=\"*Password\" >
												</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Confirm Password</label>
												<div class=\"col-sm-10\">
												<input type=\"password\" name=\"con_pass\" id=\"con_pass\" class=\"form-control input-sm\" placeholder=\"*Confirm Password\" >
												</div>
											</div>
										</div>
									</div>
								
									<div class=\"row\">
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<button style=\"width: 20%; margin-left: auto; margin-right: auto;\" type=\"button\" class=\"btn btn-danger btn-block\" onclick=\"cancel();\">Cancel</button>
											</div>
						
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<input style=\"width: 20%; margin-left: auto; margin-right: auto;\" type=\"submit\" value=\"Update\" class=\"btn btn-success btn-block\">
											</div>
											
									</div>
									<br>
									<div class=\"bg-info text-center\">
									Leave the password fields blank if you do not want to change it.
									</div>
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
										SweetReferrals | Update Staff
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
						<li class="active"><a href="#">Update Staff</a></li>
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
			if($_POST['user'] != null ){
				updateUser();
			}else{
				printPage("Please enter valid parameters");
			}
				
						
		}else {
			printPage("");
		}
}

				
