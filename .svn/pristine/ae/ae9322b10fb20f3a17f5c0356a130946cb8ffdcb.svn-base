<?php
 session_start();
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.n';
	require_once('init.php');
	//display_1('send_info_client');
	display('send_info_client');
}else{
	header('Location:login.php');
	die();
}	
?>