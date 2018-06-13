<?php
 session_start();
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.n';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init.php');
	//display_1('send_info_client');
	display('send_booking_invoice');
}else{
	header('Location:login.php');
	die();
}	
?>