<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.f';
	require_once('init.php');
	display('find-booking');
}else{
	header('Location:login.php');
	die();
}	
?>