<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
 // if ($_GET['refnumb']){
  if ($_SESSION['info']['level']<=4){
	 $_GET['estilo_content']='class="clearfix" style="background-color:white;"';
	 $_GET['p']='b'; $_GET['s']='b.e';
	 require_once('init.php');
	 display('edit-bookingtb1');
  }else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>