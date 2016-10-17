<?php
session_start(); 
if(!(isset($_SESSION['loggedInSR']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
if(!(isset($_SESSION['CurrentProductID']))){
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}
include 'database/db.php';
$userid = $_SESSION['idSR'];
$proid = $_SESSION['CurrentProductID'];
$query = "SELECT `p_id`, `u_id`, `p_name`, `p_url` FROM `product` WHERE `u_id` = $userid AND `p_id` = $proid";
$stmt = $db->query($query);
if($row = $stmt->fetch_assoc()){
	$pname = $row['p_name'];
	$pid = $row['p_id'];
    
}
else{
	$server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$server = substr($server,0,strrpos($server,"/"));
	header('Location: http://'.$server.'/index.php');
}

$html='<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">


<title>Sweet Referrals | Reports</title>

<style>



#myownsidebar {
    position: fixed;
    top: 49px;
    left: 0px;
    bottom: 0px;
    width: 200px;
    background-color: #fafafa;
}
#myownparent {
    margin-left: 200px;
    margin-bottom:100px;
}

.sidebarli{
    padding-left: 10%;
     cursor: pointer;
     padding-top:7px;
     padding-bottom:7px;
     margin:0;
}

.sidebarli:hover{
    background: #ddd;    
}


 
#circle circle {
fill: none;
pointer-events: all;
}
 
.group path {
fill-opacity: .5;
}
 
path.chord {
stroke: #000;
stroke-width: .25px;
}
 
#circle:hover path.fade {
display: none;
}
 
</style>
<script src="http://d3js.org/d3.v2.min.js?2.8.1"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

 <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.blockui.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<script type="text/javascript" src="js/jquery.cokie.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/metronic.js"></script>
<script type="text/javascript" src="js/layout.js"></script>
<script type="text/javascript" src="js/ui-extended-modals.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/toastr.min.js"></script>
<script type="text/javascript" src="js/components-pickers.js"></script>
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/pace.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/helpers.js"></script>
<script type="text/javascript" src="js/steps.js"></script>
<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript" src="js/pager.js"></script>
<script type="text/javascript" src="js/rep_facebook.js"></script>


<link rel="stylesheet" type="text/css" href="css/filtergrid.css">
<link href="css/jquery-multi-step-form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/uniform.default.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal-bs3patch.css">
<link rel="stylesheet" type="text/css" href="css/select2.css">
<link rel="stylesheet" type="text/css" href="css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="css/components.css">
<link rel="stylesheet" type="text/css" href="css/plugins.css">
<link rel="stylesheet" type="text/css" href="css/layout.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/tooltipster.css">
<link rel="stylesheet" type="text/css" href="css/pace-theme-flash.css">
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" type="text/css" href="css/tasks.css">
<link rel="stylesheet" type="text/css" href="css/components-rounded.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-fileinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.css">
<link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.Metronic.css">
<link rel="stylesheet" type="text/css" href="css/introLoader.min.css">
<link rel="stylesheet" type="text/css" href="css/timeline.css">
<link rel="stylesheet" type="text/css" href="css/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/flaticon(1).css">
<link rel="stylesheet" type="text/css" href="css/flaticon(2).css">
<link rel="stylesheet" type="text/css" href="css/fontcustom.css">
<link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link rel="stylesheet" type="text/css" href="css/hover-min.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-tour.min.css">

<link rel="stylesheet" type="text/css" href="css/alignment.css">
<link rel="stylesheet" type="text/css" href="css/headings-texts.css">
<link rel="stylesheet" type="text/css" href="css/select-boxes.css">
      
	   <link rel="stylesheet" type="text/css" href="css/MyTabs.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        
         <link href=\'http://fonts.googleapis.com/css?family=Roboto\' rel=\'stylesheet\' type=\'text/css\'>
         
              
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
         

  <!-- use the font -->
  <style>
    body {
      font-family: \'Roboto\', sans-serif;
    }
  </style>
       
    </head>';
	
	echo $html;
	
	$html='<body style="color: rgba(0, 0, 0, 0.65);" class=" page-header-menu-fixed  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

';
echo $html;

include 'inc/header.php';

include 'inc/sidebar.php';

echo '<div class="page-container">';

include 'inc/top_menu.php';

echo '<div class="page-content"><div class="container-fluid"><div class="row"><div class="profile-content col-md-12 col-sm-12">';


