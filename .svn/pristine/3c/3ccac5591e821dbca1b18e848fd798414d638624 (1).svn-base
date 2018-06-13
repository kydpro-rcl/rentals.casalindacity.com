<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if (($_SESSION['info']['manager']==1)||($_SESSION['info']['report']!=0)){
		$_GET['p']='tick'; $_GET['s']='t.c';
		$_GET['estilo_content']='class="clearfix" style="background-color:white;"';
		require_once('init.php');

		display('ticketcompleted');
	}else{
		header('Location:home-welcome.php');
		die();
		//echo "Hacumular $hola";
		//$pesos=5;
	}
}else{
	header('Location:login.php');
	die();
}
?>