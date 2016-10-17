<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){

	if ($_POST['func'] == "read"){
		$id= $_POST['id'];
	
		$query = "UPDATE `notifications` SET `n_isread`= 1 WHERE `n_id`= $id";
		$stmt = $db->query($query);
        $query = "SELECT `n_link` FROM `notifications` WHERE `n_id`= $id";
		$stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            echo $row['n_link'];
        }
        else{
            echo "notifications.php";
        }
        
        
      
		
	}
    
}
		