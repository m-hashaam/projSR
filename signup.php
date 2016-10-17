<?php

session_start(); 

include 'authentication/signup.php';
$signup = new Signup();
$signup -> handle ();
