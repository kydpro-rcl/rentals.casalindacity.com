<?php;
require_once('inc/init.php');
if($_POST){
	//print_r($_POST);
	if(isset($_POST['Email2'])) {
		$email_to = "webmaster@casalindacity.com";
		$email_subject = "Rentals Website Contact";
		$email_from=trim($_POST['Email2']);
	}
	$email_message = "Form details below.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $msg="";
	foreach($_POST AS $k=>$v){
		$msg.=$k.": ".clean_string($v)."\n";
	}
	// create email headers	 
	$headers = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	//@mail('edwin@casalindacity.com', $email_subject, $msg, $headers); 
	@mail('reservations@casalindacity.com', $email_subject, $msg, $headers);  	
	@mail($email_to, $email_subject, $msg, $headers);  
	$_GET['success']="Thank you for contacting us. <br/> We have received your email and we will be in touch with you very soon.";
}

draw_resp('contact-information');
?>