<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    
    if ($_POST['func'] == "edit"){
		$video = $_POST['video'];
        $video = str_replace("'","\'",$video);
        
        $awards = $_POST['awards'];
        $awards = str_replace("'","\'",$awards);
        
        $mission = $_POST['mission'];
        $mission = str_replace("'","\'",$mission);
        
        $zip = $_POST['zip'];
        $zip = str_replace("'","\'",$zip);
        
        $state = $_POST['state'];
        $state = str_replace("'","\'",$state);
		
		$city = $_POST['city'];
        $city = str_replace("'","\'",$city);
		
		$home = $_POST['home'];
        $home = str_replace("'","\'",$home);
		
		$street = $_POST['street'];
        $street = str_replace("'","\'",$street);
		
		$tw = $_POST['tw'];
        $tw = str_replace("'","\'",$tw);
		
		$fb = $_POST['fb'];
        $fb = str_replace("'","\'",$fb);
		
		$li = $_POST['li'];
        $li = str_replace("'","\'",$li);
		
		$web = $_POST['web'];
        $web = str_replace("'","\'",$web);
        
        
        
    	$userid = $_SESSION['idSR'];
        
       
        
       $query = "SELECT `ci_id` FROM `company_information` WHERE `u_id` = $userid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $comid = $row['ci_id'];
            
            $query = "UPDATE `company_information` SET `ci_web`='$web',`ci_fb`='$fb',`ci_tw`='$tw',`ci_li`='$li',`ci_street`='$street',`ci_home`='$home',`ci_city`='$city',`ci_zip`='$zip',`ci_state`='$state',`ci_mission`='$mission',`ci_awards`='$awards',`ci_video`='$video' WHERE `ci_id`=$comid";
            $stmt = $db->query($query);
        }
        else{
            $query = "INSERT INTO `company_information`( `u_id`, `ci_web`, `ci_fb`, `ci_tw`, `ci_li`, `ci_street`, `ci_home`, `ci_city`, `ci_zip`, `ci_state`, `ci_mission`, `ci_awards`, `ci_video`) 
                                                VALUES ($userid,  '$web',  '$fb',   '$tw', '$li', '$street', '$home', '$city', '$zip', '$state', '$mission', '$awards', '$video')";
            $stmt = $db->query($query);
        }	
      
	}
}
		