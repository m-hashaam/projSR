<?php

	$theemail = $_SESSION['SRC_email'];
	$theid = $_SESSION['SRC_id'];
	$thename = $_SESSION['SRC_name'];
	$thepicture = $_SESSION['SRC_picture'];
	$thepost = $_SESSION['SRC_post'];
	$theadded = $_SESSION['SRC_added'];
	$bname =  basename($_SERVER['PHP_SELF']);
	$staff = "";
	$home = "";
	$client = "";
	$key = "";
	$deal = "";
	if($bname == "staff.php"){
		$staff = "class=\"active\"";
	}
	else if($bname == "index.php"){
		$home = "class=\"active\"";
	}
	else if($bname == "adduser.php"){
		$staff = "class=\"active\"";
	}
	else if($bname == "updateadmin.php"){
		$staff = "class=\"active\"";
	}
	else if($bname == "clients.php"){
		$client = "class=\"active\"";
	}
	else if($bname == "addclient.php"){
		$client = "class=\"active\"";
	}
	else if($bname == "updateclient.php"){
		$client = "class=\"active\"";
	}
	else if($bname == "keycontacts.php"){
		$key = "class=\"active\"";
	}
	else if($bname == "addkeycontact.php"){
		$key = "class=\"active\"";
	}
	else if($bname == "updatekeycontact.php"){
		$key = "class=\"active\"";
	}
	else if($bname == "deals.php"){
		$deal = "class=\"active\"";
	}
	else if($bname == "adddeal.php"){
		$deal = "class=\"active\"";
	}
	else if($bname == "updatedeals.php"){
		$deal = "class=\"active\"";
	}
	else if($bname == "viewdealdetails.php"){
		$deal = "class=\"active\"";
	}
		
$sidebar = '<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
				  <!-- Sidebar user panel -->
				  <div class="user-panel">
					<div class="pull-left image">
					  <img src="'.$thepicture.'" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
					  <p>'.$thename.'</p>
					  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				  </div>
				  <!-- sidebar menu: : style can be found in sidebar.less -->
				  <ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
					
					<li '.$home.'>
					  <a href="index.php">
						<i class="fa fa-home"></i> <span>Home</span>
					  </a>
					</li>
					
					<li '.$staff.'>
					  <a href="staff.php">
						<i class="fa fa-group"></i> <span>Staff</span>
					  </a>
					</li>
					
					<li '.$client.'>
					  <a href="clients.php">
						<i class="fa fa-building-o"></i> <span>Clients</span>
					  </a>
					</li>
					
					<li '.$key.'>
					  <a href="keycontacts.php">
						<i class="fa fa-key"></i> <span>Key Contacts</span>
					  </a>
					</li>
					
					<li '.$deal.'>
					  <a href="deals.php">
						<i class="fa fa-suitcase"></i> <span>Deals</span>
					  </a>
					</li>
					
					
				  </ul>
				</section>
				<!-- /.sidebar -->
				</aside>';
		
		echo $sidebar;