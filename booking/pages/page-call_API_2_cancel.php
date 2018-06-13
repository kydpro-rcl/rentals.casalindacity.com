<script type="text/javascript" src="js/confirm.js"></script>
<? include('menu_CSS/menu-services.php');

$booking2check=$_GET['call'];
/*echo "<pre>";
print_r($payments);
echo "</pre>";*/
$db= new getQueries();
$invoicesDelected=0;
foreach($booking2check AS $k=>$v){
	$book=$db->see_occupancy_ref($v); //get reservation details
	// echo "new $v before";
	$montoTotalPagado=$db->amountRef($v,'1');/*paid after API has been called to check invoices paid*/
	$totaldue=$book[0]['total']-$montoTotalPagado;
	
	if(($totaldue<=1)||($book[0]['status']==4)||($book[0]['status']==0)){	
		 require_once('invoiceAPI/InvoiceAPI.php');
		 //echo($v);
		$facturasUnpaid=$db->invoicesUnpaid($v);
		//print_r($facturasUnpaid);
		foreach($facturasUnpaid AS $k){
			$invoicesDelected++;
			$resultado=cancelInvoice($invoiceId=$k['invoiceID']);
			if($resultado['responseEnvelope.ack']=='Success'){
				$invoice_info=getDetailsInvoice($invoiceId=$k['invoiceID']);
				$db=new getQueries (); 
				$facturasEnviada=$db->show_data($table='ppinvoices', $condition="invoiceID='".$k['invoiceID']."'", $order='id');
				changeStatus($facturasEnviada[0]['id'], $status=$invoice_info['invoiceDetails.status']);
			
			}
		}
	}
}


/*



*/
			
			
			
if($booking2check){
?>
<p class="header">API Calling Result</p>
<p><strong>Invoices cancelled: <? echo $invoicesDelected;?></strong></p>

<?
/*echo "<pre>";
print_r($payments);
echo "</pre>";*/
?>

<?}else{
echo "<h2>No booking with invoices pending found during this call</h2>";
}?>