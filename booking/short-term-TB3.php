<?php
 session_start();
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.n';
	require_once('init.php');
	display('short-term-TB3');
}else{
	header('Location:login.php');
	die();
}
?>