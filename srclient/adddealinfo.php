<?php

session_start();
if(!(isset($_SESSION['SRC_logged_in']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}

function addUser(){
	$todonext = $_POST['todonext'];
	$outcome = $_POST['outcome'];
	$tododate = $_POST['tododate'];
	$todonextfor = $_POST['todonextfor'];
	$channel = $_POST['channel'];
	$kcontact = $_POST['kcontact'];
	$intdate = $_POST['intdate'];
	
	$outcome = str_replace("'","\'",$outcome);
	$todonext = str_replace("'","\'",$todonext);
	
	$did = $_GET['username'];
	
	$theemail = $_SESSION['SRC_email'];
	$theid = $_SESSION['SRC_id'];
	$thename = $_SESSION['SRC_name'];
	$thepicture = $_SESSION['SRC_picture'];
	$thepost = $_SESSION['SRC_post'];
	$theadded = $_SESSION['SRC_added'];
	
	$sdate = $tododate;
	$month = substr($sdate,0,strpos($sdate,"/")) or die("Invalid Date");
	$sdate = substr($sdate,strpos($sdate,"/")+1,strlen($sdate)) or die("Invalid Date");
	$day = substr($sdate,0,strpos($sdate,"/")) or die("Invalid Date");
	$sdate = substr($sdate,strpos($sdate,"/")+1,strlen($sdate)) or die("Invalid Date");
	$year = $sdate or die("Invalid Date");
	$cdate = $year."-".$month."-".$day;
	
	$sdate = $intdate;
	$month = substr($sdate,0,strpos($sdate,"/")) or die("Invalid Date");
	$sdate = substr($sdate,strpos($sdate,"/")+1,strlen($sdate)) or die("Invalid Date");
	$day = substr($sdate,0,strpos($sdate,"/")) or die("Invalid Date");
	$sdate = substr($sdate,strpos($sdate,"/")+1,strlen($sdate)) or die("Invalid Date");
	$year = $sdate or die("Invalid Date");
	$intdate = $year."-".$month."-".$day;
	
	
	
	include "database/db.php";
	$query = "INSERT INTO `meeting`(`d_id`, `kc_id`, `me_channel`, `me_outcome`, `me_added_by`,`me_added_on`) 
								VALUES ('$did','$kcontact','$channel','$outcome','$theid','$intdate')";
	$stmt = $db->query($query);
	$meetid = $db->insert_id;
	
	if($todonext != "NA"){
		$query = "INSERT INTO `todo`(`t_text`, `t_date`, `t_for`,  `t_added_by`, `t_meeting`) 
							VALUES ('$todonext','$cdate','$todonextfor','$theid','$meetid')";
		$stmt = $db->query($query);
	}
	
	
	$db->close();
	
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/viewdealdetails.php?username='.$did);
}



if(isset($_SESSION['SRC_logged_in'])){
	$did = $_GET['username'];

	if ((isset($_POST['tododate']) ) && 
		(isset($_POST['todonext'])) && 
		(isset($_POST['outcome']))
		){
		if($_POST['outcome'] != null && $_POST['todonext'] != null){
			addUser();
		}else{
			$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$server = substr($server,0,strrpos($server,"/"));
			header('Location: http://'.$server.'/viewdealdetails.php?username='.$did);
		}		
	}else {
		$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$server = substr($server,0,strrpos($server,"/"));
		header('Location: http://'.$server.'/viewdealdetails.php?username='.$did);
	}
}

				
