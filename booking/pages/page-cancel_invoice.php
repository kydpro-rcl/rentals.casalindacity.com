<?php
if ($_GET['inv']){ 
	//search invoices in system and find out if status is sent or reminded
	require_once('invoiceAPI/InvoiceAPI.php');
	
	$resultado=cancelInvoice($invoiceId=$_GET['inv']);
	/*echo "<pre>";
	print_r($resultado);
	echo "</pre>";*/
	
	if($resultado['responseEnvelope.ack']=='Success'){/*si tubo exito al cancelar la factura*/
		$invoice_info=getDetailsInvoice($invoiceId=$_GET['inv']);
		/*echo "<pre>";
		print_r($invoice_info);
		echo "</pre>";*/
		$db=new getQueries (); 
		$facturasEnviada=$db->show_data($table='ppinvoices', $condition="invoiceID='".$_GET['inv']."'", $order='id');/*INVOICES FOR THIS BOOKING*/
		changeStatus($facturasEnviada[0]['id'], $status=$invoice_info['invoiceDetails.status']);
		//send info to reservation 
		//print_r($_SESSION['info']);
		$name_user=$_SESSION['info']['name'].' '.$_SESSION['info']['lastname'];
		$body=cancelled_invoice($facturasEnviada[0]['ref'], $name_user, $invoice_id=$_GET['inv'], $invoice_amount=$invoice_info['invoiceDetails.totalAmount']);
		//--who canceled, booking number, amount invoiced, invoice number
		sendMail_copy_reservations($body, $email_to_send='reservations@casalindacity.com', $subject="INVOICE CANCELLATION:".$facturasEnviada[0]['ref'], $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');	
				//SAVE EMAIL SENT IN DB	
				$info5=array('email'=>$email_to_send, 'ref'=>$facturasEnviada[0]['ref'], 'msg'=>utf8_encode($body), 'date'=>time());	
				$data=new subDB ();
				$datos=$data->insert($info5, 'confirmation_sent'); 
		echo "<h2>Invoice successfully cancelled</a>";
	}else{
		echo "<h2>Error: Invoice cancellation failed</h2>";
		echo "<pre>";
		print_r($resultado);
		echo "</pre>";
	}
	//save status as cancelled
	//save who cancelled
}else{
	echo "No invoice found";
}
?>
