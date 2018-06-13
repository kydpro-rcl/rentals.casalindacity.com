<?php
 session_start();
if ($_SESSION['info']){	if ($_SESSION['info']['level']<=2){
		$_GET['p']='ad'; $_GET['s']='ad.se';
		require_once('init.php');
		display('special_events');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>