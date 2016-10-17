<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    
    if ($_POST['func'] == "add"){
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
        
        $newpass = $_POST['newpass'];
        $email = str_replace("'","\'",$email);
        
        $type = $_POST['type'];
        
        $userid = $_SESSION['idSR'];
      
        
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
        else if(!preg_match('/[\'^£$!%&*()}{@#~?><>,|=_+¬-]/', $newpass)){
            echo "Password must contain a special character";
	        return;
		}
        
        $newpass = md5($newpass);
        
        
        
    	$userid = $_SESSION['idSR'];
        
       
        
        $query = "INSERT INTO `sub_user`( `su_email`, `su_password`, `su_type`, `su_first_name`, `su_last_name`, `u_id`, `su_mobile`, `su_job`) 
                                    VALUES ('$email','$newpass','$type','$fname','$lname',$userid,'$mobile','$title')";
        $stmt = $db->query($query);
      
	}
    else if ($_POST['func'] == "remove"){
		$id = $_POST['userid'];
        
    	$userid = $_SESSION['idSR'];
        
       
        
        $query = "DELETE FROM `sub_user` WHERE `su_id` = $id AND `u_id` = $userid";
        $stmt = $db->query($query);
        
        if($db->affected_rows > 0){
            echo "success";
        }
        else{
            echo "You do not have permission to remove this user";
        }
      
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
        
        $newpass = $_POST['newpass'];
        $email = str_replace("'","\'",$email);
        
        $type = $_POST['type'];
        
        $userid = $_SESSION['idSR'];
        $userid = $_SESSION['idSR'];
        $userrid = $_SESSION['temp_userid'];
        
        
    	if($newpass != ""){
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
            $query = "UPDATE `sub_user` SET `su_email`='$email',`su_password`='$newpass',`su_type`='$type',`su_first_name`='$fname',`su_last_name`='$lname',`su_mobile`='$mobile',`su_job`='$title' WHERE `u_id` = $userid AND `su_id` = $userrid";
    	}
        else{
            $query = "UPDATE `sub_user` SET `su_email`='$email',`su_type`='$type',`su_first_name`='$fname',`su_last_name`='$lname',`su_mobile`='$mobile',`su_job`='$title' WHERE `u_id` = $userid AND `su_id` = $userrid";
        }
        
        
        
        
        
    	
       
        
        
        $stmt = $db->query($query);
        echo $query;
      
	}
    
   
}

$db->close();
		