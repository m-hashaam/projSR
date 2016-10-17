<?php

session_start();
if(!(isset($_SESSION['SRC_logged_in']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}

function addUser(){
	$name = $_POST['name'];
	$kcontact = $_POST['kcontact'];
	$pstaff = $_POST['pstaff'];
	$estsize = $_POST['estsize'];
	$prob = $_POST['prob'];
	$wforcast = $_POST['wforcast'];
	$cdate = $_POST['cdate'];
	$stage = $_POST['stage'];
	if($name == ""){
		printPage("Name cannot be empty !");
		return;
	}
	if($estsize == ""){
		printPage("Product price and probability should not be empty !");
		return;
	}
	if($prob == ""){
		printPage("Product price and probability should not be empty !");
		return;
	}
	if($wforcast == ""){
		printPage("Product price and probability should not be empty !");
		return;
	}
	if($cdate == ""){
		printPage("Estimated Close Date cannot be empty !");
		return;
	}
	$sdate = $cdate;
	$month = substr($sdate,0,strpos($sdate,"/")) or die("Invalid Date");
	$sdate = substr($sdate,strpos($sdate,"/")+1,strlen($sdate)) or die("Invalid Date");
	$day = substr($sdate,0,strpos($sdate,"/")) or die("Invalid Date");
	$sdate = substr($sdate,strpos($sdate,"/")+1,strlen($sdate)) or die("Invalid Date");
	$year = $sdate or die("Invalid Date");
	$cdate = $year."-".$month."-".$day;
	
	$theemail = $_SESSION['SRC_email'];
	$theid = $_SESSION['SRC_id'];
	$thename = $_SESSION['SRC_name'];
	$thepicture = $_SESSION['SRC_picture'];
	$thepost = $_SESSION['SRC_post'];
	$theadded = $_SESSION['SRC_added'];
	
	include "database/db.php";
	$query = "INSERT INTO `deal`(`kc_id`, `d_primary_staff`, `d_secondary_staff`, `d_stage`, `d_est_size`, `d_probability`, `d_weighted_forcast`, `d_expected_close_date`, `d_name`,`d_added_by`) 
						VALUES ('$kcontact','$pstaff','$pstaff','$stage','$estsize','$prob','$wforcast','$cdate','$name','$theid')";
	$stmt = $db->query($query);
	$deal_idd = $db->insert_id;
	
	$query = "INSERT INTO `deal_history`( `d_id`, `dh_stage`, `dh_estimated_size`, `dh_probability`, `dh_weighted_forcast`, `dh_expected_close_date`, `dh_added_by`) 
								VALUES ('$deal_idd','$stage','$estsize','$prob','$wforcast','$cdate','$theid')";
	$db->query($query);
	for($i=0 ; $i<12 ; $i++){
		if(isset($_POST['ostaff'.$i])){
			$otherstaff = $_POST['ostaff'.$i];
			$query = "INSERT INTO `deal_staff`(`d_id`, `s_id`) VALUES ('$deal_idd','$otherstaff')";
			$db->query($query);
		}
	}
	
	for($i=0 ; $i<12 ; $i++){
		if(isset($_POST['product'.$i])){
			$product = $_POST['product'.$i];
			$price = $_POST['pprice'.$i];
			$prob = $_POST['pprob'.$i];
			$query = "INSERT INTO `deal_product`(`d_id`, `p_id`, `dp_price`, `dp_probability`) 
										VALUES ('$deal_idd','$product','$price','$prob')";
			$db->query($query);
		}
	}
	
	$db->close();
	//echo $query;
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/deals.php');
	
	
}


function printPage($error){
	
	include "database/db.php";
	$query = "SELECT `kc_id`, `kc_name`,`c_name` FROM `key_contact`,`client` WHERE `key_contact`.`c_id` = `client`.`c_id`";
	$stmt = $db->query($query);
	$clientOptions = "";
	while($row = $stmt->fetch_assoc()){
		$clientOptions.="<option value='".$row['kc_id']."'>".$row['kc_name']." (".$row['c_name'].")</option>";
	}
	
	$query = "SELECT `s_id`, `s_name` FROM `staff` WHERE 1";
	$stmt = $db->query($query);
	$staffOptions = "";
	while($row = $stmt->fetch_assoc()){
		$staffOptions.="<option value='".$row['s_id']."'>".$row['s_name']."</option>";
	}
	
	$query = "SELECT `p_id`, `p_name` FROM `products` WHERE 1";
	$stmt = $db->query($query);
	$productOptioins = "";
	while($row = $stmt->fetch_assoc()){
		$productOptioins.="<option value='".$row['p_id']."'>".$row['p_name']."</option>";
	}
	$db->close();

			
	$body = "	<div class=\"box\">
								<div class=\"box-header\">
								  <h3 class=\"box-title\">Add Deal</h3>
								</div>
								<!-- /.box-header -->
								<div class=\"box-body\">
							<form role=\"form\" method=\"post\" action=\"adddeal.php\">
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
											<label class=\"col-sm-2 control-label\">Key Contact</label>
												<div class=\"col-sm-10\">
												<select name=\"kcontact\" class=\"form-control input-sm\">
												".$clientOptions."
												</select>
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
									<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Expected Close Date</label>
												<div class=\"col-sm-10\">
												<input id=\"datepicker\" type=\"text\" name=\"cdate\" class=\"form-control input-sm\"  required>
											</div>
											</div>
										</div>
										
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Primary Staff</label>
												<div class=\"col-sm-10\">
												<select name=\"pstaff\" class=\"form-control input-sm\" >
												".$staffOptions."
												</select>
											</div>
											</div>
										</div>
									</div>
									
									<hr>
									
									<div id=\"otherStaffMainDiv\">
										<div id=\"otherstaffrow1\" class=\"row\">
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Other Staff</label>
													<div class=\"col-sm-10\">
													<select type=\"text\" name=\"ostaff1\" class=\"form-control select2 input-sm\">
														".$staffOptions."
													</select>
												</div>
												</div>
											</div>
											<div id=\"otherstaffdiv1\" class=\"col-xs-6 col-sm-6 col-md-6\">
												<img onclick=\"addOtherStaff()\" style=\"cursor: pointer;\" src=\"assets/plus.png\" height=\"30\" width=\"30\" />
											</div>
										</div>
									</div>
									
									<hr>
									
									<div id=\"productsMainDiv\">
										<div id=\"productsrow1\" class=\"row\">
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Product</label>
													<div class=\"col-sm-10\">
														<select type=\"text\" name=\"product1\" class=\"form-control select2 input-sm\">
															".$productOptioins."
														</select>
													</div>
												</div>
											</div>
											<div class=\"col-xs-2 col-sm-2 col-md-2\">
												<input onkeyup=\"validateNumber(this)\" type=\"text\" name=\"pprice1\" class=\"form-control input-sm\" placeholder=\"Price\" required>
											</div>
											<div class=\"col-xs-2 col-sm-2 col-md-2\">
												<input onkeyup=\"validateNumber2(this)\" type=\"text\" name=\"pprob1\" class=\"form-control input-sm\" placeholder=\"Probability (%)\" required>
											</div>
											<div id=\"productsdiv1\" class=\"col-xs-2 col-sm-2 col-md-2\">
												<img onclick=\"addOtherProduct()\" style=\"cursor: pointer;\" src=\"assets/plus.png\" height=\"30\" width=\"30\" />
											</div>
										</div>
									</div>
									
									<hr>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Est. Size</label>
													<div class=\"col-sm-10\">
												<input readonly type=\"text\" name=\"estsize\" class=\"form-control input-sm\" placeholder=\"Estimated Size\" >
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Probability</label>
												<div class=\"col-sm-10\">
												<input readonly type=\"text\" name=\"prob\" class=\"form-control input-sm\" placeholder=\"Probability\" >
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Weighted Forcast</label>
													<div class=\"col-sm-10\">
												<input readonly type=\"text\" name=\"wforcast\" class=\"form-control input-sm\" placeholder=\"Weighted Forcast\" >
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Stage</label>
												<div class=\"col-sm-10\">
												<input type=\"text\" readonly name=\"stage\" class=\"form-control input-sm\">
													
												
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
										SweetReferrals | Add Deal
								</title>
								
								";
			echo $html;
			include 'inc/headscripts.php';
								
			 $html="
			
			 </head>
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
						 Deals
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li><a href="deals.php"><i class="fa fa-suitcase"></i>Deals</a></li>
						<li class="active"><a href="adddeal.php">Add Deal</a></li>
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
			echo "	 <script type=\"text/javascript\" src=\"js/adddeal.js\"></script></body>
					<script type=\"text/javascript\">
						function cancel(){
							var name = \"deals.php\";
							window.location = name;
						}
						$('.col-sm-6').css(\"margin-bottom\",\"10px\")
					</script>
					</html>
					";
			


}
if(isset($_SESSION['SRC_logged_in'])){

		if ((isset($_POST['name']) ) && 
			(isset($_POST['kcontact'])) && 
			(isset($_POST['pstaff']))
			){
			if($_POST['name'] != null && $_POST['kcontact'] != null){
				addUser();
			}else{
				printPage("Please enter valid parameters");
			}
				
						
		}else {
			printPage("");
		}
}
?>


				
