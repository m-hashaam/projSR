<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    
    if ($_POST['func'] == "main_feedback"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        
       
        $positive = array();
		$negative = array();
		$date = array();
        $query = "SELECT `rf_id`, `p_id`, `rf_positive`, `rf_negative`, `rf_date` FROM `rep_feedback` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
			$positive[] = $row['rf_positive'];
			$negative[] = $row['rf_negative'];
			$date[] = $row['rf_date'];
		}
		$all = array();
		$all[] = $positive;
		$all[] = $negative;
		$all[] = $date;
		echo json_encode($all);
       
	}
    else if ($_POST['func'] == "main_customers"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        
       
        $positive = array();
		$date = array();
        $query = "SELECT `rmc_id`, `p_id`, `rmc_date`, `rmc_val` FROM `rep_main_customers` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
			$positive[] = $row['rmc_val'];
			$date[] = $row['rmc_date'];
		}
		$all = array();
		$all[] = $positive;
		$all[] = $date;
		echo json_encode($all);
       
	}
    else if ($_POST['func'] == "main_responded"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        
       
        $positive = array();
		$date = array();
        $query = "SELECT `rms_id`, `p_id`, `rms_date`, `rms_val` FROM `rep_main_responded` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
			$positive[] = $row['rms_val'];
			$date[] = $row['rms_date'];
		}
		$all = array();
		$all[] = $positive;
		$all[] = $date;
		echo json_encode($all);
       
	}
    else if ($_POST['func'] == "main_kpi"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        
       
        $name = array();
		$val = array();
        $query = "SELECT `rmf_id`, `p_id`, `rmf_first_name`, `rmf_first_val`, `rmf_others_val` FROM `rep_main_feedback` WHERE `p_id` = $proid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()) {
			$name[] = $row['rmf_first_name'];
			$val[] = $row['rmf_first_val'];
            $name[] = 'Others';
			$val[] = $row['rmf_others_val'];
		}
		$all = array();
		$all[] = $name;
		$all[] = $val;
		echo json_encode($all);
       
	}
    else if ($_POST['func'] == "rep_kpi"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $week = $_POST['week'];
        
       
        $name = array();
        $positive = array();
		$negative = array();
        $query = "SELECT `rk_id`, `p_id`, `rk_name`, `rk_negative`, `rk_positive`, `rk_week`, `rk_pro_rating`, `rk_change_since` FROM `rep_kpi` WHERE `rk_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
			$name[] = $row['rk_name'];
            $positive[] = $row['rk_positive'];
			$negative[] = $row['rk_negative'];
		
		}
		$all = array();
		$all[] = $name;
        $all[] = $positive;
		$all[] = $negative;
		echo json_encode($all);
        //echo $query;
       
	}
    
    else if ($_POST['func'] == "rep_persona"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $week = $_POST['week'];
        
        $cities = array();
        $query = "SELECT distinct(`rp_city`) AS cities FROM `rep_persona` WHERE `rp_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
		      $cities[] = $row['cities'];
		}
        
        $persona = array();
        $query = "SELECT distinct(`rp_persona`) AS persona FROM `rep_persona` WHERE `rp_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
		      $persona[] = $row['persona'];
		}
        
        $values = array();
        $query = "SELECT `rp_persona`, `rp_city`, `rp_val` FROM `rep_persona` WHERE `rp_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
		      $values[$row['rp_city']][$row['rp_persona']] = $row['rp_val'];
		}
        
        $all = array();
        $temp = array();
        $temp[] = "Persona";
        for($i = 0 ; $i<count($cities) ; $i++){
            $temp[] = $cities[$i];
        }
        $all[] = $temp;
        
        for($i = 0 ; $i<count($persona) ; $i++){
            $temp = array();
            $temp[] = $persona[$i];
            for($j = 0 ; $j<count($cities) ; $j++){
                $temp[] = intval($values[$cities[$j]][$persona[$i]]);
            }
            $all[] = $temp;
        }
        
       
       
		echo json_encode($all);
        //echo $query;
       
	}
    
    else if ($_POST['func'] == "rep_brand_kpi"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $week = $_POST['week'];
        
       
       $name = array();
		$val = array();
        $query = "SELECT `rr_id`, `p_id`, `rr_week`, `rr_first`, `rr_second`, `rr_facebook`, `rr_tweets`, `rr_brand_adv` FROM `rep_referrals` WHERE `rr_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()) {
			$name[] = '1st Stage Referrals';
			$val[] = $row['rr_first'];
            $name[] = '2nd Stage Referrals';
			$val[] = $row['rr_second'];
		}
		$all = array();
		$all[] = $name;
		$all[] = $val;
		echo json_encode($all);
       
	}
    else if ($_POST['func'] == "rep_brand_conversion"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $week = $_POST['week'];
        
       
       $name = array();
		$val = array();
        $query = "SELECT `rc_id`, `p_id`, `rc_week`, `rc_reached`, `rc_engaged`, `rc_conversion`, `rc_promotion`, `rc_neutral` FROM `rep_conversion` WHERE `rc_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()) {
			$name[] = 'Reached';
			$val[] = $row['rc_reached'];
            $name[] = 'Engaged';
			$val[] = $row['rc_engaged'];
		}
		$all = array();
		$all[] = $name;
		$all[] = $val;
		echo json_encode($all);
       
	}
    
    else if ($_POST['func'] == "rep_engg"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $week = $_POST['week'];
        
        $cities = array();
        $query = "SELECT distinct(`re_day`) AS cities FROM `rep_engagement` WHERE `re_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
		      $cities[] = $row['cities']; //these are days
		}
        
        $persona = array();
        $query = "SELECT distinct(`re_hour`) AS persona FROM `rep_engagement` WHERE `re_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
		      $persona[] = $row['persona'];
		}
        
        $values = array();
        $query = "SELECT  `re_hour`, `re_day`, `re_val` FROM `rep_engagement` WHERE `re_week` = '$week' AND `p_id` = $proid";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()) {
		      $values[$row['re_day']][$row['re_hour']] = $row['re_val'];
		}
        
        $all = array();
        $temp = array();
        $temp[] = "Hour";
        for($i = 0 ; $i<count($cities) ; $i++){
            $temp[] = $cities[$i];
        }
        $all[] = $temp;
        
        for($i = 0 ; $i<count($persona) ; $i++){
            $temp = array();
            $temp[] = $persona[$i];
            for($j = 0 ; $j<count($cities) ; $j++){
                $temp[] = intval($values[$cities[$j]][$persona[$i]]);
            }
            $all[] = $temp;
        }
        
       
       
		echo json_encode($all);
        //echo $query;
       
	}
    
    else if ($_POST['func'] == "rep_fb_geo"){
		
        include "dbfb.php";
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $idate = $_SESSION['Realifbdate'];
        $edate = $_SESSION['Realefbdate'];
        $fbdbid = $_SESSION['fbdbid'];
        
        
        
        $all = array();
        $temp = array();
        $temp[] = "Country";
        $temp[] = "Fans";
        $all[] = $temp;
        
        $query = "SELECT `p_id`, `i_country`, `i_likes`, `i_date` FROM `insights` WHERE `i_date` = '$idate' AND `p_id` = $fbdbid ORDER BY `i_likes` desc";
        $stmt = $dbfb->query($query);
        while($row = $stmt->fetch_assoc()){
            $temp = array();
            $temp[] = $row['i_country'];
            $temp[] = intval($row['i_likes']);
            $all[] = $temp;
        }
       	echo json_encode($all);
        $dbfb->close();
       
	}
    
    else if ($_POST['func'] == "rep_fb_pie"){
		
        include "dbfb.php";
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $idate = $_SESSION['ifbdate'];
        $edate = $_SESSION['efbdate'];
        $fbdbid = $_SESSION['fbdbid'];
        
        
        
        $all = array();
        $temp = array();
        $temp[] = "Type";
        $temp[] = "Total Interactions";
        $all[] = $temp;
        
        $query = "SELECT SUM(`post_shares`) AS shares, SUM(`post_likes`) As likes, SUM(`post_comments`) AS comments, SUM(`post_haha`) AS hahas, SUM(`post_love`) AS loves, SUM(`post_wow`) AS wows FROM `post` WHERE `post_createdon` >= '$idate' AND `post_createdon` <= '$edate' AND `p_id` = $fbdbid";
        $stmt = $dbfb->query($query);
        while($row = $stmt->fetch_assoc()){
            if(intval($row['comments']) > 0){
                $temp = array();
                $temp[] = "Comments";
                $temp[] = intval($row['comments']);
                $all[] = $temp;
            }
            if(intval($row['likes']) > 0){
                $temp = array();
                $temp[] = "Likes";
                $temp[] = intval($row['likes']);
                $all[] = $temp;
            }
            if(intval($row['shares']) > 0){
                $temp = array();
                $temp[] = "Shares";
                $temp[] = intval($row['shares']);
                $all[] = $temp;
            }
            if(intval($row['hahas']) > 0){
                $temp = array();
                $temp[] = "Haha";
                $temp[] = intval($row['hahas']);
                $all[] = $temp;
            }
            if(intval($row['loves']) > 0){
                $temp = array();
                $temp[] = "Love";
                $temp[] = intval($row['loves']);
                $all[] = $temp;
            }
            if(intval($row['wows']) > 0){
                $temp = array();
                $temp[] = "Wow";
                $temp[] = intval($row['wows']);
                $all[] = $temp;
            }
            
        }
       	echo json_encode($all);
        $dbfb->close();
       
	}
    else if ($_POST['func'] == "rep_fb_posttype"){
		
        include "dbfb.php";
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $idate = $_SESSION['ifbdate'];
        $edate = $_SESSION['efbdate'];
        $fbdbid = $_SESSION['fbdbid'];
        
        
        
        $all = array();
        $temp = array();
        $temp[] = "Type";
        $temp[] = "Total Posts";
        $all[] = $temp;
        
        $query = "SELECT COUNT(`post_id`) AS posts, `post_type` FROM `post` WHERE `post_createdon` >= '$idate' AND `post_createdon` <= '$edate' AND `p_id` = $fbdbid GROUP BY `post_type`";
        $stmt = $dbfb->query($query);
        while($row = $stmt->fetch_assoc()){
            $temp = array();
            $temp[] = $row['post_type'];
            $temp[] = intval($row['posts']);
            $all[] = $temp;
          
        }
       	echo json_encode($all);
        $dbfb->close();
       
	}
    else if ($_POST['func'] == "rep_f_posts"){
		
        include "dbfb.php";
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $idate = $_SESSION['ifbdate'];
        $edate = $_SESSION['efbdate'];
        $fbdbid = $_SESSION['fbdbid'];
        
        
        
        $all = array();
        $posts = array();
        $yy = array();
        $mm = array();
        $dd = array();
        $query = "SELECT COUNT(`post_id`) AS posts, `post_createdon`,YEAR(`post_createdon`) AS yy, MONTH(`post_createdon`) AS mm, DAY(`post_createdon`) AS dd FROM `post` WHERE `post_createdon` >= '$idate' AND `post_createdon` <= '$edate' AND `p_id` = $fbdbid GROUP BY `post_createdon` ORDER BY `post_createdon` ";
        $stmt = $dbfb->query($query);
        while($row = $stmt->fetch_assoc()){
            
            $posts[] = intval($row['posts']);
            $yy[] = intval($row['yy']);
            $mm[] = intval($row['mm']);
            $dd[] = intval($row['dd']);
          
        }
        $all[] = $posts;
        $all[] = $yy;
        $all[] = $mm;
        $all[] = $dd;
        $allDone = json_encode($all);
        //$allDone = preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:',$allDone);
       	echo $allDone;
        $dbfb->close();
       
	}
    else if ($_POST['func'] == "rep_f_engg"){
		
        include "dbfb.php";
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $idate = $_SESSION['ifbdate'];
        $edate = $_SESSION['efbdate'];
        $fbdbid = $_SESSION['fbdbid'];
        
        
        
        $all = array();
        $shares = array();
        $comments = array();
        $reactions = array();
        $yy = array();
        $mm = array();
        $dd = array();
        $query = "SELECT SUM(`post_shares`) AS shares, SUM(`post_comments`) AS comments,(SUM(`post_likes`)+SUM(`post_haha`)+SUM(`post_love`)+SUM(`post_wow`)) AS reactions, `post_createdon`,YEAR(`post_createdon`) AS yy, MONTH(`post_createdon`) AS mm, DAY(`post_createdon`) AS dd FROM `post` WHERE `post_createdon` >= '$idate' AND `post_createdon` <= '$edate' AND `p_id` = $fbdbid GROUP BY `post_createdon` ORDER BY `post_createdon` ";
        $stmt = $dbfb->query($query);
        while($row = $stmt->fetch_assoc()){
            
            $shares[] = intval($row['shares']);
            $comments[] = intval($row['comments']);
            $reactions[] = intval($row['reactions']);
            $yy[] = intval($row['yy']);
            $mm[] = intval($row['mm']);
            $dd[] = intval($row['dd']); 
          
        }
        $all[] = $shares;
        $all[] = $yy;
        $all[] = $mm;
        $all[] = $dd;
        $all[] = $comments;
        $all[] = $reactions;
        $allDone = json_encode($all);
        //$allDone = preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:',$allDone);
       	echo $allDone;
        $dbfb->close();
       
	}
    else if ($_POST['func'] == "rep_f_fans"){
		
        include "dbfb.php";
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $idate = $_SESSION['ifbdate'];
        $edate = $_SESSION['efbdate'];
        $fbdbid = $_SESSION['fbdbid'];
        
        
        
        $all = array();
        $shares = array();
        $yy = array();
        $mm = array();
        $dd = array();
        $query = "SELECT SUM(`i_likes`) AS likes,`i_date`,YEAR(`i_date`) AS yy, MONTH(`i_date`) AS mm, DAY(`i_date`) AS dd FROM `insights` WHERE `i_date` >= '$idate' AND `i_date` <= '$edate' AND `p_id` = $fbdbid GROUP BY `i_date` ORDER BY `i_date`";
        $stmt = $dbfb->query($query);
        while($row = $stmt->fetch_assoc()){
            
            $shares[] = intval($row['likes']);
            $yy[] = intval($row['yy']);
            $mm[] = intval($row['mm']);
            $dd[] = intval($row['dd']); 
          
        }
        $all[] = $shares;
        $all[] = $yy;
        $all[] = $mm;
        $all[] = $dd;
        $all[] = $query;
        $allDone = json_encode($all);
        //$allDone = preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:',$allDone);
       	echo $allDone;
        $dbfb->close();
       
	}
    
    else if ($_POST['func'] == "rep_fb_addPage"){
		
        
        $proid = $_SESSION['CurrentProductID'];
        $token = $_POST['token'];
        
        $query = "UPDATE `product` SET `p_fb_token`='$token' WHERE `p_id`=$proid";
        $db->query($query);
        
        if(isset($_SESSION['sub_idSR'])){
            $userid = $_SESSION['sub_idSR'];
            $photolink = "https://www.facebookbrand.com/img/fb-art.jpg";
            $pagelink = "changeproduct.php?id=".$proid;
            $query = "INSERT INTO `notifications`( `su_id`, `n_text`, `n_link`, `n_icon`) 
                                    VALUES ($userid,'Product facebook page linked','$pagelink','$photolink' )";
            $db->query($query);
            $userid = $_SESSION['idSR'];
            $query = "INSERT INTO `notifications`( `u_id`, `n_text`, `n_link`, `n_icon`) 
                                    VALUES ($userid,'Product facebook page linked','$pagelink','$photolink' )";
            $db->query($query);
            
        }
        else if(isset($_SESSION['idSR'])){
            $userid = $_SESSION['idSR'];
            $photolink = "https://www.facebookbrand.com/img/fb-art.jpg";
            $pagelink = "changeproduct.php?id=".$proid;
            $query = "INSERT INTO `notifications`( `u_id`, `n_text`, `n_link`, `n_icon`) 
                                    VALUES ($userid,'Product facebook page linked','$pagelink','$photolink' )";
            $db->query($query);
        }
        
        
        
       
	}
    
}
$db->close();
		