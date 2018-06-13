<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='c'; $_GET['s']='c.m';
		require_once('init.php');
		display('merge-client');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>