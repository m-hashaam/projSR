<?php
session_start();
$user = "chikonzy";
$pass = "chikonzy";
if(isset($_SESSION['emailSR'])){
    $user = $_SESSION['emailSR'];
}
if(isset($_SESSION['passSR'])){
    $pass = $_SESSION['passSR'];
}
if($_POST['func'] == "getUserData"){
    $all = array();
    $all[] = $user;
    $all[] = $pass;
    
    $dbhost = "localhost"; 
	$dbname = "sweetref_portal"; 
	$dbuser = "sweetref_portal"; 
	$dbpass=  "Popo1122!!@@";
	
	$db = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");
    
    $theemails = $_SESSION['emailSR'];
    $thepasswords = $_SESSION['passSR'];
    $thenames = $_SESSION['fnameSR'];
    $thepasswords = md5($thepasswords);
    
    $query = "SELECT `id`, `user_id` FROM `ticketing_user_email` WHERE `address` = '$theemails'";
    $stmt = $db->query($query);
    if(!($row = $stmt->fetch_assoc())){
        $query = "INSERT INTO `ticketing_user`(`org_id`, `default_email_id`, `status`, `name`) 
                                        VALUES (0,0,1,'$thenames')";
        $db->query($query);
        $ticket_user_id = $db->insert_id;
        
        $query = "INSERT INTO `ticketing_user_account`( `user_id`, `status`, `timezone_id`, `dst`, `passwd`) 
                                                VALUES ($ticket_user_id,1,21,1,'$thepasswords')";
        $db->query($query);
        
        $query = "INSERT INTO `ticketing_user_email`( `user_id`, `address`) 
                                               VALUES ($ticket_user_id,'$theemails')";
        $db->query($query);
        $emailid = $db->insert_id;
        
        $query = "UPDATE `ticketing_user` SET `default_email_id` = $emailid WHERE `id` = $ticket_user_id";
        $db->query($query);
    }
    
        
    echo json_encode($all);
    $db->close();
}