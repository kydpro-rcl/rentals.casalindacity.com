<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.o';
	require_once('init.php');
	display('invoice_owners2');
}else{
	header('Location:login.php');
	die();
}
?>