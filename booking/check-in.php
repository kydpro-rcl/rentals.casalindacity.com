<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b'; $_GET['s']='b.ck';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init.php');
	display('check-in');
}else{
	header('Location:login.php');
	die();
}	
?>