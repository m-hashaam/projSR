<?php
if ($_POST['func'] == "rep_companies"){
		
        $dbhost = "localhost"; 
		$dbname = "sweetreferralsce_peoples"; 
		$dbuser = "sweetref_portal"; 
		$dbpass=  "Popo1122!!@@";
		
		$db3 = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");
      
        
        
        
        $all = array();
        //$temp = array();
        //$temp[] = "Company";
        //$temp[] = "Score";
        //$all[] = $temp;
        $comp = array();
        $score = array();
        $diver = array();
        $team = array();
        $enthu = array();
        $social = array();
        $catee = array();
        $acc = array();
        $categories = array();
        $prods = array();
        $addresses = array();
        $execs = array();
        
        $query = "SELECT `s_id`, `s_name`, `s_diversity`,`s_category`, `s_team`, `s_enthusiasm`, `s_social_presense`, `s_accessible`, `s_score` FROM `scores` ORDER BY `s_score` DESC";
        $stmt = $db3->query($query);
        while($row = $stmt->fetch_assoc()){
            //$temp = array();
            //$temp[] = str_replace("'","\'",$row['s_name']);
            //$temp[] = $row['s_name'];
            //$temp[] = floatval($row['s_score']);
            //$all[] = $temp;
            $comp[] = $row['s_name'];
            $score[] = $row['s_score'];
            $diver[] = $row['s_diversity'];
            $team[] = $row['s_team'];
            $enthu[] = $row['s_enthusiasm'];
            $catee[] = $row['s_category'];
            $social[] = $row['s_social_presense'];
            $acc[] = $row['s_accessible'];
            $cat = array();
            $prod = array();
            
            $query2 = "SELECT `cat_name` FROM `categories` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $cat[] = $row2['cat_name'];
            }
            $categories[] = $cat;
            
            
            $query2 = "SELECT `p_name` FROM `products` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $prod[] = utf8_decode($row2['p_name']);
            }
            $prods[] = $prod;
            
            
            $addr = array();
            $query2 = "SELECT `a_address` FROM `address` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $addr[] = utf8_decode($row2['a_address']);
            }
            $addresses[] = $addr;
            
            
            $name = array();
            $desig = array();
            $linked = array();
            $query2 = "SELECT `e_name`, `e_designation`, `e_linkedin`, `e_isbooklet` FROM `exec` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $name[] = utf8_decode($row2['e_name']);
                $desig[] = utf8_decode($row2['e_designation']);
                $linked[] = utf8_decode($row2['e_linkedin']);
            }
            $ind_exec = array();
            $ind_exec[] = $name;
            $ind_exec[] = $desig;
            $ind_exec[] = $linked;
            $execs[] = $ind_exec;
        }
        $all[] = $comp;
        $all[] = $score;
        $all[] = $diver;
        $all[] = $team;
        $all[] = $enthu;
        $all[] = $social;
        $all[] = $acc;
        $all[] = $categories;
        $all[] = $prods;
        $all[] = $addresses;
        $all[] = $execs;
        $all[] = $catee;
       	echo json_encode($all);
        $db3->close();
       
	}
    else if ($_POST['func'] == "rep_companies2"){
		
        $dbhost = "localhost"; 
		$dbname = "sweetreferralsce_peoples"; 
		$dbuser = "sweetref_portal"; 
		$dbpass=  "Popo1122!!@@";
		
		$db3 = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");
      
        
        $values = $_POST['values'];
        
        $all = array();
        //$temp = array();
        //$temp[] = "Company";
        //$temp[] = "Score";
        //$all[] = $temp;
        $comp = array();
        $score = array();
        $diver = array();
        $team = array();
        $enthu = array();
        $social = array();
        $acc = array();
        $catee = array();
        $categories = array();
        $prods = array();
          $addresses = array();
        $execs = array();
        
        $query = "SELECT `s_id`, `s_name`,`s_category`, `s_diversity`, `s_team`, `s_enthusiasm`, `s_social_presense`, `s_accessible`, `s_score` FROM `scores` WHERE ".$values." ORDER BY `s_score` DESC";
        //echo $query;
        $stmt = $db3->query($query);
        while($row = $stmt->fetch_assoc()){
            //$temp = array();
            //$temp[] = str_replace("'","\'",$row['s_name']);
            //$temp[] = $row['s_name'];
            //$temp[] = floatval($row['s_score']);
            //$all[] = $temp;
            $comp[] = $row['s_name'];
            $score[] = $row['s_score'];
            $diver[] = $row['s_diversity'];
            $team[] = $row['s_team'];
            $enthu[] = $row['s_enthusiasm'];
            $social[] = $row['s_social_presense'];
            $catee[] = $row['s_category'];
            $acc[] = $row['s_accessible'];
            $cat = array();
            $prod = array();
            
            $query2 = "SELECT `cat_name` FROM `categories` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $cat[] = $row2['cat_name'];
            }
            
            $query2 = "SELECT `p_name` FROM `products` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $prod[] = utf8_decode($row2['p_name']);
            }
            
            $categories[] = $cat;
            $prods[] = $prod;  $addr = array();
            $query2 = "SELECT `a_address` FROM `address` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $addr[] = utf8_decode($row2['a_address']);
            }
            $addresses[] = $addr;
            
            
            $name = array();
            $desig = array();
            $linked = array();
            $query2 = "SELECT `e_name`, `e_designation`, `e_linkedin`, `e_isbooklet` FROM `exec` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $name[] = utf8_decode($row2['e_name']);
                $desig[] = utf8_decode($row2['e_designation']);
                $linked[] = utf8_decode($row2['e_linkedin']);
            }
            $ind_exec = array();
            $ind_exec[] = $name;
            $ind_exec[] = $desig;
            $ind_exec[] = $linked;
            $execs[] = $ind_exec;
        }
        $all[] = $comp;
        $all[] = $score;
        $all[] = $diver;
        $all[] = $team;
        $all[] = $enthu;
        $all[] = $social;
        $all[] = $acc;
        $all[] = $categories;
        $all[] = $prods;
        $all[] = $addresses;
        $all[] = $execs;
        $all[] = $catee;
       	echo json_encode($all);
        $db3->close();
       
	}
    
    else if ($_POST['func'] == "rep_companies3"){
		
        $dbhost = "localhost"; 
		$dbname = "sweetreferralsce_peoples"; 
		$dbuser = "sweetref_portal"; 
		$dbpass=  "Popo1122!!@@";
		
		$db3 = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");
      
        
        $values = $_POST['values'];
        
        $all = array();
        //$temp = array();
        //$temp[] = "Company";
        //$temp[] = "Score";
        //$all[] = $temp;
        $comp = array();
        $score = array();
        $diver = array();
        $team = array();
        $enthu = array();
        $social = array();
        $acc = array();
        $catee = array();
        $categories = array();
        $prods = array();
          $addresses = array();
        $execs = array();
        
        $query = "SELECT `s_id`, `s_name` ,`s_category`, `s_diversity`, `s_team`, `s_enthusiasm`, `s_social_presense`, `s_accessible`, `s_score` FROM `scores` WHERE s_name like '%".$values."%' OR s_category like '%".$values."%' ORDER BY `s_score` DESC";
        //echo $query;
        $stmt = $db3->query($query);
        while($row = $stmt->fetch_assoc()){
            //$temp = array();
            //$temp[] = str_replace("'","\'",$row['s_name']);
            //$temp[] = $row['s_name'];
            //$temp[] = floatval($row['s_score']);
            //$all[] = $temp;
            $comp[] = $row['s_name'];
            $score[] = $row['s_score'];
            $diver[] = $row['s_diversity'];
            $team[] = $row['s_team'];
            $enthu[] = $row['s_enthusiasm'];
            $catee[] = $row['s_category'];
            $social[] = $row['s_social_presense'];
            $acc[] = $row['s_accessible'];
            $cat = array();
            $prod = array();
            
            $query2 = "SELECT `cat_name` FROM `categories` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $cat[] = $row2['cat_name'];
            }
            
            $query2 = "SELECT `p_name` FROM `products` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $prod[] = utf8_decode($row2['p_name']);
            }
            
            $categories[] = $cat;
            $prods[] = $prod;
              $addr = array();
            $query2 = "SELECT `a_address` FROM `address` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $addr[] = utf8_decode($row2['a_address']);
            }
            $addresses[] = $addr;
            
            
            $name = array();
            $desig = array();
            $linked = array();
            $query2 = "SELECT `e_name`, `e_designation`, `e_linkedin`, `e_isbooklet` FROM `exec` WHERE `s_id` = ".$row['s_id'];
            $stmt2 = $db3->query($query2);
            while($row2 = $stmt2->fetch_assoc()){
                $name[] = utf8_decode($row2['e_name']);
                $desig[] = utf8_decode($row2['e_designation']);
                $linked[] = utf8_decode($row2['e_linkedin']);
            }
            $ind_exec = array();
            $ind_exec[] = $name;
            $ind_exec[] = $desig;
            $ind_exec[] = $linked;
            $execs[] = $ind_exec;
        }
        $all[] = $comp;
        $all[] = $score;
        $all[] = $diver;
        $all[] = $team;
        $all[] = $enthu;
        $all[] = $social;
        $all[] = $acc;
        $all[] = $categories;
        $all[] = $prods;
        $all[] = $addresses;
        $all[] = $execs;
        $all[] = $catee;
       	echo json_encode($all);
        $db3->close();
       
	}