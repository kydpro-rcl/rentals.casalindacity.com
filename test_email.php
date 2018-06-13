<html>

<head>
  <title></title>
</head>

<body>

<?php
#require_once('booking/init.php');


?>
<?php
/*require_once("Mail.php");

$from = "Your Name <email@blahblah.com>";
$to = "Their Name <ing.joseluis@msn.com>";
$subject = "Subject";
$body = "<html><head></head><body><b>Lorem ipsum</b> dolor sit amet, consectetur adipiscing elit...</body></html>";

//$host = "mailserver.blahblah.com";
$host = "smtp.ent.lyse.net";
$username = "smtp_username";
$password = "smtp_password";

$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
        'Content-Type' => "text/html; charset=ISO-8859-1");

$smtp = Mail::factory('smtp', array ('host' => $host,
                                     'auth' => false,
                                     'username' => $username,
                                     'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if ( PEAR::isError($mail) ) {
    echo("<p>Error sending mail:<br/>" . $mail->getMessage() . "</p>");
} else {
    echo("<p>Message sent.</p>");
} */
?>

<?php
$body = "<html><head></head><body><b>Lorem ipsum pueba funcion</b> dolor sit amet, consectetur adipiscing elit...</body></html>";

 function send_email_smtp($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1");

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);

	/*if ( PEAR::isError($mail) ) {
	    echo("<p>Error sending mail:<br/>" . $mail->getMessage() . "</p>");
	} else {
	    echo("<p>Message sent.</p>");
	}*/

 }

 send_email_smtp($from='joseluis@hotmail.com', $to='ing.joseluisdr@gmail.com', $subject='test', $body);
?>

</body>

</html>