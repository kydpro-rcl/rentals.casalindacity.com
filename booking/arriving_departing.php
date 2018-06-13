<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='ad'; $_GET['s']='ad.i';
	$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	require_once('init.php');
	display('arriving_departing');
}else{
	header('Location:login.php');
	die();
}	
?>