<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']<=3){
		$_GET['p']='v';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');
		display('view-villas-ha');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>