<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.e';
	require_once('init.php');
	display('edit-booking2');
}else{
	header('Location:login.php');
	die();
}
?>