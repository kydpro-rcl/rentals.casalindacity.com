<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='b'; $_GET['s']='b.e';
		require_once('init.php');
		display('edit_maintenance');

	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>