<?php 
	session_start();
	
	$_SESSION = array(); 
	session_destroy(); 
	
	 
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');

 ?>