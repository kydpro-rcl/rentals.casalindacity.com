<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['contabilidad']==2){
		$_GET['p']='cle'; $_GET['s']='cle.d';
		require_once('init.php');

		display('dirty');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>