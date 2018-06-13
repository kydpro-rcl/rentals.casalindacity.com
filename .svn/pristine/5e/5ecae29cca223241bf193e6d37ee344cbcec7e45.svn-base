<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['id']!=0){
		/*$_GET['p']='a'; $_GET['s']='a.d';*/
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');
		display('ppInvoicesAPI');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>