<?php
 session_start();
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=2){
		$_GET['p']='ad'; $_GET['s']='r.br';
		$_GET['estilo_content']='class="clearfix" style="background-color:white; min-height: 500px;"';
		require_once('init.php');
		display('stat_from2');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>