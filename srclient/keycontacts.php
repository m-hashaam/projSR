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
			<title>SweetReferrals | Key Contacts
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
						Key Contacts
					  </h1>
					  <ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
						<li class="active"><a href="keycontacts.php"><i class="fa fa-key"></i>Key Contacts</a></li>
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
					<th>Company Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Position</th>
					<td colspan=\"2\" align=\"center\">
						<a href=\"addkeycontact.php\" class=\"btn btn-success\" type=\"button\">Add New</a>
					</td>
				  </tr>
			  </thead>
			  ";
  
		  
		$result = $db->query("SELECT `kc_id`, `kc_name`, `kc_email`, `kc_mobile`, `kc_position`, `key_contact`.`c_id`,`c_name` FROM `key_contact`,`client` WHERE `key_contact`.`c_id` = `client`.`c_id`");
		  
		  while($row = $result->fetch_assoc()) {
				  //<a href=\"viewclientdetails.php?username=".$row["c_id"]."\" class=\"btn btn-success\" type=\"button\">View Interactions</a>
				  $html.=" <tr>
							<td><a href=\"updatekeycontact.php?username=".$row["kc_id"]."\">".$row["kc_name"]."</a></td>
							<td><a href=\"updateclient.php?username=".$row["c_id"]."\">".$row["c_name"]."</a></td>
							<td>".$row["kc_email"]."</td>
							<td>".$row["kc_mobile"]."</td>
							<td>".$row["kc_position"]."</td>
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