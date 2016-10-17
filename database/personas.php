<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){

	if ($_POST['func'] == "remove"){
		$id = $_POST['id'];
		$prodid = $_SESSION['CurrentProductID'];
		
		
		$query = "DELETE FROM `product_persona` WHERE `p_id` = $prodid AND `per_id` = $id";
		$stmt = $db->query($query);
		
	}
    else if ($_POST['func'] == "add"){
		$data = json_decode(stripslashes($_POST['data']));
		$prodid = $_SESSION['CurrentProductID'];
		
		$count = count($data);
        for($i=0 ; $i<$count ; $i++){
            $query = "INSERT INTO `product_persona` (`p_id`, `per_id`) VALUES($prodid,".$data[$i].")";
		      $stmt = $db->query($query);
        }
		
	}
}
		