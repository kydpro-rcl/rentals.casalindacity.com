<?php
require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.l';
	require_once('init.php');
	display('invoices_long');
}else{
	header('Location:login.php');
	die();
}
?>