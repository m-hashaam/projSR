<?php


include 'database/db.php';
$userid = $_SESSION['idSR'];
$cproname = $_SESSION['CurrentProductName'];
$cproid = $_SESSION['CurrentProductID'];
$optioins = "<option value=\"$cproid\">$cproname</option>";
$query = "SELECT `p_id`, `u_id`,`p_islive` ,`p_name`, `p_url`,`p_picture` FROM `product` WHERE `u_id` = $userid";
$stmt = $db->query($query);
while($row = $stmt->fetch_assoc()){
    $liveclass = "notlive";
    if($row['p_islive'] == 1 || $row['p_islive'] == "1"){
        $liveclass = "yeslive";
    }
	if($row['p_id'] != $cproid){
	   $optioins .= "<option data-class=\"avatar\" data-second-class=\"".$liveclass."\" data-style=\"background-image: url(&apos;".$row['p_picture']."?d=monsterid&amp;r=g&amp;s=16&apos;);\" value=\"".$row['p_id']."\">".$row['p_name']."<img src=\"https://cdn3.iconfinder.com/data/icons/flatastic-10-2/256/trafficlight_red-128.png\" height=\"20\" width\"20\" ></img></option>";
	}
}


$myuserid = -1;
$colName = "";
if(isset($_SESSION['sub_idSR'])){
    $myuserid = $_SESSION['sub_idSR'];
    $colName = '`su_id`';   
}
else{
    $myuserid = $_SESSION['idSR'];
    $colName = '`u_id`';
}
$query = "SELECT count(`n_id`) AS counts
            FROM `notifications` WHERE $colName = $myuserid AND `n_isread` = 0";
$stmt = $db->query($query);

$notCountRead = 0;
if($row = $stmt->fetch_assoc()){
    $notCountRead = $row['counts'];
}


$query = "SELECT `n_id`, `u_id`, `su_id`, `n_text`, `n_link`, `n_icon`, `n_createdon`,`n_isread`,
            TIME_TO_SEC(TIMEDIFF(NOW(), `n_createdon`)) seconds
            FROM `notifications` WHERE $colName = $myuserid ORDER BY `n_createdon` desc limit 4";
$stmt = $db->query($query);
$notHTML = "";
$notCount = 0;
while($row = $stmt->fetch_assoc()){
    $notCount++;
    $sec = $row['seconds'];
    $secText ="";
    if($sec < 60){
        $sec = number_format($sec);
        $secText = "$sec Second(s) Ago";
    }
    else{
        $sec /= 60;
        if($sec < 60){
            $sec = number_format($sec);
            $secText = "$sec Minute(s) Ago";
        }
        else{
            $sec/=60;
            if($sec < 24){
                $sec = number_format($sec);
                $secText = "$sec Hour(s) Ago";
            }
            else{
                $sec/=24;
                $sec = number_format($sec);
                $secText = "$sec Day(s) Ago";
            }
        }
    }
    
    $backcolor = "#f0f0f0";
    if($row['n_isread'] == 1 OR $row['n_isread'] == "1"){
        $backcolor = "#ffffff";
    }
    
    $notHTML .= '<li style="display: flex; background:'.$backcolor.' "><div style="width:25%;     text-align: center;"><img style="    margin-top: 30%;" height="20" width="20" src="'.$row['n_icon'].'" ></img></div>
                        <div style="width:75%;">
                            <a onclick="openNotification('.$row['n_id'].')" href="#">
                                 '.$row['n_text'].'</a><div><small style="color: grey;
    font-size: 11px;">'.$secText.'</small></div>
                            </div>
                        </li>
                       
                        <li class="divider">
                        </li>';
}
if($notCount >= 4){
     $notHTML .= '<li>
                            <a style="text-align: center;" href="notifications.php">
                                 View More
                            </a>
                        </li>';
    
}
if($notCount == 0){
     $notHTML .= '<li>
                            <a style="text-align: center;">
                                 No Notification
                            </a>
                        </li>';
}


$db->close();
$type = $_SESSION['user_type'];
 
$footer = '
<div class="page-header" id="page-header-top">
    <div class="page-header-top tour-compatible">
        <a href="javascript:" class="menu-toggler"></a>
        <div class="page-header-menu">  
            <div class="container-fluid">
                <div class="hor-menu">
                    <ul style="position:relative;" class="nav navbar-nav navbar-fixed-top">
                        <li id="logo2">
                            <select id="topSelectProduct" name="topSelectProduct" class="form-control select-lg" >
                                            '.$optioins.'
                                        </select>
                        </li>
                        
                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                </div>
                <div class="hor-menu" style="margin-left: 36%;">
                    <ul style="position:relative;" class="nav navbar-nav navbar-fixed-top">
                        <li id="logo" style="position: relative; margin-left: 47%;">
                            <img id="header-logo" style="cursor:pointer;" class="aligncenter size-full wp-image-260" onclick="location.href=\'index.php\'" alt="Sweet Referrals Logo" src="assets/logo_white.png">
                        </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>
                </div>
            </div>
        </div>
        
        

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                
                
                
                
                <li class="dropdown dropdown-user" style="z-index:9999;     margin-right: 5px;">
                    <a style="    background: white;
                                    border-radius: 10px !important;
                                    height: 34px;
                                    float: left;
                                    font-size: 14px;
                                    font-weight: normal;
                                    margin-top: 9px;
                                    padding-top: 7px;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username bold" style="    float: left; margin-top: 1px;">Notifications ('.$notCountRead.')</span> <i style="    margin-top: 4px;" class="fa fa-caret-down fa-2x"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        '.$notHTML.'
                    </ul>
                </li>
                
                
                
                
                
                
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user" style="z-index:9999;">
                    <a style="    background: white;
                                    border-radius: 10px !important;
                                    height: 34px;
                                    float: left;
                                    font-size: 14px;
                                    font-weight: normal;
                                    margin-top: 9px;
                                    padding-top: 7px;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username bold" style="    float: left; margin-top: 1px;">'.$_SESSION['fnameSR'].'</span> <i style="    margin-top: 4px;" class="fa fa-caret-down fa-2x"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="account.php">
                                <i class="icon-user"></i> Account
                            </a>
                        </li>
                        ';
                        if($type == "Admin"){
                            $footer.='<li>
                                        <a href="company.php">
                                            <i class="icon-globe"></i> Company
                                        </a>
                                    </li>
                                    <li>
                                        <a href="users.php">
                                            <i class="icon-user"></i> Users
                                        </a>
                                    </li>';
                        }
                         $footer.='
                        <li class="divider">
                          </li>
                                                <li>
                            <a href="products.php">
                                <i class="fa fa-area-chart"></i> Products
                            </a>
                        </li>
                        </li>
                                                <li>
                            <a href="rep_overview.php">
                                <i class="fa fa-area-chart"></i> Reports Center
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                                                <li>
                            <a href="/support/ticket/login.php">
                                <i class="icon-support"></i> Support
                            </a>
                        </li>
                        <li>
                            <a href="faq.php">
                                <i class="icon-support"></i> Help &amp; FAQ
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a name="logout" class="logout" href="authentication/logout.php">
                                <i class="icon-key"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>

$(\'#topSelectProduct\').on(\'change\', function() {
  //alert( this.value ); // or $(this).val()
  //alert( "somethign" );
  //location.href="changeproduct.php?id="+this.value+"&page=rep_something1.php";
});
</script>

';

echo $footer;