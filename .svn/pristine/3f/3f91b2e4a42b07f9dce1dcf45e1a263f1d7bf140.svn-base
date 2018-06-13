<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='ad'; $_GET['s']='ad.ps';
		require_once('init.php');

		display('price-settings');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>