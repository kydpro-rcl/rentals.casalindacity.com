<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='c'; $_GET['s']='c.v';
	require_once('init.php');
	
	if ($_GET['id']){
		
		display('view-clients-details');
	}else{
		header('Location:view-clients.php');
		die();
	 }
}else{
	header('Location:login.php');
	die();
}	
?>