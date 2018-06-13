<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='c'; $_GET['s']='c.f';
	require_once('init.php');
	display('find-client');
}else{
	header('Location:login.php');
	die();
}	
?>