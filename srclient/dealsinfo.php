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
			<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
			<link rel=\"stylesheet\" href=\"css/mystyle.css\">
			<link href=\"css/simple-sidebar.css\" rel=\"stylesheet\">
				
			<script src=\"js/jquery.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/bootstrap-min.js\" ></script>
			<script type=\"text/javascript\" src=\"js/velocity.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/tablefilter.js\" ></script>
			<script type=\"text/javascript\" src=\"js/keycontacts.js\"></script>
			<script type=\"text/javascript\" src=\"js/sidebar.js\"></script>
			<script type=\"text/javascript\" src=\"js/blockUI.js\" ></script>
			<script type=\"text/javascript\" src=\"js/dealstage.js\" ></script>
			
  </head>
  <body>
			";
		
		
		///////////////////
	echo $html;
	include 'inc/header.php';
	print_header("loggedin", $username, "");

		///////////////////	
	
	$html = "
		<div id=\"wrapper\">";
		
						
		echo $html;
			include 'inc/sidebar.php';
			
	$html = "
			<div class=\"container\">
				<ol class=\"breadcrumb\">
					  
 			<img src=\"assets/home.png\" height=\"15\" width=\"15\"> 
					  <li>Home</li>
					  <li class=\"active\">Deals</li>
					</ol>
			</div>
			
			<div class=\"container\">
			<h2 align='center'>Deals<h2>
			<div size=\"2\" style=\"text-align:center;  font-size: 13;\"><i>Click on deal name to edit/view deal details</i></div>
			<div size=\"2\" style=\"text-align:center;  font-size: 13;\"><i>Click on company to edit/view client details</i></div>
			<div size=\"2\" style=\"text-align:center;  font-size: 13;\"><i>Click on key contact to edit/view key contact details</i></div>
			<div size=\"2\" style=\"text-align:center;  font-size: 13;\"><i>Click on staff to edit/view staff details</i></div>
			<div size=\"2\" style=\"text-align:center;  font-size: 13;\"><i>Click on stage to edit deal stage</i></div>
			
			
			<table align=\"center\" class=\"table_custom table table-striped table-bordered table-hover table-condensed \" id=\"adminuser_table\" border=\"1\" >
				<thead>
				 <tr class\"active\">
					<th>Deal Name</th>
					<th>Company Name</th>
					<th>Key Contact</th>
					<th>Staff</th>
					<th>Stage</th>
					<th>Probability</th>
					<th colspan=\"2\"></th>
				  </tr>
			  </thead>
			  ";
  
		  
		$result = $db->query("SELECT `d_id`,`d_name`, `key_contact`.`kc_id`, `staff`.`s_id`,`client`.`c_id`, `d_size`, `d_contact`, `d_sale_stages`, `d_probability`, `d_weight_forcasting`, `d_next_step`, `d_starting_date`, `d_ending_date`, `d_comment`,`kc_name`,`s_name`,`c_company_name`

								FROM `deals`,`client`,`staff`,`key_contact` 

								WHERE `deals`.`kc_id` = `key_contact`.`kc_id` AND
								`deals`.`s_id` = `staff`.`s_id` AND
								`key_contact`.c_id = client.c_id");
		  
		  while($row = $result->fetch_assoc()) {
				  $html.=" <tr>
							<td class=\"success\"><a href=\"updatedeals.php?username=".$row["d_id"]."\">".$row["d_name"]."</a></td>
							<td class=\"success\"><a href=\"updateclient.php?username=".$row["c_id"]."\">".$row["c_company_name"]."</a></td>
							<td class=\"success\"><a href=\"updatekeycontact.php?username=".$row["kc_id"]."\">".$row["kc_name"]."</a></td>
							<td class=\"success\"><a href=\"updateadmin.php?username=".$row["s_id"]."\">".$row["s_name"]."</a></td>
							<td class=\"success\" style=\"cursor:pointer;\" onclick=\"dealClicked(".$row["d_id"].")\">".$row["d_sale_stages"]."</td>
							<td class=\"success\">".$row["d_probability"]."</td>
							<td class=\"success\"><a href=\"adddealinfo.php?username=".$row["d_id"]."\" class=\"btn btn-success\" type=\"button\">Add Info</a></td>
							<td class=\"success\"><a href=\"viewdealinfo.php?username=".$row["d_id"]."\" class=\"btn btn-success\" type=\"button\">View History</a></td>
						</tr>";
			}
			
			
				$html.="</table>
				<script language=\"javascript\" type=\"text/javascript\">
			//<![CDATA[
				var table2_Props = 	{
										
										col_7: \"none\",
										col_6: \"none\",
										
										display_all_text: \"  Show All  \",
										sort_select: true 
									};
				setFilterGrid( \"adminuser_table\",table2_Props );
			//]]>
		</script>	
	</div></div>
	<br>";
		echo $html;
		echo ' <!-- Change Name Modal -->
								<div id="changeNameModal" class="modal fade" >
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header" >
										<h4 class="modal-title">Update Deal Stage</h4>
									  </div>
									  <div class="modal-body" style="background:#efefef;">
										
										<div class="centered" style="width:60%; margin-left:auto; margin-right:auto;">
												
												<div class="control-group">
													<label class="control-label" for="prDesc">Deal Stage</label>
													<div class="controls">
													  <select type="text" class = "form-control input-group-lg" id="dstage">
														<option value="Suspect" >Suspect</option>
														<option value="Lead" >Lead</option>
														<option value="Prospect" >Prospect</option>
														<option value="Client" >Client</option>
														<option value="Not Pursue" >Not Pursue</option>
													  </select>
													</div>
												</div>
												
										  </div>
									
									  </div>
									  <div class="modal-footer" style="background:#efefef; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
										<button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
										<button type="button" class="btn btn-success" onclick="changeStage()">CHANGE</button>
									  </div>
									</div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->';
		include 'inc/footer.php';
	echo "</body>
		</html>";
		
		$db->close();