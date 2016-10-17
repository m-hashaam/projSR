<?php

session_start();


function updateUser(){
	$name = $_POST['name'];
	$bline = $_POST['bline'];
	$sector = $_POST['sector'];
	$contact = $_POST['contact'];
	$ebuyer = $_POST['ebuyer'];
	$tbuyer = $_POST['tbuyer'];
	$ubuyer = $_POST['ubuyer'];
	$web = $_POST['web'];
	$addr = $_POST['addr'];
	$city = $_POST['city'];
	$social = $_POST['social'];
	$referral = $_POST['referral'];
	if($name == ""){
		printPage("Name cannot be empty !");
		return;
	}
	if($bline == ""){
		printPage("Business Line cannot be empty !");
		return;
	}
	if($sector == ""){
		printPage("Sector cannot be empty !");
		return;
	}
	if($contact == ""){
		printPage("Contact cannot be empty !");
		return;
	}
	
	$cid = $_GET["username"];
	
	include "database/db.php";
	
	$query = "UPDATE `client` SET `c_name`='$name',`c_business_line`='$bline',`c_referrals_source` = '$referral',`c_sector`='$sector',`c_contact`='$contact',`c_ec_buyer`='$ebuyer',`c_tech_buyer`='$tbuyer',`c_user_buyer`='$ubuyer',`c_web`='$web',`c_social`='$social',`c_address` = '$addr',`c_city` = '$city' WHERE `c_id`='$cid'";
	$stmt = $db->query($query);
	
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/clients.php');
}


function printPage($error){

	include "database/db.php";
	$name = $_GET["username"];
	$get_details = $db->query("SELECT `c_id`, `c_name`, `c_business_line`, `c_sector`, `c_contact`, `c_ec_buyer`, `c_user_buyer`, `c_tech_buyer`, `c_web`, `c_social`, `c_address`, `c_city`, `c_referrals_source`, `c_added_by`, `c_added_on` FROM `client` WHERE `c_id` = '$name'");
	
	if(!($row = $get_details->fetch_assoc())) {
		
		echo "INVALID USER NAME";
		return ;
	
	}
	
	$query2 = "SELECT `c_id`, `c_name`, `c_province`, `c_pro_abbr` FROM `cities` order by `c_name`";
	$stmt2 = $db->query($query2);
	$citiess = "<option value=\"".$row['c_city']."\">".$row['c_city']."</option>";
	while($row2 = $stmt2->fetch_assoc()){
		$citiess.="<option value=\"".$row2['c_name']."\">".$row2['c_name']."</option>";
	}
	// $name = $row["u_name"];
	$body = "	<div class=\"box\">
								<div class=\"box-header\">
								  <h3 class=\"box-title\">Update Client</h3>
								</div>
								<!-- /.box-header -->
								<div class=\"box-body\">
							<form role=\"form\" method=\"post\" action=\"updateclient.php?username=".$name."\">
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-4 control-label\">Company Name</label>
													<div class=\"col-sm-8\">
												<input value=\"".$row['c_name']."\" type=\"text\" name=\"name\" class=\"form-control input-sm\" placeholder=\"*Company Name\" autofocus required>
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Business Line</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_business_line']."\" type=\"text\" name=\"bline\" class=\"form-control input-sm\" placeholder=\"*Business Line\" required>
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Referral</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_referrals_source']."\" type=\"text\" name=\"referral\" class=\"form-control input-sm\" placeholder=\"Referral\">
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Sector</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_sector']."\"  type=\"text\" name=\"sector\" class=\"form-control input-sm\" placeholder=\"*Sector\" required>
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Contact</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_contact']."\"  type=\"text\" name=\"contact\" class=\"form-control input-sm\" placeholder=\"*Contact\" required>
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Economic Buyer</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_ec_buyer']."\"  type=\"text\" name=\"ebuyer\" class=\"form-control input-sm\" placeholder=\"Economic Buyer\">
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Tech Buyer</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_tech_buyer']."\"  type=\"text\" name=\"tbuyer\" class=\"form-control input-sm\" placeholder=\"Comma Separated Values\">
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">User Buyer</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_user_buyer']."\" type=\"text\" name=\"ubuyer\" class=\"form-control input-sm\" placeholder=\"User Buyer\">
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Web</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_web']."\" type=\"text\" name=\"web\" class=\"form-control input-sm\" placeholder=\"Web\">
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Social</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_social']."\"  type=\"text\" name=\"social\" class=\"form-control input-sm\" placeholder=\"Social\">
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">Address</label>
												<div class=\"col-sm-8\">
												<input value=\"".$row['c_address']."\"  type=\"text\" name=\"addr\" class=\"form-control input-sm\" placeholder=\"Address\">
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-4 control-label\">City</label>
												<div class=\"col-sm-8\">
												<select type=\"text\" name=\"city\" id=\"city\" class=\"form-control select2 input-sm\">
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
												<input style=\"width: 20%; margin-left: auto; margin-right: auto;\" type=\"submit\" value=\"Update\" class=\"btn btn-success btn-block\">
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
										SweetReferrals | Update Client
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
						Clients
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li><a href="clients.php"><i class="fa fa-group"></i>Clients</a></li>
						<li class="active"><a href="#">Update Client</a></li>
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
							var name = \"clients.php\";
							window.location = name;
						}
						$('.col-sm-6').css(\"margin-bottom\",\"10px\")
					</script>
					</html>
					";


}
if(isset($_SESSION['SRC_logged_in'])){

		if ((isset($_POST['name']) ) && 
			(isset($_POST['tbuyer'])) && 
			(isset($_POST['ebuyer']))
			){
			if($_POST['name'] != null && $_POST['tbuyer'] != null){
				updateUser();
			}else{
				printPage("Please enter valid parameters");
			}
				
						
		}else {
			printPage("");
		}
}

				
