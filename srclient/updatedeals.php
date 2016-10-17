<?php

session_start();


function updateUser(){
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
	
	$dealid = $_GET['username'];
	$query = "INSERT INTO `deal`(`kc_id`, `d_primary_staff`, `d_secondary_staff`, `d_stage`, `d_est_size`, `d_probability`, `d_weighted_forcast`, `d_expected_close_date`, `d_name`,`d_added_by`) 
						VALUES ('$kcontact','$pstaff','$pstaff','$stage','$estsize','$prob','$wforcast','$cdate','$name','$theid')";
	
	$query = "UPDATE `deal` SET `kc_id`='$kcontact',`d_primary_staff`='$pstaff',`d_secondary_staff`='$pstaff',`d_stage`='$stage',`d_est_size`='$estsize',`d_probability`='$prob',`d_weighted_forcast`='$wforcast',`d_expected_close_date`='$cdate',`d_name`='$name' WHERE `d_id`='$dealid'";
	$stmt = $db->query($query);
	$deal_idd = $dealid;
	
	$query = "INSERT INTO `deal_history`( `d_id`, `dh_stage`, `dh_estimated_size`, `dh_probability`, `dh_weighted_forcast`, `dh_expected_close_date`, `dh_added_by`) 
								VALUES ('$deal_idd','$stage','$estsize','$prob','$wforcast','$cdate','$theid')";
	$db->query($query);
	
	$query = "DELETE FROM `deal_staff` WHERE `d_id` = '$deal_idd'";
	$db->query($query);
	
	for($i=0 ; $i<12 ; $i++){
		if(isset($_POST['ostaff'.$i])){
			$otherstaff = $_POST['ostaff'.$i];
			$query = "INSERT INTO `deal_staff`(`d_id`, `s_id`) VALUES ('$deal_idd','$otherstaff')";
			$db->query($query);
		}
	}
	
	$query = "DELETE FROM `deal_product` WHERE `d_id` = '$deal_idd'";
	$db->query($query);
	
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
	
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/deals.php');
}