$query = "SELECT `p_islive`,`p_fb` FROM `product` WHERE `p_id` = $pid";
$stmt = $db->query($query);
if($row = $stmt->fetch_assoc()){
    if($row['p_islive'] == 1 || $row['p_islive'] == "1"){
        if($row['p_fb'] != ''){
            $userid = $_SESSION['idSR'];
            $proid = $_SESSION['CurrentProductID'];
            $query = "SELECT TIME_TO_SEC(TIMEDIFF(NOW(),`p_fb_addedtime` ))/60 AS diffmin,`p_fb` FROM `product` WHERE `p_id` = $proid";
            $stmt = $db->query($query);
            if($row = $stmt->fetch_assoc()){
                $timediff = $row['diffmin'];
                $fbpage = $row['p_fb'];
            }
            else{
                $timediff = 0;
            }
            if(compaignContent <= 15){
                compaignContent($pname);     
            }
            else{
                facebook_graphs();
            }
              
        }
        else{
            showAddFbPage($pname);
        }
    }
    else{
        echo "<p style=\"margin-left:auto; margin-right:auto; text-align: center;   font-size: large;\">Reports are not available for draft products. Kindly make your product live to see reports and stats.</p>";
    }
    
}
else{
    echo "<p style=\"margin-left:auto; margin-right:auto; text-align: center;   font-size: large;\">Reports are not available for draft products. Kindly make your product live to see reports and stats.</p>";
}


echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function compaignContent($pname){
    include 'database/db.php';
    
    $userid = $_SESSION['idSR'];
    $proid = $_SESSION['CurrentProductID'];
    $query = "SELECT TIME_TO_SEC(TIMEDIFF(NOW(),`p_fb_addedtime` ))/60 AS diffmin,`p_fb` FROM `product` WHERE `p_id` = $proid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $timediff = $row['diffmin'];
        $fbpage = $row['p_fb'];
    }
    else{
        $timediff = 0;
    }
    
    
    
	if($timediff > 15){
    	$footer = '<div class="portlet-body">        
                <div id="myownparent">';
                   
                   echo $footer;
                   include 'inc/rep_sidebar.php';
                            
    						$footer='<div id="myowncontent"> 
                            ';
                            echo $footer;
                            facebook_graphs();
                           $footer='
                         </div>
                        </div>
                    </div>
                    
                    ';
        echo $footer;
	}
    else{
        $footer = '<div class="portlet-body">     
                <div id="myownparent">';
                   
                   echo $footer;
                   include 'inc/rep_sidebar.php';
                            
    						$footer='<div id="myowncontent" style="    width: 50%;
                                                                    margin-left: auto;
                                                                    margin-right: auto;
                                                                    text-align: center;"> 
                                <h2 style="margin-bottom: 30px;">Please wait while we fetch page data for you.</h2>
                           
                         </div>
                        </div>
                    </div>
                    
                    ';
        echo $footer;
        $db->close();
    }
}


function showAddFbPage($pname){
    include 'database/db.php';
    
    $userid = $_SESSION['idSR'];
    $proid = $_SESSION['CurrentProductID'];
    
	$footer = '<div class="portlet-body">
                    
                        
            <div id="myownparent">';
               
               echo $footer;
               include 'inc/rep_sidebar.php';
               
             
                    	require_once __DIR__ . '/facebook/src/Facebook/autoload.php';
                    	
                    	$fb = new Facebook\Facebook([
                    	  'app_id' => '595484803941924',
                    	  'app_secret' => 'b851556b024cff3986f20fb80678e19c',
                    	  'default_graph_version' => 'v2.5',
                    	]);
                    	
                    	$helper = $fb->getRedirectLoginHelper();
                    	$permissions = ['email', 'user_likes', 'publish_pages', 'manage_pages']; // optional
                    	$loginUrl = $helper->getLoginUrl('http://portal.sweetreferrals.com/rep_fbcb.php', $permissions);
                    
                    
                        
						$footer.='<div id="myowncontent" style="    width: 50%;
                                                                    margin-left: auto;
                                                                    margin-right: auto;
                                                                    text-align: center;"> 
                       
                      
                                    <h1 style="margin-bottom: 30px;">Link Facebook Page</h1>
                                    
                                  
                                    
                                     <button class="btn green-jungle rounded-4 submit1" id="submit1" onclick="location.href=\''.$loginUrl.'\'" style="margin-top: 20px;"><i class="fa fa-check"></i>Login With Facebook</button>
                        
                        
                        
                        
                        
                     </div>

                    </div>
                </div>
                
                
                
                
                
             
                
                
                
                
                ';
                $db->close();

echo $footer;
}

