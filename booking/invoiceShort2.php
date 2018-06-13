<?php
require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.i';
	require_once('init.php');
	display('invoices_short2');
}else{
	header('Location:login.php');
	die();
}	
?>