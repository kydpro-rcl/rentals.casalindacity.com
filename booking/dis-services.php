<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['level']==1){
		$_GET['p']='a'; $_GET['s']='a.d';
		require_once('init.php');
		 if ($_GET['del']){
	       	$db=new DB();
	       	$delete=$db->delete_items('serv_add', 'id', $_GET['del']);
	       }
		// delete_items($table, $field, $value)
		display('dis-services');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>