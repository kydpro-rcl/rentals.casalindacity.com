<?php
if($_SESSION['referal']['agency']==1){
$db= new getQueries();

$users=$db->showTable_restrinted($table='commission', $condition="agency_user='".$_SESSION['referal']['id']."'", $order='id');
/*echo "<pre>";
print_r($_SESSION['referal']);
echo "</pre>";
*/
/*echo "<pre>";
print_r($users);
echo "</pre>";*/
?>
<div style="clear:both">
<?

if($users){
	foreach($users AS $k){
		echo "<div style='border: 1px solid red;'>";
		echo "<p style='background-color:green; color:white; margin-right:5px;margin-left:5px;padding-left:5px;'>Agent Name: <STRONG>".$k['name']." ".$k['name']; echo "</STRONG></p><br/>";
		seeReferralClients($k['id']);
		bookings_referralID($referalID=$k['id']);
		echo "</div>";echo "<p>&nbsp;</p>";
	}
}else{
	echo "<p>This Agency do not have agents registered</p>";
}
?>
</div>
<?}?>