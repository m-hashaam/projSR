<?php

session_start();
include "db.php";

if(isset($_SESSION['loggedIn'])){

	if ($_POST['func'] == "changeStatus"){
		$status = $_POST['state'];
		$id = $_POST['id'];
		
		$query = "UPDATE `order` SET `status` = '$status',"; 
		if($status == "Order Placed"){
			$query.=" ordered_at = CURDATE() where `orderid` = $id";
		}
		else if($status == "Picked Up"){
			$query.=" pickedup_at = CURDATE() where `orderid` = $id";
		}
		else if($status == "Washing"){
			$query.=" washing_at = CURDATE() where `orderid` = $id";
		}
		else if($status == "Delivered"){
			$query.=" delivered_at = CURDATE() where `orderid` = $id";
		}
		else if($status == "Ready"){
			$query.=" ready_at = CURDATE() where `orderid` = $id";
		}
		else if($status == "Canceled"){
			$query.=" canceled_at = CURDATE() where `orderid` = $id";
		}
		$stmt = $db->query($query);
		
		$result = $db->query("select email,firstname,devid, devtype from profile where userID in (select userid from `order` where orderid=$id)");
		$user;
		$email;
		  if($row = $result->fetch_assoc()) {
		  	$user = $row['firstname'];
		  	$email = $row['email'];
			$devid = $row['devid'];
			$devtype = $row['devtype'];
		  	
			$to      = $email;
			$subject = 'Order Status Changed';
			$message = 'Dear '.$user.', Your status has been changed to '.$status.' for order '.$id.', Regards';
			include '../mail/sendMail.php';
			$mail = new SendMail();
			$mail -> send ($to,$user,$id,$status,"empty");
			
			if($devtype == "android"){
				include '../push/sendPush.php';
				$push = new SendPush();
				$message = 'Order status has been changed to '.$status.' for order '.$id;
				$push -> push ($subject, $message, "no type", $devid);
			}
			else{
				include 'sendPushIos.php';
				$push = new SendPush();
				$message = 'Order status has been changed to '.$status.' for order '.$id;
				$push -> push ($subject, $message, "no type", $devid);
			}
			
				
		}
		
		
		
	}
}
		