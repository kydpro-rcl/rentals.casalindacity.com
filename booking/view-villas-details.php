<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='v';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init.php');
	
	if ($_GET['id']){
		display('view-villas-details');
	}else{
		header('Location:view-villas.php');
		die();
	 }
}else{
	header('Location:login.php');
	die();
}
?>