<?php
function correo_info2($body, $fromadd, $fromnam, $type, $client_array){
	$toemail='info@casalindacity.com';
	//ENVIAR EMAIL
	$MailHeader ='From: '.$fromnam.' <'.$fromadd.'>'."\n";
	$MailHeader .='Reply-To: '.$fromadd."\n";
	$MailHeader .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
	$MailHeader .='Content-Transfer-Encoding: 8bit';
	
	$MailBody .= "Message sent from Agent Portal (www.CasaLindaCity.com): ".date('l jS \of F Y h:i:s A')." \n";
	$MailBody .="-----------------------------------------------------------------\n\n";
	$MailBody .= "Agent Details\n";
	$MailBody .= "Name: ".$fromnam."\n";
	$MailBody .= "Email: ".$fromadd."\n\n";
	$MailBody .= "Message: ".$body."\n\n";
	$MailBody .= "Client details: ".$client_array['name'].' '.$client_array['lastname'].' ('.$client_array['email'].')'."\n";
	
	
	if($type=='1'){
		$MailSubject="Client created by Sales Agent";
	}elseif($type=='2'){
		$MailSubject="Client rejected to Sales Agent";
	}
	$ip=$_SERVER['REMOTE_ADDR'];
	if($ip){
		$MailBody .="IP visiter : ".$ip."\n";
		$MailBody .="See from where is coming this message : http://www.geoiptool.com/en/?IP=".$ip;			
			$res=mail($toemail, $MailSubject, $MailBody, $MailHeader);
			$res=mail('casalindadr@gmail.com', $MailSubject, $MailBody, $MailHeader);
	}
}

function correo_info($body, $fromadd, $fromnam, $type){
	$toemail='info@casalindacity.com';
	//ENVIAR EMAIL
	$MailHeader ='From: '.$fromnam.' <'.$fromadd.'>'."\n";
	$MailHeader .='Reply-To: '.$fromadd."\n";
	$MailHeader .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
	$MailHeader .='Content-Transfer-Encoding: 8bit';
	
	$MailBody .= "Message sent from Agent Portal (www.CasaLindaCity.com): ".date('l jS \of F Y h:i:s A')." \n";
	$MailBody .="-----------------------------------------------------------------\n\n";
	$MailBody .= "Agent Details\n";
	$MailBody .= "Name: ".$fromnam."\n";
	$MailBody .= "Email: ".$fromadd."\n\n";
	$MailBody .= "Message: ".$body."\n";
	
	if($type=='1'){
		$MailSubject="Client created by Sales Agent";
	}elseif($type=='2'){
		$MailSubject="Client rejected to Sales Agent";
	}
	$ip=$_SERVER['REMOTE_ADDR'];
	if($ip){
		$MailBody .="IP visiter : ".$ip."\n";
		$MailBody .="See from where is coming this message : http://www.geoiptool.com/en/?IP=".$ip;			
			$res=mail($toemail, $MailSubject, $MailBody, $MailHeader);
			$res=mail('casalindadr@gmail.com', $MailSubject, $MailBody, $MailHeader);
	}
}

function referralForgotPwd($toemail, $body){
	$fromadd='info@casalindacity.com';	
	$fromnam='Residencial Casa Linda';
	//ENVIAR EMAIL
	$MailHeader ='From: '.$fromnam.' <'.$fromadd.'>'."\n";
	$MailHeader .='Reply-To: '.$fromadd."\n";
	$MailHeader .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
	$MailHeader .='Content-Transfer-Encoding: 8bit';
	$MailBody .= "Agent Portal (www.CasaLindaCity.com): \n";
	$MailBody .="-----------------------------------------------------------------\n\n";
	$MailBody .= $body."\n";
	$MailBody .= "Please, visit: www.CasaLindaCity.com\n";
	$MailBody .= "Email: reservations@casalindacity.com\n";
	$MailBody .= "Phone: 809-571-1190\n\n";
	$MailSubject="Your password forgotten";	
	$res=mail($toemail, $MailSubject, $MailBody, $MailHeader);
	$res=mail('casalindadr@gmail.com', $MailSubject, $MailBody, $MailHeader);		
}

function correo_agent($toemail, $body){
	$fromadd='info@casalindacity.com';	
	$fromnam='Residencial Casa Linda';
	//ENVIAR EMAIL
	$MailHeader ='From: '.$fromnam.' <'.$fromadd.'>'."\n";
	$MailHeader .='Reply-To: '.$fromadd."\n";
	$MailHeader .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
	$MailHeader .='Content-Transfer-Encoding: 8bit';
	$MailBody .= "Agent Portal (www.CasaLindaCity.com): \n";
	$MailBody .="-----------------------------------------------------------------\n\n";
	$MailBody .= $body."\n";
	$MailBody .= "Please, visit: www.CasaLindaCity.com\n";
	$MailBody .= "Email: info@casalindacity.com\n";
	$MailBody .= "Phone: 809-571-1190\n\n";
	$MailSubject="New client created";	
	$res=mail($toemail, $MailSubject, $MailBody, $MailHeader);
	$res=mail('casalindadr@gmail.com', $MailSubject, $MailBody, $MailHeader);		
}


define("TEMPLATE_HEADER","template/header.php");
define("TEMPLATE_FOOTER","template/footer.php");
define("TEMPLATE_BASE","<base href=\"http://localhost/https.casalindacity/for_rent/colleen\" />");
define("VIRTUALES","../for_rent/colleen/Includes/pmm_include.htm");
define("ROOT_FOLDER","../for_rent/");
define("SELECT_MENU","class=\"active\"");
define("TEMPLATE_CABEZA","template/cabeza.php");
define("TEMPLATE_PIE","template/pie.php");
define("TEMPLATE_CAB","template/cab.php");
define("TEMPLATE_PI","template/pi.php");
define('FECHA',date("Y-m-d G:i:s"));
?>