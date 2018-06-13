<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='b'; $_GET['s']='b.book_changed';
		require_once('init.php');

		display('bookings_changed');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>