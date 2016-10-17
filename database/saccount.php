<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    
    if ($_POST['func'] == "edit"){
		$email = $_POST['email'];
        $email = str_replace("'","\'",$email);
        
        $title = $_POST['title'];
        $title = str_replace("'","\'",$title);
        
        $mobile = $_POST['mobile'];
        $mobile = str_replace("'","\'",$mobile);
        
        $lname = $_POST['lname'];
        $lname = str_replace("'","\'",$lname);
        
        $fname = $_POST['fname'];
        $fname = str_replace("'","\'",$fname);
        
        
        
    	$userid = $_SESSION['sub_idSR'];
        
        //$query = "SELECT `su_id`, `su_email`, `su_password`, `su_type`, `su_first_name`, `su_last_name`, `su_login_attempts`, `su_islocked`, `u_id`, `su_mobile`, `su_job` FROM `sub_user` WHERE `su_id`= $userid";
        //$stmt = $db->query($query);
        //if($row = $stmt->fetch_assoc()){
        //    $pemail = $row['su_email'];
        //    $ptitle = $row['su_job'];
        //    $pmobile = $row['su_mobile'];
        //    $plname = $row['su_last_name'];
        //    $pfname = $row['su_first_name'];
        //}
        
        $query = "UPDATE `sub_user` SET `su_email`='$email',`su_first_name`='$fname',`su_last_name`='$lname',`su_mobile`='$mobile',`su_job`='$title' WHERE `su_id`= $userid";
        $stmt = $db->query($query);
        
        //$sub_userid = $_SESSION['sub_idSR'];
        //$parent_userid = $_SESSION['idSR'];
        
        //$imagelink = "http://portal.sweetreferrals.com/assets/accouunt.png";
        //$urllink = "http://portal.sweetreferrals.com/accouunt.png";
        //if($pemail != $email){
        //    $query = "INSERT INTO `notifications`( `u_id`, `n_text`, `n_link`, `n_icon`) 
        //                                VALUES ($parent_userid,'User account info changed, from email $pemail to $email',)";
        //}
      
	}
    
    else if ($_POST['func'] == "changePass"){
		$newpass = $_POST['newpass'];
        $email = str_replace("'","\'",$email);
        
        $cpass = $_POST['cpass'];
        $cpass = str_replace("'","\'",$cpass);
        $cpass = md5($cpass);
        
        $userid = $_SESSION['sub_idSR'];
        
        $query = "SELECT su_id FROM `sub_user` WHERE `su_password` = '$cpass' AND `su_id` = $userid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            
        }
        else{
            echo "Invalid current password";
            return;
        }
        
    	if(strlen($newpass) < 8){
			echo "Password must be atleast 6 characters";
			return;
		}
		if (!preg_match('/[a-z]/', $newpass))
		{
			echo "Password must contain a lower case letter";
	        return;
		}
		else if(!preg_match('/[A-Z]/', $newpass)){
            echo "Password must contain an upper case letter";
	        return;
		}
        else if(!preg_match('/[0-9]/', $newpass)){
            echo "Password must contain a number";
	        return;
		}
        else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newpass)){
            echo "Password must contain a special character";
	        return;
		}
        
        $newpass = md5($newpass);
        
      
        
        $query = "UPDATE `sub_user` SET `su_password` = '$newpass' WHERE `su_id`= $userid";
        $stmt = $db->query($query);
        
        echo "success";
        
        
        $theemails = $_SESSION['emailSR'];
        $thepasswords = $_SESSION['passSR'];
        $thenames = $_SESSION['fnameSR'];
        
        $query = "SELECT `id`, `user_id` FROM `ticketing_user_email` WHERE `address` = '$theemails'";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $ticket_user_id = $row['user_id'];
            $query = "UPDATE `ticketing_user_account` SET `passwd`= '$newpass' WHERE `user_id` = $ticket_user_id";
            $db->query($query);
        }
        else{
            $query = "INSERT INTO `ticketing_user`(`org_id`, `default_email_id`, `status`, `name`) 
                                            VALUES (0,0,1,'$thenames')";
            $db->query($query);
            $ticket_user_id = $db->insert_id;
            
            $query = "INSERT INTO `ticketing_user_account`( `user_id`, `status`, `timezone_id`, `dst`, `passwd`) 
                                                    VALUES ($ticket_user_id,1,21,1,'$newpass')";
            $db->query($query);
            
            $query = "INSERT INTO `ticketing_user_email`( `user_id`, `address`) 
                                                   VALUES ($ticket_user_id,'$theemails')";
            $db->query($query);
            $emailid = $db->insert_id;
            
            $query = "UPDATE `ticketing_user` SET `default_email_id` = $emailid WHERE `id` = $ticket_user_id";
            $db->query($query);
        }
      
	}
    
}

$db->close();
		