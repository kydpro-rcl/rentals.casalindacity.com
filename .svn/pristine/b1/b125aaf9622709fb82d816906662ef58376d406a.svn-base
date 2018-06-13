<?php
require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.b';
	require_once('init.php');
	display('invoices_buyer');
}else{
	header('Location:login.php');
	die();
}
?>