<?php
session_start();
if ($_SESSION['referal']){
	if (!$_SESSION['RCL']=="rcladministraciones") die('Restrinted area...');
	unset($_SESSION['RCL']);
	$_SESSION['RCL1']="rcladministraciones";
	require_once('init.php');
	dibujar('search_result');
}else{
	header('Location:login.php');
	die();
}
?>