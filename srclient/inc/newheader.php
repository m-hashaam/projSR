<?php

function print_header ($type , $username, $active){
	
	$theemail = $_SESSION['SRC_email'];
	$theid = $_SESSION['SRC_id'];
	$thename = $_SESSION['SRC_name'];
	$thepicture = $_SESSION['SRC_picture'];
	$thepost = $_SESSION['SRC_post'];
	$theadded = $_SESSION['SRC_added'];
	
	$headera = "";
	if ($type == "loggedin"){
			$headera = '<header class="main-header">
						<!-- Logo -->
						<a href="index2.html" class="logo">
						  <!-- mini logo for sidebar mini 50x50 pixels -->
						  <span class="logo-mini"><b>SR</b>C</span>
						  <!-- logo for regular state and mobile devices -->
						  <span class="logo-lg"><b>SR</b>Clients</span>
						</a>
						<!-- Header Navbar: style can be found in header.less -->
						<nav class="navbar navbar-static-top">
						  <!-- Sidebar toggle button-->
						  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
							<span class="sr-only">Toggle navigation</span>
						  </a>

						  <div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
							 
							  <li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								  <img src="'.$thepicture.'" class="user-image" alt="User Image">
								  <span class="hidden-xs">'.$thename.'</span>
								</a>
								<ul class="dropdown-menu">
								  <!-- User image -->
								  <li class="user-header">
									<img src="'.$thepicture.'" class="img-circle" alt="User Image">

									<p>
									  '.$thename.' - '.$thepost.'
									  <small>Member since '.$theadded.'</small>
									</p>
								  </li>
								  <!-- Menu Body -->
								  <li class="user-body">
									<div class="row">
									  <div class="col-xs-6 text-center">
										<a href="#">Change Password</a>
									  </div>
									  <div class="col-xs-6 text-center">
										<a href="#">Edit My Profile</a>
									  </div>
									</div>
									<!-- /.row -->
								  </li>
								  <!-- Menu Footer-->
								  <li class="user-footer">
									<div class="pull-left">
									  <a href="index.php" class="btn btn-default btn-flat">Home</a>
									</div>
									<div class="pull-right">
									  <a href="authentication/logout.php" class="btn btn-default btn-flat">Sign out</a>
									</div>
								  </li>
								</ul>
							  </li>
							</ul>
						  </div>
						</nav>
					  </header>';
	}
	else
	if ($type == "login"){
			$headera = "<nav style=\"background:#3c8dbc; border-color:#3c8dbc; \" class=\"navbar navbar-inverse \" role=\"navigation\">
			
					<div class=\"navbar-header\">
					  <a class=\"navbar-brand\" style=\"color:white;\" >
					  SweetReferrals Clients Management
					  </a>
				   </div>
				
					 
			
				   </div>
				</nav>";
	}
	
	echo $headera;
	
}
