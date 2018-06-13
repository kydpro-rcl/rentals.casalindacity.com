<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']<=5){
		$_GET['p']='v';
		$_GET['s']='v.r';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');
		display('view-interm3');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>