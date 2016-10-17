<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    
    
    if ($_POST['func'] == "getUserName"){
	    
    	$email = "";
        
        if(isset($_SESSION['emailSR'])){
            $email = $_SESSION['emailSR'];   
        }
        
        echo $email;
      
	}
    else if ($_POST['func'] == "edit"){
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
        
        
        
    	$userid = $_SESSION['idSR'];
        
       
        
        $query = "UPDATE `user` SET `u_email`='$email',`u_first_name`='$fname',`u_last_name`='$lname',`u_mobile`='$mobile',`u_job`='$title' WHERE `u_id`= $userid";
        $stmt = $db->query($query);
      
	}
    
    else if ($_POST['func'] == "changePass"){
		$newpass = $_POST['newpass'];
        $email = str_replace("'","\'",$email);
        
        $cpass = $_POST['cpass'];
        $cpass = str_replace("'","\'",$cpass);
        $cpass = md5($cpass);
        
        $userid = $_SESSION['idSR'];
        
        $query = "SELECT u_id FROM `user` WHERE `u_password` = '$cpass' AND `u_id` = $userid";
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
        
      
        
        $query = "UPDATE `user` SET `u_password` = '$newpass' WHERE `u_id`= $userid";
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
		