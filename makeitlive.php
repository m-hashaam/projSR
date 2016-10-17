<?php

session_start();
include "database/db.php";

$id = $_GET['id'];

		
$query = "UPDATE `product` SET `p_islive`= 1 WHERE `p_id`= $id";
$stmt = $db->query($query);
        
   
echo "The product is live now. This is testing page and there is no security";