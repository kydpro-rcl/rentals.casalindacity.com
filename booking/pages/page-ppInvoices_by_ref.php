<script type="text/javascript" src="js/confirm.js"></script>
<? include('menu_CSS/menu-admin.php');?>

<!--<form method="post" action="ppInvoices_by_ref.php">
Date(YYYY-MM-DD):<input type="text" name="fecha" value="<?=$_POST['fecha']?>" ><input type="submit" name="go" value="go"/>
</form>-->
<?php
$db= new getQueries();
/*if(!$_POST){
	$fecha=date('Y-m-d');
}else{
	$fecha=$_POST['fecha'];
}*/
//echo $_GET['ref'];
 $facturaEnviada=$db->show_data($table='ppinvoices', $condition="ref='".$_GET['ref']."'", $order='id');/*INVOICES FOR THIS BOOKING*/
//$facturaEnviada=$data->show_data($table='ppinvoices', $condition="invoicedate='".$fecha."'", $order='id');
/*
echo $condition;
print_r($facturaEnviada);*/
if($facturaEnviada){
?>
<p class="header">Invoices API history</p>
<p style="padding:0; margin:0; margin-left:5%;"><strong><? echo count($facturaEnviada);?> Invoices sent</strong></p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
<tr style="background-color:green; color:white;">

	<td class='centro' id="td">invoiceID</td>
	<td class='centro' id="td">Booking</td>
	<td class='centro' id="td">Charged</td>
	<td class='centro' id="td">Amount</td>
	<td class='centro' id="td">InvoiceDate</td>
	
	<td class='centro' id="td">Due Date</td>
	<td class='centro' id="td">Status</td>
	<td class='centro' id="td">URL</td>

</tr>
<?php
$x=0;
//$db= new DB();


	foreach ($facturaEnviada as $k){
	 //$made=$db->getUserDetails($k['user']);
	#echo $customers['4']['name'];
	?>
	<tr class="fila<?=$x?>" style="color:<?=$colors?>">
	
		<td ><?=$k['invoiceID']?></td>
		
		<td class='centro' id='td'>
		<?=$k['ref']?>
		</td>
		<td><? if($k['tipopago']==3){ echo "100%"; }elseif($k['tipopago']==2){ echo "50%"; }elseif($k['tipopago']==1){echo "One night";}?></td>
		<td align="right"><?=$k['amount']?></td>
		<td class='centro' id="td"><?=$k['invoicedate']?></td>
		<td class='centro' id="td"><?=$k['duedate']?></td>
		<td class='centro' id="td"><?=$k['status']?></td>
		<td class='centro' id="td"><a href='<?=$k['url']?>' target="_blank">View</a></td>
	</tr>
	<? if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>
	</table>
<?}else{
echo "<h2>There is not invoices sent for this date</h2>";
}?>