<?php
 session_start();
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='ad.c';
		require_once('init.php');

		display('send_emails_clients');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>