<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.o';
	require_once('init.php');
	display('check_out_done');
}else{
	header('Location:login.php');
	die();
}	
?>