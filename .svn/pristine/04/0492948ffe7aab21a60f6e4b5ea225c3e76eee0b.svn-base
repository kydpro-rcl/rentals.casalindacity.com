<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']<=2){
		$_GET['p']='a'; $_GET['s']='a.a';
		require_once('init.php');
		display('view-services_booking');
	}else{

		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>