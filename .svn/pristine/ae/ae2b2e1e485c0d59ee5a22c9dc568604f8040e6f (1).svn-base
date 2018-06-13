<?php require_once('inc/session.php');
if ($_SESSION['info']){
	$_GET['p']='b';
	$_GET['s']='b.h';
	require_once('init.php');
	require_once('invoiceAPI/InvoiceAPI.php');
	/*$invoicesDue=callAPI_toCheckInvoices();//check status and remind if not paid
	
	if(!$invoicesDue){//save load on server only one function at the time.	
		$invoicesToday=sendInvoiceReservations();
	}*/
	/*echo "<pre>";
	print_r($invoicesToday);
	echo "</pre>";*/
	
	//echo $invoicesToday;
	
	display('home-welcome');
}else{
	header('Location:login.php');
	die();
}
?>