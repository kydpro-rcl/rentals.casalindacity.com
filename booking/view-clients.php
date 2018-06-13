<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='c'; $_GET['s']='c.v';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init.php');
	display('view-clients');
}else{
	header('Location:login.php');
	die();
}	
?>