<?
$db=new getQueries();
$checkin=$db->check_in_today();
//echo $checkout[0]['ref'];
 $total=$db->getAffectedRows();
 ?>
 <h2 class="centro">Checking In Today (<?=$total?>)</h2>
 <hr>
 <? if (!empty($checkin)){?>
	  <table cellpadding="2" cellspacing="2" align="center"><tr class="title"><td id="td">VILLA NO.</td><td id="td">REFERENCE</td><td id="td">STARTING</td><td id="td">ENDING</td><td id="td">CUSTOMER</td><td id="td">EMAIL</td><td id="td">PHONE</td><td id="td">ADULTS</td><td id="td">KIDS</td><td id="td">STATUS</td></tr>
	 <? $x=0;
	foreach ($checkin as $in){
		$villa=$db->villa($in['villa']);
		//$client=$db->customer($in['client']);
		if(($in['status']==7)||($in['status']==19)||($in['status']==20)||($in['status']==21)||($in['status']==22)||($in['status']==23)||($in['status']==24)||($in['status']==25)){
			$client=$db->owners_details($in['client']);
			$client=$client[0];
		}else{
			$client=$db->customer($in['client']);
		}
		?>
		<tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="location.href='check_in_confirm.php?id=<?=$in['reserveid']?>&r=<?=$in['ref']?>'" title="" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
		<td id="td"><?=$villa[0]['no']?></td>
		<td id="td"><?=$in['ref']?></td>
		<td id="td"><?=formatear_fecha($in['start'])?></td>
		<td id="td"><?=formatear_fecha($in['end'])?></td>
		<td id="td"><? echo $client['name'].' '.$client['lastname']?></td>
		<td id="td"><? echo $client['email'];?></td>
		<td id="td"><? echo $client['phone'];?></td>
		
		<td id="td"><?=$in['adults']?></td><td id="td"><?=$in['kids']?></td> <td id="td"> <?=booking_status($in['status']);?></td>
		</tr>
	<?
    if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>

 </table>
 <?} else{
 	echo "<h3 class=\"centro\">There is no check in for today</h3>";
 }
 	?>

