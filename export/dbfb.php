<?php
//Sample Database Connection Syntax for PHP and MySQL.

//Connect To Database


		// $dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
		// $dbname = "venomoux_wash"; // the name of the database that you are going to use for this project
		// $dbuser = "root"; // the username that you created, or were given, to access your database
		// $dbpass=  "";// = "root"; // the password that you created, or were given, to access your database
		
		// $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	    $dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
		$dbname = "sweetreferralsce_sweets_fb"; 
		$dbuser = "sweetreferralsce_alihaider9"; 
		$dbpass=  "Cheeta91";
		
		$dbfb = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");
?>