function facebook_graphs(){
    include 'database/db.php';
    include 'database/dbfb.php';
    $proid = $_SESSION['CurrentProductID'];
    $query = "SELECT `p_fb` FROM `product` WHERE `p_id` = $proid";
    $stmt = $db->query($query);
    if($row = $stmt->fetch_assoc()){
        $fbpage = $row['p_fb'];
    }
    else{
        echo "Unable to find linked facebook page.";
        exit();
    }
    $query = "SELECT `p_id`, `p_fbid`,`p_profile`, `p_about`, `p_description`, `p_name`, `p_link` FROM `page` WHERE `p_link` = '$fbpage'";
    //echo "</br>Query is :".$query." </br>";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $fbname = $row['p_name'];
        $fbdbid = $row['p_id'];
        $fbid = $row['p_fbid'];
        $fbpic = $row['p_profile'];
        $_SESSION['fbdbid'] = $fbdbid;
        $_SESSION['fbid'] = $fbid;
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    
    if(isset($_GET['inidate']) && isset($_GET['findate'])){
        $idate = $_GET['inidate'];
        $edate = $_GET['findate'];
        $pidate = $idate;
        $pedate = $edate;
        $_SESSION['ifbdate'] = $idate;
        $_SESSION['efbdate'] = $edate;
        $val = $idate." - ".$edate;
    }
    else{
        $date = date('d, Y', time());
        $monthNum = date('m', time());
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $date = $monthName." ".$date;
        //echo "date is ".$date;
        $val = $date;
        
        $date = date('d, Y', strtotime("-30 days"));
        $monthNum = date('m', strtotime("-30 days"));
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $date = $monthName." ".$date;
        //echo "prev date is ".$date;
        $val = $date." - ".$val;
        
        $idate = date('Y-m-d', strtotime("-30 days"));
        $edate = date('Y-m-d', time());
        $_SESSION['ifbdate'] = $idate;
        $_SESSION['efbdate'] = $edate;
        $pidate = $idate;
        $pedate = $edate;
    }
     
     
     
     $query = "SELECT `i_date` FROM `insights` WHERE `p_id` = $fbdbid ORDER BY ABS( DATEDIFF( `i_date`, '$edate' ) ) LIMIT 1";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $edate = $row['i_date'];
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    
    $query = "SELECT `i_date` FROM `insights` WHERE `p_id` = $fbdbid ORDER BY ABS( DATEDIFF( `i_date`, '$idate' ) ) LIMIT 1";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $idate = $row['i_date'];
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    
    
    $query = "SELECT  SUM(`i_likes`) AS ss FROM `insights` WHERE `i_date` = '$edate' AND `p_id` = $fbdbid ";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $totallikes = $row['ss'];
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    $query = "SELECT COUNT(`post_id`) AS posts FROM `post` WHERE `post_createdon` >= '$pidate' AND `post_createdon` <= '$pedate' AND `p_id` = $fbdbid";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $totalposts = $row['posts'];
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    
    
    $_SESSION['Realifbdate'] = $idate;
    $_SESSION['Realefbdate'] = $edate;
    
    $query = "SELECT  SUM(`i_likes`) AS likes FROM `insights` WHERE `i_date` = '$edate' AND `p_id` = $fbdbid";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $newlikes = $row['likes'];
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    
    $query = "SELECT  SUM(`i_likes`) AS likes FROM `insights` WHERE `i_date` = '$idate' AND `p_id` = $fbdbid";
    $stmt = $dbfb->query($query);
    if($row = $stmt->fetch_assoc()){
        $prevlikes = $row['likes'];
    }
    else{
        echo "Unable to fetch page data.";
        exit();
    }
    $changeinlikes = $newlikes - $prevlikes;
    if($changeinlikes > 0){
        $changeinlikes = "+ ".$changeinlikes;
    }
    else if($changeinlikes < 0){
        $changeinlikes*=-1;
        $changeinlikes = "- ".$changeinlikes;
    }
    $relativelikes = $newlikes - $prevlikes;
    $relativelikes = $relativelikes / $prevlikes;
    $relativelikes = $relativelikes * 100;
    if($relativelikes > 0){
        $relativelikes = "+ ".number_format($relativelikes,2);
    }
    else if($relativelikes < 0){
        $relativelikes*=-1;
        $relativelikes = "- ".number_format($relativelikes,2);
    }
    $query = "SELECT SUM(`post_shares`) AS shares, SUM(`post_likes`) As likes, SUM(`post_comments`) AS comments, SUM(`post_haha`) AS hahas, SUM(`post_love`) AS loves, SUM(`post_wow`) AS wows FROM `post` WHERE `post_createdon` >= '$pidate' AND `post_createdon` <= '$pedate' AND `p_id` = $fbdbid";
    $stmt = $dbfb->query($query);
    while($row = $stmt->fetch_assoc()){
        $totalinteractions = $row['comments']+$row['likes']+$row['shares']+$row['hahas']+$row['loves']+$row['wows'];
    }
    $intPerThouFoll = $totalinteractions / $newlikes;
    $intPerThouFoll *=1000;
    
  
    $footer = '<div class="portlet-body" style="text-align:center;">
                    
                        

       
      
                    <h1 style="margin-bottom: 30px;">'.$fbname.'</h1>
                    
                       <div style="    display: flex; width: 50%; margin-left: 37%;  margin-right: auto;">
                        <select id="dateSelector" style="width:40%" class="form-control select-lg" >
                                        <option value="'.$val.'">'.$val.'</option>
                                        <option value="custom">Custom</option></select>
                                    
                            <button type="button" class="btn blue" onclick="exportModal()">Export</button>
                        </div>
                        </br>
                         <div id="CustomDateDiv" style="    display: none; width: 80%; margin-left: auto;  margin-right: auto;">
                                    
                                    
                                    <input id="iniDate" style="width:40%" class="form-control select-lg" placeholder="Initial Date (yyyy-mm-dd)" />
                                    <input id="finDate" style="width:40%" class="form-control select-lg" placeholder="Final Date (yyyy-mm-dd)" />
                                                  
                                        <button type="button" class="btn blue" onclick="filter()">Filter</button>
                                    </div>
                        
                        
                        <hr>
                        
                        <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" class="table table-bordered table-hover table-condensed">
                        <tbody><tr><td style="font-weight: bold;">Profile Picture</td>
                        <td style="font-weight: bold;">Profile Name</td>
                        <td style="font-weight: bold;">Total Followers</td>
                        <td style="font-weight: bold;">Total Change in Followers</td>
                        <td style="font-weight: bold;">Relative Change in Followers</td>
                        <td style="font-weight: bold;">Number of Interaction per 1000 Followers</td>
                        </tr><tr>
                                            <td><img height="80" width="80" src="'.$fbpic.'" /></td>
                                            <td>'.$fbname.'</td>
                                            <td>'.$newlikes.'</td>
                                            <td>'.$changeinlikes.'</td>
                                            <td>'.$relativelikes.' %</td>
                                            <td>'.number_format($intPerThouFoll,2).'</td>
                                        </tr></tbody></table>
                        
                        <hr>
                        
                    <h1 style="margin-bottom: 10px;">Distribution of Fans</h1>
                    <div id="regions_div" style="width: 100%; height:500px; padding-top: 20px;padding-left: 2%;background-color: white;"></div>
                     <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="firstTable" class="table table-bordered table-hover table-condensed">
                        <tbody><tr><td style="font-weight: bold;">Country</td>
                        <td style="font-weight: bold;">Local Fans</td>
                        <td style="font-weight: bold;">Percentage of Fans Base</td>
                        <td style="font-weight: bold;">Growth</td>
                        <td style="font-weight: bold;">Relative Growth</td>
                        </tr>';
                        $query = "SELECT t1.`i_country` AS cc ,t1.`i_likes` AS newl,t2.`i_likes` AS prevl FROM
                                    (SELECT `p_id`, `i_country`, `i_likes`, `i_date` FROM `insights` WHERE `i_date` = '$edate' AND `p_id` = $fbdbid ORDER BY `i_likes` desc) t1
                                    left join
                                    (SELECT `p_id`, `i_country`, `i_likes`, `i_date` FROM `insights` WHERE `i_date` = '$idate' AND `p_id` = $fbdbid ORDER BY `i_likes` desc) t2
                                    on t1.`i_country` = t2.`i_country`
                                    ORDER BY t1.`i_likes` desc";
                        $stmt = $dbfb->query($query);
                        while($row = $stmt->fetch_assoc()){
                            $country = $row['cc'];
                            $newl = $row['newl'];
                            $prevl = $row['prevl'];
                            $perc =  $newl/$totallikes;
                            $perc *= 100;
                            $diff = $newl - $prevl;
                            if($prevl == 0){
                                $rela = 0;
                            }
                            else{
                                $rela = $diff / $prevl;   
                            }
                            $rela *= 100;
                            if($diff > 0){
                                $diff2 = "+ ".number_format($diff);
                            }
                            else if($diff < 0){
                                $diff2 = $diff*-1;
                                $diff2 = "- ".number_format($diff2);
                            }
                            else{
                                $diff2 = "0.00";
                            }
                            if($rela > 0){
                                $rela2 = "+ ".number_format($rela,2);
                            }
                            else if($rela < 0){
                                $rela2 = $rela*-1;
                                $rela2 = "- ".number_format($rela2,2);
                            }
                            else{
                                $rela2 = "0.00";
                            }
                            
                            $footer.='<tr>
                                            <td>'.$country.'</td>
                                            <td>'.number_format($newl).'</td>
                                            <td>'.number_format($perc,2).' %</td>
                                            <td>'.$diff2.'</td>
                                            <td>'.$rela2.' %</td>
                                        </tr>';
                        }
                        
                        $footer.='</tbody></table>
        
        
        
        
                             <hr style="    margin-top: 50px;">
                        
                    <h1 style="margin-bottom: 10px;">Distribution of Interactions</h1>
                     <div id="piechart" style="width: 100%; height:500px; padding-top: 20px;padding-left: 2%;background-color: white;"></div>
                      <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="secTable" class="table table-bordered table-hover table-condensed">
                        <tbody><tr><td style="font-weight: bold;"></td>
                        <td style="font-weight: bold;">Count</td>
                        <td style="font-weight: bold;">Share</td>
                        </tr>';
                        $query = "SELECT SUM(`post_shares`) AS shares, SUM(`post_likes`) As likes, SUM(`post_comments`) AS comments, SUM(`post_haha`) AS hahas, SUM(`post_love`) AS loves, SUM(`post_wow`) AS wows FROM `post` WHERE `post_createdon` >= '$pidate' AND `post_createdon` <= '$pedate' AND `p_id` = $fbdbid";
                        $stmt = $dbfb->query($query);
                        while($row = $stmt->fetch_assoc()){
                            $total = $row['comments']+$row['likes']+$row['shares']+$row['hahas']+$row['loves']+$row['wows'];
                            
                            $footer.='<tr>
                                            <td>Comments</td>
                                            <td>'.number_format($row['comments']).'</td>
                                            <td>'.number_format(($row['comments']/$total)*100,2).' %</td>
                                        </tr>';
                                        
                                         $footer.='<tr>
                                            <td>Likes</td>
                                            <td>'.number_format($row['likes']).'</td>
                                            <td>'.number_format(($row['likes']/$total)*100,2).' %</td>
                                        </tr>';
                                        
                                         $footer.='<tr>
                                            <td>Shares</td>
                                            <td>'.number_format($row['shares']).'</td>
                                            <td>'.number_format(($row['shares']/$total)*100,2).' %</td>
                                        </tr>';
                                        
                                         $footer.='<tr>
                                            <td>Haha</td>
                                            <td>'.number_format($row['hahas']).'</td>
                                            <td>'.number_format(($row['hahas']/$total)*100,2).' %</td>
                                        </tr>';
                                        
                                         $footer.='<tr>
                                            <td>Love</td>
                                            <td>'.number_format($row['loves']).'</td>
                                            <td>'.number_format(($row['loves']/$total)*100,2).' %</td>
                                        </tr>';
                                        
                                         $footer.='<tr>
                                            <td>Wow</td>
                                            <td>'.number_format($row['wows']).'</td>
                                            <td>'.number_format(($row['wows']/$total)*100,2).' %</td>
                                        </tr>';
                        }
                        
                        $footer.='</tbody></table>
        
        
                         <hr style="    margin-top: 50px;">
                        
                    <h1 style="margin-bottom: 10px;">Comment Sentiments</h1>
                    <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="thiTable" class="table table-bordered table-hover table-condensed">
                        <tbody><tr><td style="font-weight: bold;">Name</td>
                        <td style="font-weight: bold;">Comment</td>
                        <td style="font-weight: bold;">Sentiment</td>
                        <td style="font-weight: bold;">Date</td>
                        </tr>';
                        $query = "SELECT `c_text`, `c_commentedon`, `c_sentiment`,`user`.u_name FROM `comments`,`user`,`post` WHERE `comments`.post_id = `post`.`post_id` AND `comments`.u_id = `user`.u_id AND `c_commentedon` >= '$pidate' AND `c_commentedon` <= '$pedate' AND `p_id` = $fbdbid";
                        $stmt = $dbfb->query($query);
                        while($row = $stmt->fetch_assoc()){
                            
                            $footer.='<tr>
                                            <td>'.$row['u_name'].'</td>
                                            <td>'.$row['c_text'].'</td> 
                                            <td>'.$row['c_sentiment'].'</td>
                                            <td>'.$row['c_commentedon'].'</td>
                                        </tr>';
                                        
                                       
                        }
                        
                        $footer.='</tbody></table>

                    
                
                
                
                
                
                
                         <hr style="    margin-top: 50px;">
                        
                    <h1 style="margin-bottom: 10px;">Page Posts Over Time</h1>
                    <div id="columnchart_material_4" style="width: 100%; height:500px; padding-top: 20px;padding-left: 2%;background-color: white;"></div>
                    
                    <div id="piechart2" style="width: 100%; height:500px; padding-top: 20px;padding-left: 2%;background-color: white;"></div>
                      <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="secTable" class="table table-bordered table-hover table-condensed">
                        <tbody><tr><td style="font-weight: bold;">Type</td>
                        <td style="font-weight: bold;">Count</td>
                        <td style="font-weight: bold;">Share</td>
                        </tr>';
                        $query = "SELECT COUNT(`post_id`) AS posts, `post_type` FROM `post` WHERE `post_createdon` >= '$pidate' AND `post_createdon` <= '$pedate' AND `p_id` = $fbdbid GROUP BY `post_type`";
                        $stmt = $dbfb->query($query);
                        while($row = $stmt->fetch_assoc()){
                            
                            $footer.='<tr>
                                            <td>'.$row['post_type'].'</td>
                                            <td>'.number_format($row['posts']).'</td>
                                            <td>'.number_format(($row['posts']/$totalposts)*100,2).' %</td>
                                        </tr>';
                                        
                        }
                        
                        $footer.='</tbody></table>
                        
                        
                        
                           <hr style="    margin-top: 50px;">
                        
                    <h1 style="margin-bottom: 10px;">Engagement</h1>
                    <div id="eng_chart" style="width: 100%; height:500px; padding-top: 20px;padding-left: 2%;background-color: white;"></div>
                    
                        
                     <h1 style="margin-bottom: 10px;">Fans Growth</h1>
                    <div id="fan_chart" style="width: 100%; height:500px; padding-top: 20px;padding-left: 2%;background-color: white;"></div>
                   
                        
                        
                        
                        </div>
                        
                           <!-- Export Modal -->
								<div id="exportModal" class="modal fade" tabindex="-1" data-width="760">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">Export Report</h4>
									</div>
									<div class="modal-body">
										<div class="row" style="text-align: center;">
											<div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="location.href=\'export/export/rep_fb_statistics.php\'" style="margin-left: 9.5%;">Statistics as Excel</button>
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/rep_fb_fandist.php\'">Distribution of Fans as Excel</button>
											</div>
                                            <div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="exportPNG_distofint()">Distribution of Interactions as Image</button>
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/rep_fb_intdist.php\'">Distribution of Interactions as Excel</button>
											</div>
                                            <div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="exportPNG()">Comment Sentiments as Excel</button>
											</div>
                                            <div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="exportPNG_pageposts()">Page Posts Over Time as Image</button>
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/home.php\'">Page Posts Over Time as Excel</button>
											</div>
                                            <div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="exportPNG_distofpost()">Distribution of Posts as Image</button>
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/home.php\'">Distribution of Posts as Excel</button>
											</div>
                                            <div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="exportPNG_engg()">Engagement as Image</button>
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/home.php\'">Engagement as Excel</button>
											</div>
                                            <div class="col-md-12" style="margin-bottom: 5px; margin-top: 5px;">
												<button type="button" class="btn blue" onclick="exportPNG_fans()">Fans Growth as Image</button>
                                                <button type="button" class="btn blue" onclick="location.href=\'export/export/home.php\'">Fans Growth as Excel</button>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button id="close-popup" type="button" data-dismiss="modal" class="btn btn-default">Close</button>
									</div>
								</div>
                
                
                
                ';
    echo $footer;
      $db->close();
      $dbfb->close();
}


