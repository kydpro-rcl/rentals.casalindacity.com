<script type="text/javascript" src="js/confirm.js"></script>
<? /*include('menu_CSS/menu-services.php');*/?>
<?php
$data= new getQueries();
$services=$data->showTable_r('payments', 'ref', $_GET['r'], '=');
if($services[0]['id']>0){
?>
<p class="header">Transactions history for booking: <?=$_GET['r']?></p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
<tr style="background-color:green; color:white;">
	<?if ($_SESSION['info']['manager']==1){/*only allow delete to managers*/?><td>Del</td><?}?>
	<!--<td class='centro' id="td">ref</td>-->
	<td class='centro' id="td">type</td>
	<td class='centro' id="td">class</td>
	<td class='centro' id="td">transid</td>
	<td class='centro' id="td">amount</td>
	
	<td class='centro' id="td">notes</td>
	<td class='centro' id="td">user</td>
	<td class='centro' id="td">date</td>
</tr>
<?php
$x=0;
$db= new DB();
	foreach ($services as $k){
	 $made=$db->getUserDetails($k['user']);
	 #echo $customers['4']['name'];
		switch($k['class']){
				case 1: $classif='Payment';$colors='black'; break;
				case 2: $classif='Payment refund';$colors='blue'; break;
				case 3: $classif='Security deposit';$colors='red'; break;
				case 4: $classif='Security refund';$colors='green'; break;
				case 5: $classif='Transfer to booking';$colors='blue'; break;				
		}
	?>
	<tr class="fila<?=$x?>" style="color:<?=$colors?>">
	<?if ($_SESSION['info']['manager']==1){/*only allow delete to managers*/?>
		<td><a href="transationsHistory.php?del=<?=$k['id']?>&r=<?=$_GET['r']?>" onClick="return confirmSubmitText('Are you sure you want to delete the information for this transaction?');"  >
			<img src="images/b_drop.png" title="delete" alt="delete" width="16px" height="16px" border="0" />
		</a></td>
	<?}?>
		<!--<td ><?=$k['ref']?></td>-->
		<td class='centro' id='td'>
		<? switch($k['type']){
				case 1: $tipo='cash'; break;
				case 2: $tipo='Credit Card'; break;
				case 3: $tipo='Paypal'; break;
				case 4: $tipo='Bank Transfer'; break;
				case 5: $tipo='Move to Ref'; break;
				case 6: $tipo='Others'; break;
		}
		echo $tipo;
		?> </td>
		<td  >
		<? 
		echo $classif;
		?> </td>
		<td class='descrip' ><?=$k['transid']?></td>
		<td class='centro' id="td"><?=$k['amount']?></td>
		<td class='centro' id="td"><?=$k['notes']?></td>
		<td class='centro' id="td"><?=$made[0]['name']." ".$made[0]['lastname'];?> <?=$k['user']?></td>
		<td class='centro' id="td"><?=$k['fecha']?></td>
	</tr>
	<? if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>
	</table>
<?}else{
echo "<h2>There is not transactions for this booking</h2>";
}?>

<?php

$facturaEnviada=$data->show_data($table='ppinvoices', $condition="ref='".$_GET['r']."'", $order='id');/*INVOICES FOR THIS BOOKING*/

if($facturaEnviada){
?>
<p class="header">Invoices API history for booking: <?=$_GET['r']?></p>
<p style="padding:0; margin:0; margin-left:5%;"><strong><? echo count($facturaEnviada);?> Invoices sent</strong></p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
<tr style="background-color:green; color:white;">
	<td class='centro' id="td">invoiceID</td>
	<!--<td class='centro' id="td">Booking</td>-->
	<td class='centro' id="td">Charged</td>
	<td class='centro' id="td">Amount</td>
	<td class='centro' id="td">InvoiceDate</td>
	<td class='centro' id="td">Due Date</td>
	<td class='centro' id="td">Status</td>
	<td class='centro' id="td">URL</td>
	<td class='centro' id="td">Cancel</td>
</tr>
<?php
$x=0;
	foreach ($facturaEnviada as $k){
	?>
	<tr class="fila<?=$x?>" style="color:<?=$colors?>">
		<td ><?=$k['invoiceID']?></td>
		<!--<td class='centro' id='td'>
		<?=$k['ref']?>
		</td>-->
		<td><? if($k['tipopago']==3){ echo "100%"; }elseif($k['tipopago']==2){ echo "50%"; }elseif($k['tipopago']==1){echo "One night";}?></td>
		<td align="right"><?=$k['amount']?></td>
		<td class='centro' id="td"><?=$k['invoicedate']?></td>
		<td class='centro' id="td"><?=$k['duedate']?></td>
		<td class='centro' id="td"><?=$k['status']?></td>
		<td class='centro' id="td"><a href='<?=$k['url']?>' target="_blank">View</a></td>
		<td class='centro' id="td"><? if(($k['status']=='Reminded')||($k['status']=='Sent')){?><a href='cancel_invoice.php?inv=<?=$k['invoiceID']?>' target="_blank">Cancel</a><?}?></td>
	</tr>
	<? if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>
	</table>
<?php 
} 
?>

