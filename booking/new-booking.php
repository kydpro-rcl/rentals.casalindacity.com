<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.n';
	require_once('init.php');
	display('new-booking');
}else{
	header('Location:login.php');
	die();
}
?>