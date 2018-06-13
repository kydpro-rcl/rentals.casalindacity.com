<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad';
		require_once('init.php');
		display('view-users');
	}else{		header('Location:home-welcome.php');
		die();	}
}else{
	header('Location:login.php');
	die();
}
?>