<?php

include "db.php";

		
$names = array();		
$query = "SELECT `c_id`, `c_name`, `c_lat`, `c_long` FROM `city` WHERE 1";
//echo $query;
$stmt = $db->query($query);
while($row = $stmt->fetch_assoc()){
    $names[] = $row['c_name'];
}
echo json_encode($names);


		

		