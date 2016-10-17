<?php
/**
 * DB Settings
 * 
 * @author Ali Haider
 */
		
		
		$dbhost = "localhost"; 
		$dbname = "sweetref_srclients"; 
		$dbuser = "sweetref_srclien"; 
		$dbpass=  "Dell@Latitude1";
		
		$db = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");