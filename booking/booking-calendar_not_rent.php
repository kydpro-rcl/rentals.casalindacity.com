<?php
error_reporting(0);
ini_set('display_errors', 0);
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init2.php');
	/*require_once('init.php');*/
	display('booking-calendar_not_rent');
}else{
	header('Location:login.php');
	die();
}
?>