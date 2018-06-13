<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.c';
	require_once('init.php');
	display('customer-list');
}else{
	header('Location:login.php');
	die();
}
?>