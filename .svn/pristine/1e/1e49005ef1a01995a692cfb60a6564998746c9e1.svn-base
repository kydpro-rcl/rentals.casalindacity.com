<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.ck';
	require_once('init.php');
	display('check_in_confirm');
}else{
	header('Location:login.php');
	die();
}
?>