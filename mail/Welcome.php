<?php
		
require_once('phpmailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->SMTPSecure = 'tls';
		$mail->Username = "customercare@washist.com";
		$mail->Password = "garnett77";
		$mail->AddAddress("venomoux.dev@gmail.com");
		$body = file_get_contents("WELCOME/Welcome.html");
		$mail->FromName = "Washist";
		$mail->Subject = "Subject";
		$mail->Body = "Message";
		$mail->Host = "washist.com";
		$mail->Port = 587;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->MsgHTML($body);
		$mail->IsHTML(true);
		$mail->CharSet="utf-8";
		
		$mail->From = $mail->Username;
if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
}
?>