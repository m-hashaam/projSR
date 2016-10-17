<?php

	$dbhost = "localhost"; 
		$dbname = "sweetref_portal"; 
		$dbuser = "sweetref_portal"; 
		$dbpass=  "Popo1122!!@@";
		
		$db = new mysqli($dbhost, $dbuser,$dbpass, $dbname) or die("Database error");
        
        $query = "SELECT `per_id`, `per_name`, `per_desc`, `per_image`, `per_image2` FROM `persona` WHERE 1";
        $stmt = $db->query($query);
        while($row = $stmt->fetch_assoc()){
            
            $imagee = $row['per_image'];
            $imagee = str_replace(' ','%20',$imagee);
            $im = imagecreatefrompng($imagee);
            imagealphablending($im, false);
            
            imagesavealpha($im, true);
            if($im && imagefilter($im, IMG_FILTER_NEGATE))
            {
                echo 'Image converted to grayscale.';
                $name = generateRandomString(40);
                imagepng($im, '../assets/blackicons/'.$name.'.png');
                $urll = 'http://portal.sweetreferrals.com/assets/blackicons/'.$name.'.png';
                
                $query2 = "UPDATE `persona` SET `per_image2` = '$urll' WHERE `per_id` = ".$row['per_id'];
                $db->query($query2);
                echo $urll;
            }
            else
            {
                echo 'Conversion to grayscale failed.';
            }
            
            imagedestroy($im);
            
            
        }
        
        
function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
        

?>