<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['id']!=0){
		/*$_GET['p']='a'; $_GET['s']='a.d';*/
		require_once('init.php');
		if ($_SESSION['info']['manager']==1){/*only allow delete to managers*/
		 if ($_GET['del']){
	       	$db=new DB();
	       	$delete=$db->delete_items('payments', 'id', $_GET['del']);
	     }
		// delete_items($table, $field, $value)
		}
		display('transationsHistory');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>