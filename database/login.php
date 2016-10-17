<?php

session_start();
include "db.php";



if ($_POST['func'] == "reset"){
	$email = $_POST['email'];
	$email = str_replace("'","\'",$email);
	
	
    do{
        $passlink = generateRandomString(50);
        $query = "SELECT `rp_id`, `rp_link`, `u_id` FROM `reset_pass` WHERE `rp_link` = '$passlink'";
        $result = $db->query($query);
    }while($row = $result->fetch_assoc());
    
    
	$query = "SELECT `u_first_name`,`u_id` FROM `user` WHERE `u_email` = '$email'";
	$stmt = $db->query($query);
	if($row = $stmt->fetch_assoc()){
	   
        $uid = $row['u_id'];
        $uname = $row['u_first_name'];
        $query2 = "INSERT INTO `reset_pass`(`rp_link`, `u_id`) VALUES ('$passlink',$uid)";
        $db->query($query2);
        
        $query = "SELECT `rp_link` FROM `reset_pass` WHERE `u_id` = $uid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $passlink = $row['rp_link'];
        }
       
		require_once('../mail/phpmailer/class.phpmailer.php');
        $mail = new PHPMailer();
        //$mail->SMTPSecure = 'tls';
        $mail->Username   = "noreply@sweetreferrals.com";  // GMAIL username
        $mail->Password   = "NoReply1";  
        $mail->AddAddress($email);
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
        $body = str_replace('%message%', "Your Password Reset Link is : http://portal.sweetreferrals.com/passwordreset.php?link=$passlink", $body);			
        $mail->Subject = "Sweet Referrals | Password Reset";
        $mail->MsgHTML($body);
        $mail->Send();
		
		if(!$mail->Send()) {
		 echo "Mail Error: " . $mail->ErrorInfo;
		}
        else{
            echo "Email successfully sent to address specified";
        }
	}
	else{
		echo "Email address is not registered";
	}
	
}

function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

		