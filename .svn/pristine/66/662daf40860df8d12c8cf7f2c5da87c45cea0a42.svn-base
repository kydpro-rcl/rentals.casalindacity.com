<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['id']!=0){
		/*$_GET['p']='a'; $_GET['s']='a.d';*/
		require_once('init.php');
		require_once('invoiceAPI/InvoiceAPI.php');
		$_GET['call']=call_API_to_check_payments();
		/*echo "<pre>";
        print_r($payments);
        echo "</pre>";*/
		display('call_API_4_payments');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>