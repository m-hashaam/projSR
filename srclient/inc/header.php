<?php

function print_header ($type , $username, $active){
	
	$headera = "";
	if ($type == "loggedin"){
			$headera = "<nav style=\"background:#3c8dbc; border-color:#3c8dbc; \" class=\"navbar navbar-inverse \" role=\"navigation\">
			
					<div class=\"navbar-header\">
					  <a class=\"navbar-brand\" style=\"color:white;\" >SweetReferrals Clients Management</a>
				   </div>
				
					 <div class=\"collapse navbar-collapse \" id=\"example-navbar-collapse\" >
					  <ul class=\"nav navbar-nav navbar-right\">
						 <li class=\"";
				
			if ($active == "home"){
				$headera.=" active";
			}
			$headera .="\">
							<a href=\"index.php\">Home</a>
						 </li>
			
			
			
						 
							 
			
							<li class=\"dropdown-submenu";
		
			if($active == "changepass"){
				$headera.=" active";
			}
							$headera .="\">
					            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">
					               ".$username."
					               <span class=\"caret\"></span>
					            </a>
					            <ul class=\"dropdown-menu\" role=\"menu\">
									<li><a href=\"changepass.php\">Change Password</a></li>
							        <li><a href=\"authentication/logout.php\">Logout</a></li>
					            </ul>
				        	</li>
				
					  </ul>
			
			
				   </div>
				</nav>";
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
