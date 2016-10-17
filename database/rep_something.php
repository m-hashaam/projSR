<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    if ($_POST['func'] == "getAjeebDonutDataNew"){
	    
    	$proid = $_SESSION['CurrentProductID'];
        $toReturn = array();
        $toReturn[] = "Total Magnitude";
        if(isset($_POST['timeline'])){
            $daysRange = $_POST['timeline'];
        }
        else{
            $daysRange = 7;   
        }
        if(isset($_POST['persona'])){
            $persona = $_POST['persona'];
        }
        else{
            $persona = "all";   
        }
        $currentDate = '2016-10-08';
        $qq = "SELECT `color`, `shade` FROM `colors` ORDER BY `color`";
        $ss = $db->query($qq);
        $rr = $ss->fetch_assoc();
        $color = $rr['color'];
        
        
        
        $totalMag = 0;
        $query = "SELECT SUM(`rt4_reach`)+SUM(`rt4_engg`) AS tmag, SUM(`rt4_reach`) AS reachs, SUM(`rt4_sent`) AS effec
                    FROM `rep_tempdata4` 
                    WHERE `rt4_date` <= '".$currentDate."' 
                    AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                    AND `rt4_product` = '$proid'";
        if($persona != "all"){
            $query.=" AND rt4_persona = '$persona'";
        }
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $tempArray = array();
            $tempArray[] = $row['tmag'];
            $tempArray[] = $row['tmag'];
            $totalMag = $row['tmag'];
            $tempArray[] = $color;
            $tempArray[] = "";
            $tempArray[] = "";
            $tempArray[] = $row['reachs'];
            $tempArray[] = $row['effec'];
            $toReturn[] = $tempArray;
        }
        
        $query = "SELECT `rt4_aspect`,SUM(`rt4_reach`)+SUM(`rt4_engg`) AS tmag, SUM(`rt4_reach`) AS reachs, SUM(`rt4_sent`) AS effec
                    FROM `rep_tempdata4` 
                    WHERE `rt4_date` <= '".$currentDate."' 
                    AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                    AND `rt4_product` = '$proid'";
        if($persona != "all"){
            $query.=" AND rt4_persona = '$persona'";
        }
        $query.=" GROUP BY `rt4_aspect`";
        $stmt = $db->query($query);
        $third = array();
        while($row = $stmt->fetch_assoc()){
            while($color == $rr['color']){
                $rr = $ss->fetch_assoc();   
            }
            $ttArray = array();
            $ttArray[] = $row['rt4_aspect'];
            $tempArray = array();
            $tempArray[] = $row['tmag'];
            $tempArray[] = $row['tmag'];
            $inMag = $row['tmag'];
            $perc = ($inMag / $totalMag)*100;
            $perc = number_format($perc,0);
            $tempArray[] = $rr['color'];
            $tempArray[] = "";
            $tempArray[] = $perc;
            $tempArray[] = $row['reachs'];
            $tempArray[] = $row['effec'];
            $color = $rr['color'];
            $ttArray[] = $tempArray;
            $query2 = "SELECT `rt4_persona`,SUM(`rt4_reach`)+SUM(`rt4_engg`) AS tmag, SUM(`rt4_reach`) AS reachs, SUM(`rt4_sent`) AS effec
                    FROM `rep_tempdata4` 
                    WHERE `rt4_date` <= '".$currentDate."' 
                    AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                    AND `rt4_product` = '$proid'";
            if($persona != "all"){
                $query2.=" AND `rt4_persona` = '$persona'";
            }        
            $query2.=" AND `rt4_aspect` = '".$row['rt4_aspect']."'
                    GROUP BY `rt4_persona`";
            $st2 = $db->query($query2);
            $fourth = array();
            $isAnyPersona = false;
            while($r2 = $st2->fetch_assoc()){
                $isAnyPersona = true;
                $ininMag = 0;
                $ttArray2 = array();
                $ttArray2[] = $r2['rt4_persona'];
                $tempArray = array();
                $tempArray[] = $r2['tmag'];
                $tempArray[] = $r2['tmag'];
                $ininMag  = $r2['tmag'];
                $lperc = ($ininMag / $inMag)*100;
                $lperc = number_format($lperc,0);
                $tempArray[] = $rr['shade'];
                $tempArray[] = $row['rt4_aspect'];
                $tempArray[] = $lperc;
                $tempArray[] = $r2['reachs'];
                $tempArray[] = $r2['effec'];
             
                $ttArray2[] = $tempArray;
                $ttArray2[] = null;
                $fourth[$r2['rt4_persona']] = $ttArray2;
                $rr = $ss->fetch_assoc();
            }
            if($isAnyPersona){
                $ttArray[] = $fourth;
                $third[$row['rt4_aspect']] = $ttArray;   
            }   
        }
        $toReturn[] = $third;
        echo json_encode($toReturn);
      
	}
    
    else if ($_POST['func'] == "getScatterGraphDataNew"){
        
        $name = array();
        $mag = array();
        $effec = array();
        $reach = array();
        $colorr = array();
        $parent = array();
        $proid = $_SESSION['CurrentProductID'];
        if(isset($_POST['timeline'])){
            $daysRange = $_POST['timeline'];
        }
        else{
            $daysRange = 7;   
        }
        if(isset($_POST['persona'])){
            $persona = $_POST['persona'];
        }
        else{
            $persona = "all";   
        }
        $currentDate = '2016-10-08';
        
        $qq = "SELECT `color`, `shade` FROM `colors` ORDER BY `color`";
        $ss = $db->query($qq);
        $rr = $ss->fetch_assoc();
        $color = $rr['color'];
        
        $query = "SELECT `rt4_aspect`,SUM(`rt4_reach`)+SUM(`rt4_engg`) AS tmag, SUM(`rt4_reach`) AS reachs, SUM(`rt4_sent`) AS effec
                    FROM `rep_tempdata4` 
                    WHERE `rt4_date` <= '".$currentDate."' 
                    AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                    AND `rt4_product` = '$proid'";
        if($persona != "all"){
            $query.=" AND rt4_persona = '$persona'";
        }
        $query.="  GROUP BY `rt4_aspect`";
        //echo $query;
        $stmt = $db->query($query);
        $third = array();
        while($row = $stmt->fetch_assoc()){
            while($color == $rr['color']){
                $rr = $ss->fetch_assoc();   
            }
            $name[] = $row['rt4_aspect'];
            $parent[] = $row['rt4_aspect'];
            $mag[] = $row['tmag'];
            $effec[] = $row['effec'];
            $reach[] = $row['reachs'];
            $colorr[] = $rr['color'];
            $color = $rr['color'];
            $query2 = "SELECT `rt4_persona`,SUM(`rt4_reach`)+SUM(`rt4_engg`) AS tmag, SUM(`rt4_reach`) AS reachs, SUM(`rt4_sent`) AS effec
                        FROM `rep_tempdata4` 
                        WHERE `rt4_date` <= '".$currentDate."' 
                        AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                        AND `rt4_product` = '$proid'";
            if($persona != "all"){
                $query2.=" AND `rt4_persona` = '$persona'";
            }            
            $query2.=" AND `rt4_aspect` = '".$row['rt4_aspect']."'
                        GROUP BY `rt4_persona`";
            $st2 = $db->query($query2);
            $fourth = array();
            while($r2 = $st2->fetch_assoc()){
                $name[] = $r2['rt4_persona'];
                $mag[] = $r2['tmag'];
                $effec[] = $r2['effec'];
                $colorr[] = $rr['shade'];
                $reach[] = $r2['reachs'];
                $parent[] = $row['rt4_aspect'];
                $rr = $ss->fetch_assoc();
            }
        }
        
        $all = array();
        $all[] = $name;
        $all[] = $effec;
        $all[] = $reach;
        $all[] = $mag;
        $all[] = $colorr;
        $all[] = $parent;
        echo json_encode($all);
    }
    
    else if($_POST['func'] == "getGeoData"){
        
        $loc = array();
        $reach = array();
        $senti = array();
        $conv = array();
        $male = array();
        $female = array();
        $resid = array();
        $age1520 = array();
        $age2130 = array();
        $age3140 = array();
        $age4150 = array();
        $age5160 = array();
        $age60 = array();
        $house = array();
        $empl = array();
        $busin = array();
        $unemp = array();
        $stud = array();
        $query = "SELECT `rt3_loc`, `reach`, `senti`, `conv`, `male`, `female`, `resid`, `1520`, `2130`, `3140`, `4150`, `5160`, `60above`, `housewive`, `employed`, `business`, `unemp`, `student` FROM `rep_tempdata3` WHERE 1";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
            $loc[] = $row['rt3_loc'];
            $reach[] = $row['reach'];
            $senti[] = $row['senti'];
            $conv[] = $row['conv'];
            $male[] = $row['male'];
            $female[] = $row['female'];
            $resid[] = $row['resid'];
            $age1520[] = $row['1520'];
            $age2130[] = $row['2130'];
            $age3140[] = $row['3140'];
            $age4150[] = $row['4150'];
            $age5160[] = $row['5160'];
            $age60[] = $row['60above'];
            $house[] = $row['housewive'];
            $empl[] = $row['employed'];
            $busin[] = $row['business'];
            $unemp[] = $row['unemp'];
            $stud[] = $row['student'];
        }
        $all = array();
        $all[] = $loc;
        $all[] = $reach;
        $all[] = $senti;
        $all[] = $conv;
        $all[] = $male;
        $all[] = $female;
        
        $all[] = $resid;
        $all[] = $age1520;
        $all[] = $age2130;
        $all[] = $age3140;
        $all[] = $age4150;
        $all[] = $age5160;
        
        $all[] = $age60;
        $all[] = $house;
        $all[] = $empl;
        $all[] = $busin;
        $all[] = $unemp;
        $all[] = $stud;
        echo json_encode($all);
    }
    
    else if($_POST['func'] == "getNewReachData"){
        
        $day = array();
        $month = array();
        $year = array();
        $reach = array();
        $proid = $_SESSION['CurrentProductID'];
        if(isset($_POST['timeline'])){
            $daysRange = $_POST['timeline'];
        }
        else{
            $daysRange = 7;   
        }
        if(isset($_POST['aspect'])){
            $aspect = $_POST['aspect'];
        }
        else{
            $aspect = "all";   
        }
        if(isset($_POST['persona'])){
            $persona = $_POST['persona'];
        }
        else{
            $persona = "all";   
        }
        $currentDate = '2016-10-08';
        
        
        $query = "SELECT SUM(`rt4_reach`) AS reachs ,day(`rt4_date`) AS days, month(`rt4_date`) AS months, year(`rt4_date`) AS years 
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= '".$currentDate."' 
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                AND `rt4_product` = '$proid'";
        if($aspect != "all"){
            $query.=" AND `rt4_aspect` = '$aspect'";
        }
        if($persona != "all"){
            $query.=" AND `rt4_persona` = '$persona'";
        }
        $query.=" GROUP BY rt4_date";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
            $day[] = $row['days'];
            $month[] = $row['months'];
            $year[] = $row['years'];
            $reach[] = $row['reachs'];
            
        }
        $all = array();
        $all[] = $day;
        $all[] = $month;
        $all[] = $year;
        $all[] = $reach;
        echo json_encode($all);
    }
    
    else if($_POST['func'] == "getNewAreaData"){
        
        $proid = $_SESSION['CurrentProductID'];
        if(isset($_POST['timeline'])){
            $daysRange = $_POST['timeline'];
        }
        else{
            $daysRange = 7;   
        }
        if(isset($_POST['aspect'])){
            $aspect = $_POST['aspect'];
        }
        else{
            $aspect = "all";   
        }
        if(isset($_POST['persona'])){
            $persona = $_POST['persona'];
        }
        else{
            $persona = "all";   
        }
        $currentDate = '2016-10-08';
        $day = array();
        $month = array();
        $year = array();
        $conv = array();
        $senti = array();
                    
        $query = "SELECT day(`rt6_date`) da,month(`rt6_date`) mo,year(`rt6_date`) ye,conv, senti FROM
                    (SELECT SUM(`rt4_sent`) AS senti ,`rt4_date`
                    FROM `rep_tempdata4` 
                    WHERE `rt4_product` = '$proid'";
        if($aspect != "all"){
            $query.=" AND `rt4_aspect` = '$aspect'";
        }
        if($persona != "all"){
            $query.=" AND `rt4_persona` = '$persona'";
        }
        $query.=" AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                    AND `rt4_date` <= '".$currentDate."'
                    GROUP BY `rt4_date`) a
                    INNER JOIN
                    (SELECT `rt6_date` ,SUM(`rt6_conversion`) AS conv
                    FROM `rep_tempdata6` 
                    WHERE `rt6_product` = '$proid'
                    AND `rt6_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                    AND `rt6_date` <= '".$currentDate."'
                    GROUP BY `rt6_date`) b
                    on `rt6_date` = `rt4_date`";
        
        $stmt = $db->query($query);
        //echo $query;
        while($row = $stmt->fetch_assoc()){
            $day[] = $row['da'];
            $month[] = $row['mo'];
            $year[] = $row['ye'];
            $conv[] = $row['conv'];
            $senti[] = $row['senti'];
        }
        $all = array();
        $all[] = $senti;
        $all[] = $conv;
        $all[] = $day;
        $all[] = $month;
        $all[] = $year;
        echo json_encode($all);
    }
    
    else if($_POST['func'] == "getTopConversionFilter"){
        
        $proid = $_SESSION['CurrentProductID'];
        $daysRange = $_POST['timeline'];
        $aspect = $_POST['aspect'];
        $persona = $_POST['persona'];
        $currentDate = '2016-10-08';
        
        $query = "SELECT SUM(`rt4_reach`) AS reachs 
                FROM `rep_tempdata4` 
                WHERE `rt4_date` <= '".$currentDate."' 
                AND `rt4_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange." DAY)
                AND `rt4_product` = '$proid'";
            $stmt = $db->query($query);
            if($row = $stmt->fetch_assoc()){
                $thereach =  $row['reachs'];
            }
        
        $query = "SELECT SUM(`rt6_conversion`) AS cons 
                    FROM `rep_tempdata6` 
                    WHERE `rt6_date` >= DATE_ADD('".$currentDate."',INTERVAL - ".$daysRange." DAY)
                    AND `rt6_date` <= '".$currentDate."' 
                    AND `rt6_product` = $proid";
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $conv1 =  $row['cons'];
        }
        
        $query = "SELECT SUM(`rt6_conversion`) AS cons 
                    FROM `rep_tempdata6` 
                    WHERE `rt6_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                    AND `rt6_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                    AND `rt6_product` = $proid";
                    //echo $query; 
        $stmt = $db->query($query);
        if($row = $stmt->fetch_assoc()){
            $conv2 = $row['cons'];
            if($conv2 > $conv1){
                $conv_trend = "Down";
                $conv_perc = ($conv1 / $conv2)*100;
                $conv1 = $conv1/$thereach;
                $conv1 *= 100;
                $conv1 = number_format($conv1,0);
                $conv_perc = number_format($conv_perc,0);
            }
            else{
                $conv_trend = "Up";
                $conv_perc = ($conv1 / $conv2)*100;
                $conv1 = $conv1/$thereach;
                $conv1 *= 100;
                $conv1 = number_format($conv1,0);
                $conv_perc = number_format($conv_perc,0);
            }
        }
        
        $footer = '<div id="backdullconv" style="    display: none;    position: inherit; height: 100%; width: 100%; z-index: 99999;"></div>
                                              <div id="aroundloadingconv" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                            	<img id="loadingimgconv" src="assets/Loading1.gif" style="  width:100%;  display: none;  padding-top: 17px; z-index: 9999;">
                                              </div>
                                               <p style="margin-bottom: 0;">Conversion Rate</p>
                                            <h3 style="color:  #9958A5; margin: 0;">'.$conv1.'%</h3>
                                            <img style="margin-top: 9%;" height="10" width="13" src="assets/'; if($conv_trend == "Up"){$footer.="up";}else{$footer.="down";}$footer.='.png"/>
                                             <p>'.$conv_perc.'%</p> ';
        echo $footer;
        
    }
    
    else if($_POST['func'] == "getTableTopicData"){
        
        $proid = $_SESSION['CurrentProductID'];
        $daysRange = $_POST['timeline'];
        $aspect = $_POST['aspect'];
        $persona = $_POST['persona'];
        $currentDate = '2016-10-08';
        if(isset($_POST['aspect'])){
            $aspect = $_POST['aspect'];
        }
        else{
            $aspect = "all";   
        }
        
                                    $footer = '<div id="backdulltable" style="    display: none;   position: inherit; height: 100%; width: 100%;  z-index: 99999;"></div>
                                                  <div id="aroundloadingtable" style=" visibility: collapse; background-color: rgba(0, 0, 0, 0); width: 100px; height: 100px; position: absolute; top: 40%; left: 50%; margin-top: -50px; margin-left: -50px; border-radius: 25px; z-index: 999999; display: block;">
                                                	<img id="loadingimgtable" src="assets/Loading1.gif" style="   width:100%; display: none;  padding-top: 17px; z-index: 9999;">
                                                  </div>
                                                <table style=" margin-top: 10px; width: 100% !important;" id="firstTable" class="table table-bordered  table-condensed">
                                                   <tr style="  height: 44px !important;  background: #fafafa;">
                                                        <td style="vertical-align: middle;"><b>Topic</b></td>
                                                        <td style="vertical-align: middle;"><b>Aspect</b></td>
                                                        <td style="vertical-align: middle;"><b>Engagement</b></td>
                                                        <td style="vertical-align: middle;"><b>Sentiment</b></td>
                                                        
                                                   </tr>
                                                    ';
                                                    echo $footer;
                                                    
                                                   
                                                        
                                                  
                                                    $query = "SELECT `rt5_aspect`, `rt5_topic`, SUM(`rt5_reach`) AS reachs, SUM(`rt5_engg`) AS engg, SUM(`rt5_senti`) AS senti 
                                                                FROM `rep_tempdata5` 
                                                                WHERE `rt5_product` = '$proid'
                                                                AND `rt5_date` <= '$currentDate'
                                                                AND `rt5_date` >= DATE_ADD('$currentDate',INTERVAL - $daysRange DAY)";
                                                    if($aspect != "all"){
                                                        $query.=" AND rt5_aspect = '$aspect'";
                                                    }            
                                                    $query.=" GROUP BY `rt5_aspect`,`rt5_topic`
                                                                ORDER BY engg DESC limit 5";
                                                    $stmt = $db->query($query);
                                                 
                                                    while($row = $stmt->fetch_assoc()){
                                                      
                                                        
                                                        $ass = $row['rt5_aspect'];
                                                        $ass = str_replace(" ","-",$ass);
                                                        
                                                        $newq = "SELECT `rt5_aspect`, `rt5_topic`, SUM(`rt5_reach`) AS reachs, SUM(`rt5_engg`) AS engg, SUM(`rt5_senti`) AS senti 
                                                                FROM `rep_tempdata5` 
                                                                WHERE `rt5_product` = '$proid'
                                                                AND `rt5_date` <= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-1 DAY)
                                                                AND `rt5_date` >= DATE_ADD('".$currentDate."',INTERVAL -".$daysRange."-".$daysRange." DAY)
                                                                AND rt5_aspect = '".$row['rt5_aspect']."'
                                                                AND rt5_topic = '".$row['rt5_topic']."'";
                                                        $stmtnew = $db->query($newq);
                                                         if($rownew = $stmtnew->fetch_assoc()){
                                                            $secval = $rownew['senti'];
                                                            $firstval = $row['senti'];
                                                            if($secval > $firstval){
                                                                $trend = "down";
                                                                $trendval = ($firstval / $secval)*100;
                                                                if($trendval > 0){
                                                                    $trendval *= -1;
                                                                }
                                                                $trendval = number_format($trendval,0);
                                                            }
                                                            else{
                                                                $trend = "up";
                                                                $trendval = ($firstval / $secval)*100;
                                                                if($trendval < 0){
                                                                    $trendval *= -1;
                                                                }
                                                                $trendval = number_format($trendval,0);
                                                            }
                                                            
                                                            $secval = $rownew['engg'];
                                                            $firstval = $row['engg'];
                                                            if($secval > $firstval){
                                                                $etrend = "down";
                                                                $etrendval = ($firstval / $secval)*100;
                                                                if($etrendval > 0){
                                                                    $etrendval *= -1;
                                                                }
                                                                $etrendval = number_format($etrendval,0);
                                                            }
                                                            else{
                                                                $etrend = "up";
                                                                $etrendval = ($firstval / $secval)*100;
                                                                if($etrendval < 0){
                                                                    $etrendval *= -1;
                                                                }
                                                                $etrendval = number_format($etrendval,0);
                                                            }
                                                        }
                                                        else{
                                                            $trend = "";
                                                            $trendval = '-';
                                                        }
                                                        
                                                        $footer='<tr style="height: 44px !important;" class="'.$ass.' tabletr">
                                                                        <td style="vertical-align: middle;">'.$row['rt5_topic'].'</td>
                                                                        <td style="vertical-align: middle;">'.$row['rt5_aspect'].'</td>
                                                                        <td style="vertical-align: middle;"><p style="margin-bottom: 0;float: left; margin-top: 4px;">'.$row['engg'].'</p>
                                                                        <img style="    margin-top: 2px; float: right; margin-right: 5px;" height="10" width="13" src="assets/'.$etrend.'.png"/><p style="margin: 0; font-size: 10px;  float: right; margin-top: 13px; margin-right: -20px;">'.$etrendval.'%</p></td>
                                                                        <td style="vertical-align: middle;"><p style="margin-bottom: 0;float: left; margin-top: 4px;">'.$row['senti'].'</p>
                                                                        <img style="    margin-top: 2px; float: right; margin-right: 5px;" height="10" width="13" src="assets/'.$trend.'.png"/><p style="margin: 0; font-size: 10px;    float: right; margin-top: 13px; margin-right: -20px;">'.$trendval.'%</p></td>
                                                                        
                                                                </tr>';
                                                        echo $footer;
                                                       
                                                    }
                                                    $footer='
                                               </table>';
    echo $footer;
       
       
    }
}

$db->close();
		