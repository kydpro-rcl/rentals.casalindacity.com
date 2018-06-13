<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	unset($_SESSION['COUNT']['QTY1']);unset($_SESSION['COUNT']['QTY2']);
	if ($_SESSION['info']['contabilidad']==1){
		$_GET['p']='con'; $_GET['s']='con.p';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');
		require_once('inc/functions_news.php');
		display('ready_to_pickup');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>