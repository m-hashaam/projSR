<?php

session_start();
include "db.php";

if(isset($_SESSION['SRC_logged_in'])){

	
	if ($_POST['func'] == "changestage"){
		$dealid = $_POST['dealid'];
		$stage = $_POST['stage'];
		
		$query = "UPDATE `deals` SET `d_sale_stages`='$stage' WHERE `d_id`='$dealid'";
		echo $query;
		$stmt = $db->query($query);
	}
	else if ($_POST['func'] == "getStaff"){
		
		
		$query = "SELECT `s_id`, `s_email`, `s_password`, `s_name`, `s_picture`, `s_post`, `s_address`, `s_city`, `s_added_by`, `s_added_on` FROM `staff` WHERE 1";
		$stmt = $db->query($query);
		$toReturn = "";
		while($row = $stmt->fetch_assoc()){
			$toReturn .= "<option value=\"".$row['s_id']."\">".$row['s_name']."</option>";
		}
		echo $toReturn;
	}
	else if ($_POST['func'] == "getProducts"){
		
		
		$query = "SELECT `p_id`, `p_name` FROM `products` WHERE 1";
		$stmt = $db->query($query);
		$toReturn = "";
		while($row = $stmt->fetch_assoc()){
			$toReturn .= "<option value=\"".$row['p_id']."\">".$row['p_name']."</option>";
		}
		echo $toReturn;
	}
	else if ($_POST['func'] == "getProductCount"){
		$did = $_POST['did'];
		
		$query = "SELECT count(`dp_price`) AS thecounts FROM `deal_product` WHERE d_id = '$did'";
		$stmt = $db->query($query);
		if($row = $stmt->fetch_assoc()){
			echo $row['thecounts'];
		}
		else{
			echo "0";
		}
	}
	
	else if ($_POST['func'] == "getOStaffCount"){
		$did = $_POST['did'];
		
		$query = "SELECT count(`d_id`) AS thecounts FROM `deal_staff` WHERE  d_id = '$did'";
		$stmt = $db->query($query);
		if($row = $stmt->fetch_assoc()){
			echo $row['thecounts'];
		}
		else{
			echo "0";
		}
	}
	
}
$db->close();