<?php

session_start();
include "db.php";

if(isset($_SESSION['SRC_logged_in'])){

	
	if ($_POST['func'] == "removeAdmin"){
		$id = $_POST['id'];
		$query = "DELETE FROM `staff` WHERE `s_id` = '$id'";
		echo $query;
		$stmt = $db->query($query);
	}
	
}
		