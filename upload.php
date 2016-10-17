<?php
session_start();
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
$max_file_size = 2000 * 1024; #200kb
$nw = $nh = 200; # image with & height

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ( isset($_FILES['file']) ) {
    if (! $_FILES['file']['error'] && $_FILES['file']['size'] < $max_file_size) {
      # get file extension
      $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      # file type validity
      if (in_array($ext, $valid_exts)) {
          $path = 'uploads/' . uniqid()  . '.' . $ext;
          $size = getimagesize($_FILES['file']['tmp_name']);
          # grab data form post request
          $x = (int) $_POST['x'];
          $y = (int) $_POST['y'];
          $w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
          $h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
         
          $nw = $w;
          $nh = $h;
          # read image binary data
          $data = file_get_contents($_FILES['file']['tmp_name']);
          # create v image form binary data
          $vImg = imagecreatefromstring($data);
          $dstImg = imagecreatetruecolor($nw, $nh);
          # copy image
          imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
          # save image
          imagejpeg($dstImg, $path);
          # clean memory
          imagedestroy($dstImg);
          
          //echo "pro id is ".$proid;
          //echo " path name is http://portal.sweetreferrals.com/".$path;
          $picpath = "http://portal.sweetreferrals.com/".$path;

          include "database/db.php";
          if(isset($_GET['proid'])){
            $proid = $_GET['proid'];
            $query = "UPDATE `product` SET `p_picture` = '$picpath' WHERE `p_id` = $proid";
            $stmt = $db->query($query);
          }
          else if(isset($_GET['company'])){
            	$userid = $_SESSION['idSR'];
        
               $query = "SELECT `ci_id` FROM `company_information` WHERE `u_id` = $userid";
                $stmt = $db->query($query);
                if($row = $stmt->fetch_assoc()){
                    $comid = $row['ci_id'];
                    
                    $query = "UPDATE `company_information` SET `ci_logo`='$picpath' WHERE `ci_id`=$comid";
                    $stmt = $db->query($query);
                }
                else{
                    $query = "INSERT INTO `company_information`( `u_id`, `ci_logo`) 
                                                        VALUES ($userid,  '$picpath')";
                    $stmt = $db->query($query);
                }	
          }
          
      
          
        } else {
          //echo 'unknown problem!';
        } 
    } else {
      //echo 'file is too small or large';
    }
  } else {
    //echo 'file not set';
  }
} else {
  //echo 'bad request!';
}

echo "<script>location.href='index.php'</script>";
?>