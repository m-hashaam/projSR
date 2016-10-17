<?php

class SendMail {
	function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	function send($to, $user, $orderid, $type, $subject){
		require_once('phpmailer/class.phpmailer.php');
		if(file_exists('../database/db.php'))
		{
			include '../database/db.php';
		}
		else if(file_exists('database/db.php'))
		{
			include 'database/db.php' ;
		}
		
		$body="";
		
		$mail = new PHPMailer();
		$mail->SMTPSecure = 'tls';
		$mail->Username = "customercare@washist.com";
		$mail->Password = "garnett77";
		$mail->AddAddress($to);
		$mail->FromName = "Washist";
		$mail->Host = "washist.com";
		$mail->Port = 587;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail->CharSet="utf-8";
		$mail->From = $mail->Username;
		
		if($type == "welcome"){
			$body = file_get_contents("../mail/welcome/Welcome.html");
			$body = str_replace('%user%', $user, $body); 
			$mail->Subject = "Welcome to Washist";
		}
		else if($type == "Ready"){
			$body = file_get_contents("../mail/ready-for-delivery/Order-ready-for-delivery.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Status Changed";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid is ready for delivery.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "washing"){
			$body = file_get_contents("order-washing-status/Order-washing.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Status Changed";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid is being washed.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "Washing"){
			$body = file_get_contents("../mail/order-washing-status/Order-washing.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Status Changed";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid is being washed.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "pickup"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			$body = file_get_contents("order-pickup/Order-picked-up.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Status Changed";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been picked up.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "Picked Up"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			$body = file_get_contents("../mail/order-pickup/Order-picked-up.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Status Changed";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been picked up.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "PaymentDashboard"){
			$body = file_get_contents("../mail/order-payment/orderpayment.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Payment Status Changed";
		}
		else if($type == "confirmation"){
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			if(file_exists("../mail/order-confirmation/Order-received.html"))
			{
				$body = file_get_contents("../mail/order-confirmation/Order-received.html");
			}
			else if(file_exists("mail/order-confirmation/Order-received.html"))
			{
				$body = file_get_contents("mail/order-confirmation/Order-received.html");
			}
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Confirmation";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been successfully placed.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "Order Placed"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			$body = file_get_contents("../mail/order-confirmation/Order-received.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Confirmation";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been successfully placed.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "cancelled"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			$body = file_get_contents("../mail/order-cancelled/Order-cancelled.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Cancelled";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been canceled.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "Canceled"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			$body = file_get_contents("../mail/order-cancelled/Order-cancelled.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Cancelled";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been canceled.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "Delivered"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,"nothing","nothing");
			
			$body = file_get_contents("../mail/delivered/Order-delivered.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);			
			$mail->Subject = "washist | Order Delivered";
			
			$query = "select `mobileNumber` from `profile` where userID = (select `order`.`userid` from `order` where orderid = $orderid)";
			$result = $db->query($query);
			if($row = $result->fetch_assoc())
			{
				$mobile = $row['mobileNumber'];
				if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
					$mobile = substr($mobile, 1);
					$mobile = "234".$mobile;
				}
				$sms = "Dear $user %0AYour Order Number W$orderid has been delivered.";
				$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
				$sms = str_replace(' ', '%20', $sms); 
				file_get_contents($sms);
			}
		}
		else if($type == "changepass"){
			$body = file_get_contents("../mail/pass-change/passchange.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%password%', $orderid, $body);			
			$mail->Subject = "washist | Password Changed";
			
			
			$mobile = $subject;
			if($this->startsWith($mobile,"09") || $this->startsWith($mobile,"08") || $this->startsWith($mobile,"07")){
				$mobile = substr($mobile, 1);
				$mobile = "234".$mobile;
			}
			$sms = "Dear $user %0AYour password for washist has been changed. New password is sent to you email account.";
			$sms = "http://api2.infobip.com/api/sendsms/plain?user=isave&password=isave1&sender=Washist&SMSText=$sms&GSM=$mobile";
			$sms = str_replace(' ', '%20', $sms); 
			file_get_contents($sms);
			
		}
		else if($type == "simple"){
			$body = file_get_contents("mail/simple/simple.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%message%', $orderid, $body);			
			$mail->Subject = $subject;
		}
		$mail->MsgHTML($body);
		//$mail->Send();
			 if(!$mail->Send()) {
		   $queryyy = "INSERT INTO `logs`( `log_text`, `log_type`, `userid`, `adminid`) VALUES ('washistMail.php:web failed "."Mailer Error: " . $mail->ErrorInfo."','developer',0,0)";
            $resulttt = $db->query($queryyy);
		 }
	}

	function sendPaymentMail($to, $user, $orderid, $type, $pstatus, $bill){
		
		if(file_exists('../database/db.php'))
		{
			include '../database/db.php';
		}
		else if(file_exists('database/db.php'))
		{
			include 'database/db.php' ;
		}
		
		require_once('phpmailer/class.phpmailer.php');
		$body="";
		
		$mail = new PHPMailer();
		$mail->SMTPSecure = 'tls';
		$mail->Username = "customercare@washist.com";
		$mail->Password = "garnett77";
		$mail->AddAddress($to);
		$mail->FromName = "Washist";
		$mail->Host = "washist.com";
		$mail->Port = 587;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail->CharSet="utf-8";
		$mail->From = $mail->Username;
		
		if($type == "PaymentDashboard"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,$pstatus,$bill);
			
			$body = file_get_contents("../mail/order-payment/orderpayment.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);
			$body = str_replace('%pstatus%', $pstatus, $body);
			$body = str_replace('%bill%', $bill, $body);			
			$mail->Subject = "washist | Payment Status Changed";
		}
		else if($type == "PaymentNotification"){
			
			include 'washistMail.php';
			$Wmail = new WashistMail();
			$Wmail -> send ($orderid,$type,$user,$pstatus,$bill);
			
			
			$body = file_get_contents("../mail/payment-reminder/orderpayment.html");
			$body = str_replace('%user%', $user, $body);
			$body = str_replace('%order%', $orderid, $body);
			$body = str_replace('%bill%', $bill, $body);			
			$mail->Subject = "washist | Pending Payment";
		}
		$mail->MsgHTML($body);
		//$mail->Send();
		 if(!$mail->Send()) {
		   $queryyy = "INSERT INTO `logs`( `log_text`, `log_type`, `userid`, `adminid`) VALUES ('washistMail.php:web failed "."Mailer Error: " . $mail->ErrorInfo."','developer',0,0)";
            $resulttt = $db->query($queryyy);
		 }
	}	
	
}