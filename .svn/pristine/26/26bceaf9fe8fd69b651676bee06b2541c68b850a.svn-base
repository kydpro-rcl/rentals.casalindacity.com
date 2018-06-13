<script type="text/javascript" src="js/confirm.js"></script>

<form method="post" action="paypal_aplied_by_users.php">
Date(YYYY-MM-DD):<input type="text" name="fecha" value="<?=$_POST['fecha']?>"/><input type="submit" name="Go" value="Go"/>
<hr/>
</form>
<? /*include('menu_CSS/menu-services.php');*/?>
<?php
if(!$_POST['fecha']){$fech=date('Y-m-d');}else{$fech=$_POST['fecha'];}
$data= new getQueries();
$services=$data->showTable_restrinted('payments', "type='3' AND class='1' AND user<>'0' AND fecha LIKE '".$fech."%'", 'id');
if($services[0]['id']>0){
?>
<p class="header">Paypal applied by users today</p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
<tr style="background-color:green; color:white;">
	<?if ($_SESSION['info']['manager']==1){/*only allow delete to managers*/?><td>Del</td><?}?>
	<td class='centro' id="td">ref</td>
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
		}
	?>
	<tr class="fila<?=$x?>" style="color:<?=$colors?>">
	<?if ($_SESSION['info']['manager']==1){/*only allow delete to managers*/?>
		<td><a href="paypal_aplied_by_users.php?del=<?=$k['id']?>&r=<?=$_GET['r']?>" onClick="return confirmSubmitText('Are you sure you want to delete the information for this transaction?');"  >
			<img src="images/b_drop.png" title="delete" alt="delete" width="16px" height="16px" border="0" />
		</a></td>
	<?}?>
		<td ><?=$k['ref']?></td>
		
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
		<td class='centro' id="td"><?=$made[0]['name']." ".$made[0]['lastname'];?></td>
		<td class='centro' id="td"><?=$k['fecha']?></td>
	</tr>
	<? if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>
	</table>
<?}else{
echo "<h2>There is not transactions for $fech</h2>";
}?>