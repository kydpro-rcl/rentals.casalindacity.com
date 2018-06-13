<?php
require_once('inc/session.php');/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
if ($_SESSION['info']){
	$_GET['p']='b';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init.php');
	display('booking-calendar');
}else{
	header('Location:login.php');
	die();
}
?>