function printPage($error){

	include "database/db.php";
	$name = $_GET["username"];
	$get_details = $db->query("SELECT `d_id`, `deal`.`kc_id`, `staff`.s_id,`d_primary_staff`, `d_secondary_staff`, `d_stage`, `d_est_size`, `d_probability`, `d_weighted_forcast`, `d_expected_close_date`, `d_name`, `d_added_on`, `d_added_by`,`kc_name`,`s_name` ,`c_name`,`client`.c_id,day(`d_expected_close_date`) AS day, month(`d_expected_close_date`) AS month, year(`d_expected_close_date`) AS year	
				FROM `deal`,`key_contact`,`staff`,`client`
				WHERE `deal`.kc_id = `key_contact`.kc_id 
				AND `deal`.`d_primary_staff` = `staff`.s_id
				AND `key_contact`.c_id = `client`.c_id AND d_id = '$name'");
	
	if(!($row = $get_details->fetch_assoc())) {
		
		echo "INVALID USER NAME";
		return ;
	
	}
	
	$q2 = "SELECT `kc_id`, `kc_name`, `kc_position`, `kc_email`, `kc_mobile`, `kc_status`, `kc_added_by`, `kc_added_on`, `c_name` FROM `key_contact`,`client` WHERE `key_contact`.c_id = `client`.c_id";
	$s2 = $db->query($q2);
	//echo $q2;
	$clientOptions = "<option value=\"".$row['kc_id']."\">".$row['kc_name']." (".$row['c_name'].")</option>";
	while($r2 = $s2->fetch_assoc()){
		//echo "i was here";
		if($r2['kc_id'] == $row['kc_id']){continue;}
		//echo "seconldy";
		$clientOptions.="<option value=\"".$r2['kc_id']."\">".$r2['kc_name']." (".$r2['c_name'].")</option>";
	}
	
	$query2 = "SELECT `s_id`, `s_email`, `s_password`, `s_name`, `s_picture`, `s_post`, `s_address`, `s_city`, `s_added_by`, `s_added_on` FROM `staff` WHERE 1";
	$stmt2 = $db->query($query2);
	$staffOptions = "<option value=\"".$row['s_id']."\">".$row['s_name']."</option>";
	while($row2 = $stmt2->fetch_assoc()){
		if($row2['s_id'] == $row['s_id']){continue;}
		$staffOptions.="<option value=\"".$row2['s_id']."\">".$row2['s_name']."</option>";
	}
	

	// $name = $row["u_name"];
	$body = "	<div class=\"box\">
								<div class=\"box-header\">
								  <h3 class=\"box-title\">Deals</h3>
								</div>
								<!-- /.box-header -->
								<div class=\"box-body\">
							<form role=\"form\" method=\"post\" action=\"updatedeals.php?username=".$name."\">
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Name</label>
													<div class=\"col-sm-10\">
												<input value=\"".$row['d_name']."\" type=\"text\" name=\"name\" class=\"form-control input-sm\" placeholder=\"Name\" autofocus required>
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
												<input value=\"".$row['month']."/".$row['day']."/".$row['year']."\" id=\"datepicker\" type=\"text\" name=\"cdate\" class=\"form-control input-sm\"  required>
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
									";
									$query2 = "SELECT `d_id`, staff.`s_id`,`s_name` FROM `deal_staff`,`staff` WHERE `deal_staff`.s_id = `staff`.s_id AND d_id = '$name'";
									$stmt2 = $db->query($query2);
									$rowscount = $stmt2->num_rows;
									$othercount = 0;
									while($row2 = $stmt2->fetch_assoc()){
										$othercount++;
										$body.="<div id=\"otherstaffrow".$othercount."\" class=\"row\">
												<div class=\"col-xs-6 col-sm-6 col-md-6\">
													<div class=\"form-group\">
													<label class=\"col-sm-2 control-label\">Other Staff</label>
														<div class=\"col-sm-10\">
														<select type=\"text\" name=\"ostaff".$othercount."\" class=\"form-control select2 input-sm\">
															";
															$query3 = "SELECT `s_id`, `s_email`, `s_password`, `s_name`, `s_picture`, `s_post`, `s_address`, `s_city`, `s_added_by`, `s_added_on` FROM `staff` WHERE 1";
															$stmt3 = $db->query($query3);
															$body .= "<option value=\"".$row2['s_id']."\">".$row2['s_name']."</option>";
															while($row3 = $stmt3->fetch_assoc()){
																if($row3['s_id'] == $row2['s_id']){continue;}
																$body.="<option value=\"".$row3['s_id']."\">".$row3['s_name']."</option>";
															}
															$body.="
														</select>
													</div>
													</div>
												</div>
												<div id=\"otherstaffdiv".$othercount."\" class=\"col-xs-6 col-sm-6 col-md-6\">
													";
													if($rowscount == $othercount){
													$body.="<img onclick=\"addOtherStaff()\" style=\"cursor: pointer;\" src=\"assets/plus.png\" height=\"30\" width=\"30\" />";
													}
													else{
														$body.="<img onclick=\"removeStaff(".$othercount.")\" style=\"cursor: pointer;\" src=\"assets/cross.png\" height=\"30\" width=\"30\" />";
													}
													$body.="
												</div>
											</div>";
									}
									$body.="
										
									</div>
									
									<hr>
									
									<div id=\"productsMainDiv\">
										";
									$query2 = "SELECT `d_id`, products.`p_id`,`p_name`, `dp_price`, `dp_probability` FROM `deal_product`,`products` WHERE `deal_product`.p_id = `products`.p_id AND d_id = '$name'";
									$stmt2 = $db->query($query2);
									$rowscount = $stmt2->num_rows;
									$othercount = 0;
									while($row2 = $stmt2->fetch_assoc()){
										$othercount++;
										$body.="<div id=\"productsrow".$othercount."\" class=\"row\">
											<div class=\"col-xs-6 col-sm-6 col-md-6\">
												<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Product</label>
													<div class=\"col-sm-10\">
														<select type=\"text\" name=\"product".$othercount."\" class=\"form-control select2 input-sm\">
															";
															$query3 = "SELECT `p_id`, `p_name` FROM `products` WHERE 1";
															$stmt3 = $db->query($query3);
															$body .= "<option value=\"".$row2['p_id']."\">".$row2['p_name']."</option>";
															while($row3 = $stmt3->fetch_assoc()){
																if($row3['p_id'] == $row2['p_id']){continue;}
																$body.="<option value=\"".$row3['p_id']."\">".$row3['p_name']."</option>";
															}
															$body.="		
														</select>
													</div>
												</div>
											</div>
											<div class=\"col-xs-2 col-sm-2 col-md-2\">
												<input value=\"".$row2['dp_price']."\" onkeyup=\"validateNumber(this)\" type=\"text\" name=\"pprice".$othercount."\" class=\"form-control input-sm\" placeholder=\"Price\" required>
											</div>
											<div class=\"col-xs-2 col-sm-2 col-md-2\">
												<input value=\"".$row2['dp_probability']."\" onkeyup=\"validateNumber2(this)\" type=\"text\" name=\"pprob".$othercount."\" class=\"form-control input-sm\" placeholder=\"Probability (%)\" required>
											</div>
											<div id=\"productsdiv".$othercount."\" class=\"col-xs-2 col-sm-2 col-md-2\">
												";
												if($rowscount == $othercount){
													$body.="<img onclick=\"addOtherProduct()\" style=\"cursor: pointer;\" src=\"assets/plus.png\" height=\"30\" width=\"30\" />";
												}
												else{
													$body.="<img onclick=\"removeProduct(".$othercount.")\" style=\"cursor: pointer;\" src=\"assets/cross.png\" height=\"30\" width=\"30\" />";
												}
												$body.="
											</div>
										</div>";
										//echo "here i am here".$row2['dp_probability'];
									}
									$body.="
										
													
									</div>
									
									<hr>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Est. Size</label>
													<div class=\"col-sm-10\">
												<input value=\"".$row['d_est_size']."\"  readonly type=\"text\" name=\"estsize\" class=\"form-control input-sm\" placeholder=\"Estimated Size\" >
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Probability</label>
												<div class=\"col-sm-10\">
												<input value=\"".$row['d_probability']."\"  readonly type=\"text\" name=\"prob\" class=\"form-control input-sm\" placeholder=\"Probability\" >
											</div>
											</div>
										</div>
									</div>
									
									<div class=\"row\">
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
												<label class=\"col-sm-2 control-label\">Weighted Forcast</label>
													<div class=\"col-sm-10\">
												<input value=\"".$row['d_weighted_forcast']."\"  readonly type=\"text\" name=\"wforcast\" class=\"form-control input-sm\" placeholder=\"Weighted Forcast\" >
											</div>
											</div>
										</div>
										<div class=\"col-xs-6 col-sm-6 col-md-6\">
											<div class=\"form-group\">
											<label class=\"col-sm-2 control-label\">Stage</label>
												<div class=\"col-sm-10\">
												<input value=\"".$row['d_stage']."\"  type=\"text\" readonly name=\"stage\" class=\"form-control input-sm\">
													
												
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
										SweetReferrals | Update Deal
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
						Deal
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li><a href="deals.php"><i class="fa fa-keys"></i>Key Contacts</a></li>
						<li class="active"><a href="#">Update Deal</a></li>
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
			echo "	<script type=\"text/javascript\" src=\"js/adddeal.js\"></script></body>
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
				updateUser();
			}else{
				printPage("Please enter valid parameters");
			}
				
						
		}else {
			printPage("");
		}
}

				
