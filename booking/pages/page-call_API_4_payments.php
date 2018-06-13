<script type="text/javascript" src="js/confirm.js"></script>
<? include('menu_CSS/menu-services.php');

$payments=$_GET['call'];

if($payments){
?>
<p class="header">API Calling Result</p>
<p><strong>Invoices checked: <? echo $payments['checked'];?></strong></p>
<p><strong>Invoices paid: <? echo $payments['paid'];?></strong></p>

<? if($payments['paid']<=0){
	echo "<h2>There is not transactions paid for this call</h2>";
}?>

<?
/*echo "<pre>";
print_r($payments);
echo "</pre>";*/
?>

<?}else{
echo "<h2>No invoices pending to pay found during this call</h2>";
}?>