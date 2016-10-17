<?php

session_start(); 

include 'authentication/login.php';
$login = new Login();
$login -> handle ();

