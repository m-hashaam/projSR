<?php
	
		session_start();
		if(!(isset($_SESSION['SRC_logged_in']))){
			$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$server = substr($server,0,strrpos($server,"/"));
			header('Location: http://'.$server.'/index.php');
		}
		include "database/db.php";
		$username = $_SESSION['SRC_email'];
		
		
		$html = 
		" <html><head><meta name=\"robots\" content=\"noindex\">
			<title>SweetReferrals | Clients
				</title>
				
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
						Clients
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li class="active"><a href="clients.php"><i class="fa fa-building-o"></i>Clients</a></li>
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
					<th>Business</th>
					<th>Sector</th>
					<th>Contact</th>
					<th>Web</th>
					<td align=\"center\">
						<a href=\"addclient.php\" class=\"btn btn-success\" type=\"button\">Add Client</a>
					</td>
				  </tr>
			  </thead>
			  ";
  
		  
		$result = $db->query("SELECT `c_id`, `c_name`, `c_business_line`, `c_sector`, `c_contact`, `c_ec_buyer`, `c_user_buyer`, `c_tech_buyer`, `c_web`, `c_social`, `c_address`, `c_city`, `c_referrals_source`, `c_added_by`, `c_added_on` FROM `client` WHERE 1");
		  
		  while($row = $result->fetch_assoc()) {
				  //<td align=\"center\"><a href=\"viewclientdetails.php?username=".$row["c_id"]."\" class=\"btn btn-success\" type=\"button\">View Details</a></td>
				  $html.=" <tr>
							<td><a href=\"updateclient.php?username=".$row["c_id"]."\">".$row["c_name"]."</a></td>
							<td>".$row["c_business_line"]."</td>
							<td>".$row["c_sector"]."</td>
							<td>".$row["c_contact"]."</td>
							<td>".$row["c_web"]."</td>
							<td align=\"center\"></td>
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