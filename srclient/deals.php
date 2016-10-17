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
			<title>SweetReferrals | Deals
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
						Deals
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li class="active"><a href="deals.php"><i class="fa fa-suitcase"></i>Deals</a></li>
					  </ol>
					</section>

					<section class="content">';
	$html.="
			<div class=\"box\">
			<div class=\"box-body\">
			
			
			<table align=\"center\" class=\"table table-bordered table-hover \" id=\"adminuser_table\" border=\"1\" >
				<thead>
				 <tr class\"active\">
					<th>Deal Name</th>
					<th>Primary Staff</th>
					<th>Key Contact</th>
					<th>Company</th>
					<th>Est. Size</th>
					<th>Stage</th>
					<th>Probability</th>
					<th>Weighted Forcast</th>
					<td colspan=\"2\" align=\"center\">
						<a href=\"adddeal.php\" class=\"btn btn-success\" type=\"button\">Add New</a>
					</td>
				  </tr>
			  </thead>
			  ";
  
		  
		$result = $db->query("SELECT `d_id`, `deal`.`kc_id`, `d_primary_staff`, `d_secondary_staff`, `d_stage`, `d_est_size`, `d_probability`, `d_weighted_forcast`, `d_expected_close_date`, `d_name`, `d_added_on`, `d_added_by`,`kc_name`,`s_name` ,`c_name`,`client`.c_id
								FROM `deal`,`key_contact`,`staff`,`client`
								WHERE `deal`.kc_id = `key_contact`.kc_id 
								AND `deal`.`d_primary_staff` = `staff`.s_id
								AND `key_contact`.c_id = `client`.c_id");
		  
		  while($row = $result->fetch_assoc()) {
				  $html.=" <tr>
							<td><a href=\"updatedeals.php?username=".$row["d_id"]."\">".$row["d_name"]."</a></td>
							<td><a href=\"updateadmin.php?username=".$row["d_primary_staff"]."\">".$row["s_name"]."</a></td>
							<td><a href=\"updatekeycontact.php?username=".$row["kc_id"]."\">".$row["kc_name"]."</a></td>
							<td><a href=\"updateclient.php?username=".$row["c_id"]."\">".$row["c_name"]."</a></td>
							<td>".$row["d_est_size"]."</td>
							<td>".$row["d_stage"]."</td>
							<td>".$row["d_probability"]."%</td>
							<td>".$row["d_weighted_forcast"]."</td>
							<td align=\"center\"><a href=\"viewdealdetails.php?username=".$row["d_id"]."\" class=\"btn btn-success\" type=\"button\">View Interactions</a></td>
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