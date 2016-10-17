<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){

	if ($_POST['func'] == "get"){
		$prodid = $_SESSION['CurrentProductID'];
		
	    $perreach = array();
		$pername = array();
		$cname = array();
        $clat = array();
        $clong = array();
        $perimage = array();
         $perimage2 = array();
        $query = "SELECT `reach_id`, `persona_reach`.`per_id`, `persona_reach`.`c_id`, `per_reach`, `per_name`, `per_desc`, `per_image`,`per_image2`, `c_name`, `c_lat`, `c_long` FROM `persona_reach`,`persona`,`city` WHERE `persona_reach`.per_id = `persona`.per_id AND `persona_reach`.c_id = `city`.c_id AND `persona`.per_id IN (SELECT `product_persona`.per_id FROM `product_persona` WHERE `product_persona`.p_id = $prodid)";
		$stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
           $perreach[] = $row['per_reach'];
           $pername[] = $row['per_name'];
           $cname[] = $row['c_name'];
           $clat[] = $row['c_lat'];
           $clong[] = $row['c_long'];
           $perimage[] = $row['per_image'];
           $perimage2[] = $row['per_image2'];
        }
        $all = array();
		$all[] = $perreach;
		$all[] = $pername;
		$all[] = $cname;
        $all[] = $clat;
		$all[] = $clong;
		$all[] = $perimage;
        $all[] = $perimage2;
		echo json_encode($all);
		
	}
}
		