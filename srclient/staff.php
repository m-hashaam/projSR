<?php
	
		session_start();
		if(!(isset($_SESSION['SRC_logged_in']))){
			$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$server = substr($server,0,strrpos($server,"/"));
			header('Location: http://'.$server.'/index.php');
		}
		include "database/db.php";
		$username = $_SESSION['SRC_email'];
		
		
		$tempp = "<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
			<link rel=\"stylesheet\" href=\"css/mystyle.css\">
			<link href=\"css/simple-sidebar.css\" rel=\"stylesheet\">
				
			<script src=\"js/jquery.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/bootstrap-min.js\" ></script>
			<script type=\"text/javascript\" src=\"js/velocity.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/tablefilter.js\" ></script>
			<script type=\"text/javascript\" src=\"js/adminusers.js\"></script>
			<script type=\"text/javascript\" src=\"js/sidebar.js\"></script>
			";
		
		$html = 
		" <html><head><meta name=\"robots\" content=\"noindex\">
			<title>SweetReferrals | Admin Users
				</title>
				<script type=\"text/javascript\" src=\"js/adminusers.js\"></script>
				<script type=\"text/javascript\" src=\"js/blockUI.js\" ></script>
			";
			echo $html;
		include 'inc/headscripts.php';
				
			
 $html="</head>
  <body class=\"hold-transition skin-blue sidebar-mini\">
  <div class=\"wrapper\">
			";
		
		
		///////////////////
	echo $html;
	include 'inc/newheader.php';
	print_header("loggedin", $username, "");
	include 'inc/newsidebar.php';
		///////////////////	
	$html = '<div class="content-wrapper">
					
					<section class="content-header">
					  <h1>
						Staff
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li class="active"><a href="staff.php"><i class="fa fa-group"></i>Staff</a></li>
					  </ol>
					</section>

					<section class="content">';
	$html.="
			<div class=\"box\">
			<div class=\"box-body\">
			
			<table align=\"center\" class=\"table table-bordered table-hover \" id=\"adminuser_table\" border=\"1\" >
				<thead>
				 <tr class\"active\">
					<th>Name</th>
					<th>Email</th>
					<th>Address</th>
					<th>Post</th>
					<td align=\"center\">
						<a href=\"adduser.php\" class=\"btn btn-success\" type=\"button\">Add Staff</a>
					</td>
				  </tr>
			  </thead>
			  ";
  
		  
		$result = $db->query("SELECT `s_id`, `s_email`, `s_password`, `s_name`, `s_address`, `s_post` FROM `staff` WHERE 1");
		  
		  while($row = $result->fetch_assoc()) {
				  $html.=" <tr>
							<td>".$row["s_name"]."</td>
							<td><a href=\"updateadmin.php?username=".$row["s_id"]."\">".$row["s_email"]."</a></td>
							<td>".$row["s_address"]."</td>
							<td>".$row["s_post"]."</td>
							<td align=\"center\">";
							if($row["s_email"] == $username){
								$html.="<input class=\"btn \" TYPE=\"submit\" VALUE=\"Remove\" disabled=\"disabled\">";
							}
							else{
								$html.="<input onclick=\"removeAdmin(".$row["s_id"].")\" class=\"btn btn-success \" TYPE=\"submit\" VALUE=\"Remove\" >";
							}
			$html.="
							</td>
						</tr>";
			}
			
			
				$html.='</table>
				
				</div>
				</div>
				';
	$html.='				</section>
				  </div>';
	
		echo $html;
		include 'inc/newfooter.php';
			
			
			echo '<div class="control-sidebar-bg"></div>
					</div>';
			include 'inc/footerscripts.php';
			

			
			echo '</body>
					</html>';
?>
<script>
    $('#adminuser_table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
	 $('#adminuser_table').DataTable();
</script>