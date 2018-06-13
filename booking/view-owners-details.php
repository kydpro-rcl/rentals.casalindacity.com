<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='v'; $_GET['s']='v.o';
	require_once('init.php');
	
	if ($_GET['id']){
		display('view-owners-details');
	}else{
		header('Location:view-owners.php');
		die();
	 }
}else{
	header('Location:login.php');
	die();
}
?>