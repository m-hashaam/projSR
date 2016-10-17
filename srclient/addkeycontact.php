<?php

session_start();
if(!(isset($_SESSION['SRC_logged_in']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}

function addUser(){
	$name = $_POST['name'];
	$position = $_POST['position'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$status = $_POST['status'];
	$client = $_POST['client'];
	if($name == ""){
		printPage("Name cannot be empty !");
		return;
	}
	if($position == ""){
		printPage("Position Line cannot be empty !");
		return;
	}
	if($email == ""){
		printPage("Email cannot be empty !");
		return;
	}
	if($mobile == ""){
		printPage("Mobile cannot be empty !");
		return;
	}
	
	$theemail = $_SESSION['SRC_email'];
	$theid = $_SESSION['SRC_id'];
	$thename = $_SESSION['SRC_name'];
	$thepicture = $_SESSION['SRC_picture'];
	$thepost = $_SESSION['SRC_post'];
	$theadded = $_SESSION['SRC_added'];
	
	include "database/db.php";
	$query = "INSERT INTO `key_contact`(`kc_name`, `kc_position`, `kc_email`, `kc_mobile`, `kc_status`, `kc_added_by`, `c_id`) 
								VALUES ('$name','$position','$email','$mobile','$status','$theid','$client')";
	$stmt = $db->query($query);
	$kc_idd = $db->insert_id;
	$query = "INSERT INTO `key_contact_history`(`kc_id`, `kch_status`, `kch_added_by`) VALUES ('$kc_idd','$status','$theid')";
	$db->query($query);
	$db->close();
	//echo $query;
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/keycontacts.php');
	
	
}


function printPage($error){
	
	include "database/db.php";	
	$query = "SELECT `c_id`, `c_name` FROM `client` WHERE 1";
	$stmt = $db->query($query);
	$citiess = "";
	while($row = $stmt->fetch_assoc()){
		$citiess.="<option value=\"".$row['c_id']."\">".$row['c_name']."</option>";
	}
	$db->close();

			
	$body = "	<div class=\"box\">
								<div class=\"box-header\">
								  <h3 class=\"box-title\">Add Key Contact</h3>
								</div>
								<!-- /.box-header -->
								<div class=\"box-body\">
							<form role=\"form\" method=\"post\" action=\"addkeycontact.php\">
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Name</label>
													<div class=\"col-sm-10\">
												<input type=\"text\" name=\"name\" class=\"form-control input-sm\" placeholder=\"Name\" autofocus required>
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Position</label>
												<div class=\"col-sm-10\">
												<input type=\"text\" name=\"position\" class=\"form-control input-sm\" placeholder=\"Position\" required>
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Email</label>
												<div class=\"col-sm-10\">
												<input type=\"mail\" name=\"email\" class=\"form-control input-sm\" placeholder=\"Email\">
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Mobile</label>
												<div class=\"col-sm-10\">
												<input type=\"text\" name=\"mobile\" class=\"form-control input-sm\" placeholder=\"Mobile\" required>
											</div>
											</div>
										</div>
									</div>
									
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Status</label>
												<div class=\"col-sm-10\">
												<select type=\"text\" name=\"status\" id=\"client\" class=\"form-control select2 input-sm\">
													<option value\"Open\">Open</option>
													<option value\"Left\">Left</option>
													<option value\"Do not contact\">Do not contact</option>
												</select>
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Client</label>
												<div class=\"col-sm-10\">
												<select type=\"text\" name=\"client\" id=\"client\" class=\"form-control select2 input-sm\">
													".$citiess."</select>
												</div>
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
										SweetReferrals | Add Key Contact
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
						Key Contacts
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li><a href="keycontacts.php"><i class="fa fa-key"></i>Key Contacts</a></li>
						<li class="active"><a href="addkeycontact.php">Add Key Contact</a></li>
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
							var name = \"keycontacts.php\";
							window.location = name;
						}
						$('.col-sm-6').css(\"margin-bottom\",\"10px\")
					</script>
					</html>
					";
			


}
if(isset($_SESSION['SRC_logged_in'])){

		if ((isset($_POST['name']) ) && 
			(isset($_POST['position'])) && 
			(isset($_POST['email']))
			){
			if($_POST['name'] != null && $_POST['email'] != null){
				addUser();
			}else{
				printPage("Please enter valid parameters");
			}
				
						
		}else {
			printPage("");
		}
}

				
