<?php

$sidebar = "<div id=\"sidebar-wrapper\">
            <ul class=\"sidebar-nav\">
                <li class=\"sidebar-brand\">
                    <a>
                        Admin Controls
                    </a>
                </li>
                <li>
                    <a href=\"staff.php\">Manage Staff</a>
                </li>
                <li>
                    <a href=\"clients.php\">Manage Clients</a>
                </li>
				<li>
                    <a href=\"keycontacts.php\">Manage Key Contacts</a>
                </li>
				<li>
                    <a href=\"deals.php\">Manage Deals</a>
                </li>
				<li>
                    <a href=\"dealsinfo.php\">Add Info for a Deal</a>
                </li>
                <li>
                    <a href=\"authentication/logout.php\">Logout</a>
                </li>
            </ul>
        </div>
     
      
                        
		<img style = \"position:fixed; top:45% ; z-index:999 ; cursor:pointer; \" src=\"assets/arrow.png\" id=\"menu-toggle\" width=30 height=50/>";
		
		echo $sidebar;