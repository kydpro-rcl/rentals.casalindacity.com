<?php
 session_start();
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='ad'; $_GET['s']='ad.i';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');

		display('change_discount');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>