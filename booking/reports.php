<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='r.cc';
		require_once('init.php');

		display('reports');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>