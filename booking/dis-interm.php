<?php
 require_once('inc/session.php');
if ($_SESSION['info']){	if ($_SESSION['info']['level']==1){
		$_GET['p']='v'; $_GET['s']='i.d';
		require_once('init.php');
		   //si get del entonces borrar aqui.
	       if ($_GET['del']){
	       	$db=new DB();	       	$delete=$db->delete_intermediary($_GET['del']);
	       }
		display('dis-interm');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>