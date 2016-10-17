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
    else if ($_POST['func'] == "addClone"){
		$name = $_POST['name'];
		$name = str_replace("'","\'",$name);
		$pid = $_POST['pid'];
		$userid = $_SESSION['idSR'];
		
        $query = "SELECT `p_id`, `u_id`, `p_name`, `p_url`, `p_category`, `p_certifications`, `p_features`, `p_keywords`, `p_awards`, `p_desc`, `p_picture`, `p_islive` FROM `product` WHERE `p_id` = $pid";
		$stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            	$query = "INSERT INTO `product`( `u_id`, `p_name`,  `p_url`, `p_category`, `p_certifications`, `p_features`, `p_keywords`, `p_awards`, `p_desc`, `p_picture`) 
					VALUES ($userid,'$name','".$row['p_url']."', '".$row['p_category']."', '".$row['p_certifications']."', '".$row['p_features']."', '".$row['p_keywords']."', '".$row['p_awards']."', '".$row['p_desc']."', '".$row['p_picture']."')";
        }
        
	
		$stmt = $db->query($query);
        
        $_SESSION['CurrentProductName'] = $name;
	   $_SESSION['CurrentProductID'] = $db->insert_id;
		
	}
    else if ($_POST['func'] == "edit"){
		$inputImage = $_POST['inputImage'];
        $inputImage = str_replace("'","\'",$inputImage);
        $proweb = $_POST['proweb'];
        $proweb = str_replace("'","\'",$proweb);
        $proawards = $_POST['proawards'];
        $proawards = str_replace("'","\'",$proawards);
        $prokey = $_POST['prokey'];
        $prokey = str_replace("'","\'",$prokey);
        $profeat = $_POST['prokey'];
        $profeat = str_replace("'","\'",$profeat);
        $procert = $_POST['procert'];
        $procert = str_replace("'","\'",$procert);
        $prodesc = $_POST['prodesc'];
        $prodesc = str_replace("'","\'",$prodesc);
        $proname = $_POST['proname'];
        $proname = str_replace("'","\'",$proname);
        $categories = $_POST['categories'];
        $categories = str_replace("'","\'",$categories);
    	$userid = $_SESSION['idSR'];
        $proid = $_SESSION['CurrentProductID'];
		
		
		$query = "UPDATE `product` SET `p_name`='$proname',`p_url`='$proweb',`p_category`='$categories',`p_certifications`='$procert',
                        `p_features`='$profeat',`p_keywords`='$prokey',`p_awards`='$proawards',`p_desc`='$prodesc' WHERE `p_id`= $proid";
		$stmt = $db->query($query);
        
       
		
	}
     else if ($_POST['func'] == "makeitlive"){
	
		$idd = $_SESSION['CurrentProductID'];
        $name = $_SESSION['CurrentProductName'];
        
        require_once('../mail/phpmailer/class.phpmailer.php');
        $mail = new PHPMailer();
        //$mail->SMTPSecure = 'tls';
        $mail->Username   = "noreply@sweetreferrals.com";  // GMAIL username
        $mail->Password   = "NoReply1";  
        $mail->AddAddress("ahsn92@gmail.com");
        $mail->FromName = "Sweet Referrals Portal";
        $mail->Host       = "sweetreferrals.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;   
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->CharSet="utf-8";
        $mail->From = $mail->Username;
        $body = file_get_contents("../mail/welcome/Welcome.html");
        $body = str_replace('%user%', "Dear Ahsan", $body);
        $body = str_replace('%message%', "<p>You have a new request to make a product live.</p><p>Product ID : $idd</p><p>Product Name: $name. </p><p> Click link to make it live : http://portal.sweetreferrals.com/makeitlive.php?id=$idd</p>", $body);			
        $mail->Subject = "Sweet Referrals | Live Product Request";
        $mail->MsgHTML($body);
        $mail->Send();
		
		if(!$mail->Send()) {
		 echo "Mail Error: " . $mail->ErrorInfo;
		}
        else{
            echo "Email successfully sent to address specified";
        }
       
		
	}
}
		