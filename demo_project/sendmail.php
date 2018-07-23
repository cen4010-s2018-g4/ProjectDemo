<?php
	require("PHPMailer/src/PHPMailer.php");
	require("PHPMailer/src/Exception.php");
	require("PHPMailer/src/SMTP.php");

	function sendmail($to,$subject,$message,$name) {
		$mail = new PHPMailer();
	    $body = $message;
	    $mail->IsSMTP();
	    $mail->Host  = "smtp.gmail.com";                  
	    $mail->SMTPAuth = true;
	    $mail->Host = "smtp.gmail.com";
	    $mail->Port = 587;
	    $mail->Username = "youraccount@gmail.com";
	    $mail->Password = "your gmail password";
	    $mail->SMTPSecure = 'tls';
	    $mail->SetFrom('youraccount@gmail.com', 'Your name');
	    $mail->Subject = $subject;
	    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
	    $mail->MsgHTML($body);
	    $address = $to;
	    $mail->AddAddress($address, $name);
	    if(!$mail->Send()) {
	    		return 0;
	    } else {
	        return 1;
	    }
	 }
?>