<?php

session_start();
include "db.php";

if((isset($_SESSION['loggedInSR']))){
    
    if ($_POST['func'] == "add"){
		
        $proid = $_SESSION['CurrentProductID'];
    	$userid = $_SESSION['idSR'];
        $purl = $_POST['purl'];
        
       
        
       $query = "UPDATE `product` SET `p_fb`= '$purl',`p_fb_addedtime`=NOW() WHERE `p_id` = $proid";
        $stmt = $db->query($query);
       
       $fbpage = $purl;
       $pagename = substr($fbpage,strpos($fbpage,"facebook.com/")+13,strlen($fbpage));
        $pagename = substr($pagename,0,strpos($pagename,"/"));
        
        //echo getcwd();
        //$cmd = '/usr/bin/php /home/sweetreferralsce/public_html/sweetreferrals.com/alihaider9/rep_f_start.php?pageid='.$pagename.' &';
        //$cmd = '/usr/bin/php http://sweetreferrals.com/sweetreferrals.com/alihaider9/rep_f_start.php?pageid='.$pagename.' &';
        //$pid = shell_exec($cmd);
        //echo $cmd." and pid is ".$pid;
        $para = array();
        $para['pageid'] = $pagename;
        post_without_wait("http://sweetreferrals.com/sweetreferrals.com/alihaider9/rep_f_start.php",$para);
        echo "finished";
       
	}
}

function post_without_wait($url, $params)
{
    foreach ($params as $key => &$val) {
      if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);
    }
    $post_string = implode('&', $post_params);

    $parts=parse_url($url);

    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:80,
        $errno, $errstr, 30);

    $out = "POST ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
}
		