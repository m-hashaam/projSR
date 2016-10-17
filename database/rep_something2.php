<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    if ($_POST['func'] == "getcities"){
	    
    	$city = array();
        $latlong = array();
        $reach1 = array();
        $social1 = array();
        $senti1 = array();
        $resi1 = array();
        $house1 = array();
        $male1 = array();
        $female1 = array();
        $age11 = array();
        $age12 = array();
        $age13 = array();
        $age14 = array();
        $age15 = array();
        $ptrial1 = array();
        $lcard1 = array();
        $evouch1 = array();
        $referral1 = array();
        $hw1 = array();
        $unemp1 = array();
        $emp1 = array();
        $busi1 = array();
        $stu1 = array();
        
        $proid = $_SESSION['CurrentProductID'];
        $query = "SELECT `city`, `latlong` FROM `rep_tempdata7_geocity`";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
            $city[] = $row['city'];
            $latlong[] = $row['latlong'];
            $query2 = "SELECT SUM( `reach`) AS reachs, SUM(`socialindex`)/COUNT(`socialindex`) AS socials, SUM(`sentiment`)/COUNT(`sentiment`) AS senti, SUM(`residents`) AS resi , SUM(`household`) AS house, SUM(`male`) AS males, SUM(`female`) AS females, SUM(`age1825`) AS f, SUM(`age2635`) AS s, SUM(`age3645`) AS t, SUM(`age4655`) AS fo, SUM(`age55above`) AS fi, SUM(`producttrials`) AS pt, SUM(`layaltycard`) AS lc, SUM(`elecvoucher`) AS ev, SUM(`referrals`) AS ref, SUM(`housewives`) AS hw, SUM(`employed`) AS emp, SUM(`businessmen`) AS bm, SUM(`unemployed`) AS unemp, SUM(`students`) AS stu FROM `rep_tempdata8_geoarea` WHERE `city` = '".$row['city']."'";
            $stmtt = $db->query($query2);
            if($roww = $stmtt->fetch_assoc()){
                $reach1[] = $roww['reachs'];
                $social1[] = $roww['socials'];
                $senti1[] = $roww['senti'];
                $resi1[] = $roww['resi'];
                $house1[] = $roww['house'];
                $male1[] = $roww['males'];
                $female1[] = $roww['females'];
                $age11[] = $roww['f'];
                $age12[] = $roww['s'];
                $age13[] = $roww['t'];
                $age14[] = $roww['fo'];
                $age15[] = $roww['fi'];
                $ptrial1[] = $roww['pt'];
                $lcard1[] = $roww['lc'];
                $evouch1[] = $roww['ev'];
                $referral1[] = $roww['ref'];
                $hw1[] = $roww['hw'];
                $unemp1[] = $roww['unemp'];
                $emp1[] = $roww['emp'];
                $busi1[] = $roww['bm'];
                $stu1[] = $roww['stu'];
            }
        }
        $all = array();
        $all[] = $city;
        $all[] = $latlong;
        $all[] = $reach1;
        $all[] = $social1;
        $all[] = $senti1;
        $all[] = $resi1;
        $all[] = $house1;
        $all[] = $male1;
        $all[] = $female1;
        $all[] = $age11;
        $all[] = $age12;
        $all[] = $age13;
        $all[] = $age14;
        $all[] = $age15;
        $all[] = $ptrial1;
        $all[] = $lcard1;
        $all[] = $evouch1;
        $all[] = $referral1;
        $all[] = $hw1;
        $all[] = $unemp1;
        $all[] = $emp1;
        $all[] = $busi1;
        $all[] = $stu1;
        echo json_encode($all);
	}
    else if ($_POST['func'] == "getareas"){
	    
    	$city = array();
        $latlong = array();
        
        $city1 = $_POST['city'];
        
        $proid = $_SESSION['CurrentProductID'];
        $query = "SELECT `city`, `area`, `reach`, `socialindex`, `sentiment`, `residents`, `household`, `male`, `female`, `age1825`, `age2635`, `age3645`, `age4655`, `age55above`, `producttrials`, `layaltycard`, `elecvoucher`, `referrals`, `housewives`, `employed`, `businessmen`, `unemployed`, `students`, `latlong` FROM `rep_tempdata8_geoarea` WHERE `city` = '$city1'";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
            $city[] = $row['area'];
            $latlong[] = $row['latlong'];
        }
        $all = array();
        $all[] = $city;
        $all[] = $latlong;
        echo json_encode($all);
	}
    
    else if ($_POST['func'] == "getStartGender"){
	    
        
        $proid = $_SESSION['CurrentProductID'];
        $query = "SELECT SUM(`male`) AS males, SUM(`female`) AS females FROM `rep_tempdata8_geoarea` WHERE 1";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $all = array();
            $all[] = $row['males'];
            $all[] = $row['females'];
            echo json_encode($all);
        }
        
	}
    
    else if ($_POST['func'] == "getStartAge"){
	    
        
        $proid = $_SESSION['CurrentProductID'];
        $query = "SELECT SUM(`age1825`) AS f, SUM(`age2635`) AS s, SUM(`age3645`) AS t, SUM(`age4655`) AS fo, SUM(`age55above`) AS fi FROM `rep_tempdata8_geoarea` WHERE 1";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $all = array();
            $all[] = $row['f'];
            $all[] = $row['s'];
            $all[] = $row['t'];
            $all[] = $row['fo'];
            $all[] = $row['fi'];
            echo json_encode($all);
        }
        
	}
    
}

$db->close();
		