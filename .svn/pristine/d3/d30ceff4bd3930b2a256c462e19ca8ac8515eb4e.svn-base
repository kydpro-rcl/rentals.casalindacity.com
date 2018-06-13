<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.i';
	require_once('init.php');
	display('inhouses-book');
}else{
	header('Location:login.php');
	die();
}	
?>