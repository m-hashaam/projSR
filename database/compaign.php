<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){

	if ($_POST['func'] == "add"){
		$name = $_POST['name'];
		$name = str_replace("'","\'",$name);
		$url = $_POST['url'];
		$url = str_replace("'","\'",$url);
		$userid = $_SESSION['idSR'];
		
		
		$query = "INSERT INTO `product` (`u_id`,`p_name`,`p_url`) VALUES ($userid,'$name','$url')";
        //echo $query;
		$stmt = $db->query($query);
        
        $_SESSION['CurrentProductName'] = $name;
	   $_SESSION['CurrentProductID'] = $db->insert_id;
		
	}
  
    else if ($_POST['func'] == "edit"){
		$promo = $_POST['promo'];
        $promo = str_replace("'","\'",$promo);
        
        $kpi = $_POST['kpi'];
        $kpi = str_replace("'","\'",$kpi);
        
        $fulfilment = $_POST['fulfilment'];
        $fulfilment = str_replace("'","\'",$fulfilment);
        
        $storage = $_POST['storage'];
        $storage = str_replace("'","\'",$storage);
        
        $quantity = $_POST['quantity'];
        $quantity = str_replace("'","\'",$quantity);
        
        $city = $_POST['city'];
        $city = str_replace("'","\'",$city);
        
    	$userid = $_SESSION['idSR'];
        
        $proid = $_SESSION['CurrentProductID'];
        
        $query = "SELECT `com_id` FROM `compaign` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $comid = $row['com_id'];
            
            $query = "UPDATE `compaign` SET `com_quantity`=$quantity,`com_storage`='$storage',`com_fulfilment`='$fulfilment',`com_promotion`='$promo',`com_kpi`='$kpi',`com_cities`='$city' WHERE `com_id` = $comid";
            $stmt = $db->query($query);
        }
        else{
            $query = "INSERT INTO `compaign`(`p_id`, `com_quantity`, `com_storage`, `com_fulfilment`, `com_promotion`, `com_kpi`,`com_cities`) 
                                        VALUES ($proid, $quantity, '$storage', '$fulfilment', '$promo', '$kpi','$city')";
            $stmt = $db->query($query);
        }	
        //echo $query;
	}
    
    else if ($_POST['func'] == "done"){
		$promo = $_POST['promo'];
        $promo = str_replace("'","\'",$promo);
        
        $kpi = $_POST['kpi'];
        $kpi = str_replace("'","\'",$kpi);
        
        $fulfilment = $_POST['fulfilment'];
        $fulfilment = str_replace("'","\'",$fulfilment);
        
        $storage = $_POST['storage'];
        $storage = str_replace("'","\'",$storage);
        
        $quantity = $_POST['quantity'];
        $quantity = str_replace("'","\'",$quantity);
        
        $city = $_POST['city'];
        $city = str_replace("'","\'",$city);
        
    	$userid = $_SESSION['idSR'];
        
        $proid = $_SESSION['CurrentProductID'];
        
        $query = "SELECT `com_id` FROM `compaign` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $comid = $row['com_id'];
            
            $query = "UPDATE `compaign` SET `com_quantity`=$quantity,`com_storage`='$storage',`com_fulfilment`='$fulfilment',`com_promotion`='$promo',`com_kpi`='$kpi',`com_cities`='$city' WHERE `com_id` = $comid";
            $stmt = $db->query($query);
        }
        else{
            $query = "INSERT INTO `compaign`(`p_id`, `com_quantity`, `com_storage`, `com_fulfilment`, `com_promotion`, `com_kpi`,`com_cities`) 
                                        VALUES ($proid, $quantity, '$storage', '$fulfilment', '$promo', '$kpi','$city')";
            $stmt = $db->query($query);
        }	
        
        require_once('../mail/phpmailer/class.phpmailer.php');
        $mail = new PHPMailer();
        //$mail->SMTPSecure = 'tls';
        $mail->Username   = "noreply@sweetreferrals.com";  // GMAIL username
        $mail->Password   = "NoReply1";  
        $mail->AddAddress("hello@sweetreferrals.com");
        $mail->FromName = "Sweet Referrals Portal";
        $mail->Host       = "sweetreferrals.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;   
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->CharSet="utf-8";
        $mail->From = $mail->Username;
        $body = file_get_contents("../mail/welcome/Welcome.html");
        $body = str_replace('%user%', "Dear $uname", $body);
        $body = str_replace('%message%', "<p>Compaign Submitted, Details are as follow:</p><p>User ID: $userid</p><p>Product ID:$proid</p><p>Promotion:$promo</p><p>Fulfilment:$fulfilment</p><p>Quantity:$quantity</p><p>Storage:$storage</p><p>KPI:$kpi</p><p>Cities:$city</p>", $body);			
        $mail->Subject = "Sweet Referrals | Compaign Submitted";
        $mail->MsgHTML($body);
        $mail->Send();
		
		if(!$mail->Send()) {
		 //echo "Mail Error: " . $mail->ErrorInfo;
		}
        else{
            //echo "Email successfully sent to address specified";
        }
	}
    
}
		