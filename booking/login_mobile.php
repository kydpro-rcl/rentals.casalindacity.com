<?
 require_once('inc/session.php');
  require_once('init.php');
  
  require_once('Mobile-Detect-master/Mobile_Detect.php');
 $detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
  display_mobile('login_mobile');
}else{
	header('Location:login.php');
}

?>