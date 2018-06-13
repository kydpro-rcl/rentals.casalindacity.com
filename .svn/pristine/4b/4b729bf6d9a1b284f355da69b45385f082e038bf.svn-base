<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['report']!=0){
		$_GET['p']='tick'; $_GET['s']='t.h';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');

		display('emainthistory');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>