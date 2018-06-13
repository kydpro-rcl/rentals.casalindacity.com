<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='v'; $_GET['s']='v.e';
		require_once('init.php');
		display('edit-owner');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>