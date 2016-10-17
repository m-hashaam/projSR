<?php

if(!(isset($_SESSION['SRC_logged_in']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
	
Class main{
		 
	function welcome(){
		include "database/db.php";
		$username = $_SESSION['SRC_email'];
		$html = 
		" <html><head>
					<title>Sweet Referrals Admin | Home</title>
				
			<link href=\"css/simple-sidebar.css\" rel=\"stylesheet\">
			<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
			<link rel=\"stylesheet\" href=\"css/mystyle.css\">
				
			<script src=\"js/jquery.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/bootstrap-min.js\" ></script>
			<script type=\"text/javascript\" src=\"js/main.js\" ></script>
			<script type=\"text/javascript\" src=\"js/tablefilter.js\" ></script>
			<script type=\"text/javascript\" src=\"js/velocity.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/sidebar.js\"></script>
			<script type=\"text/javascript\" src=\"js/blockUI.js\" ></script>";
		include 'inc/headscripts.php';
				
			
  $html="</head>
  <body class=\"hold-transition skin-blue sidebar-mini\">
  <div class=\"wrapper\">
			";
		
	echo $html;
	include 'inc/newheader.php';
	print_header("loggedin", $username, "home");
	include 'inc/newsidebar.php';
    
			$html = '<div class="content-wrapper">
						
						<section class="content-header">
						  <h1>
							Home
						  </h1>
						  <ol class="breadcrumb">
							<li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						  </ol>
						</section>

						<section class="content">
							<p>Graphs and all shashka\'s will appear here</p>
						</section>
					  </div>';
			echo $html;
			include 'inc/newfooter.php';
			
			
			echo '<div class="control-sidebar-bg"></div>
					</div>';
			include 'inc/footerscripts.php';
			echo '</body>
					</html>';
	}
		
}