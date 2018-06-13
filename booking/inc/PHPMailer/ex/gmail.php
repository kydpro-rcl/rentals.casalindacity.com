<?php
function sendGmail($emailTo, $nameTo, $subject, $emailFrom, $nameFrom, $bodyHtml, $emailCC='', $emailBCC='', $user='webmaster@casalindacity.com', $password='Linda@2015'){
	date_default_timezone_set('Etc/UTC');
	require $_SERVER['DOCUMENT_ROOT'].'Norway06-04-2015/booking/inc/PHPMailer/PHPMailerAutoload.php';
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	$mail->Username = $user;
	$mail->Password = $password;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;

	//Set who the message is to be sent from
	$mail->setFrom($emailFrom, $nameFrom);
	//Set an alternative reply-to address
	$mail->addReplyTo($emailFrom, $nameFrom);
	//Set who the message is to be sent to
	$mail->addAddress($emailTo, $nameTo);
	if($emailCC!=''){
		$mail->addCC($emailCC);
	}
	if($emailBCC!=''){
		$mail->addBCC($emailBCC);
	}
	$mail->Subject = $subject;
	$mail->msgHTML($bodyHtml);
	//send the message, check for errors
	if (!$mail->send()) {
		//echo "Mailer Error: " . $mail->ErrorInfo;
		return false;
	} else {
		//echo "Message sent!";
		return true;
	}
}
?>
