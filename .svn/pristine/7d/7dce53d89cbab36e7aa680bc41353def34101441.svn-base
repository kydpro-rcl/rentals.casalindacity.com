<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.r';
	require_once('init.php');
	display('register-sheet');
}else{
	header('Location:login.php');
	die();
}
?>