<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='ad'; $_GET['s']='r.br';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');
		display('bookings_referral72');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>