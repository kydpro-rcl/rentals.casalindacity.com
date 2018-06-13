<?php
 session_start();
if ($_SESSION['info']){
	$_GET['p']='p'; $_GET['s']='p.s';
	require_once('init.php');
	display('security-sheet');
}else{
	header('Location:login.php');
	die();
}
?>