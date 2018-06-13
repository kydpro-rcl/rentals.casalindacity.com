<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	unset($_SESSION['COUNT']['QTY']);unset($_SESSION['COUNT']['QTY1']);
	if ($_SESSION['info']['contabilidad']==1){
		$_GET['p']='con'; $_GET['s']='con.paid';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('inc/functions_news.php');
		require_once('init.php');
		
		display('paid');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>