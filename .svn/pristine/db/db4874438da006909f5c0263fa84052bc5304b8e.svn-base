<?
$db=new getQueries();
$checkout=$db->check_out_today();

//echo $checkout[0]['ref'];
 $total=$db->getAffectedRows();
 ?>
 <h2 class="centro">Checking Out Today (<?=$total?>)</h2>
 <hr>
 <? if (!empty($checkout)){?>
	  <table cellpadding="2" cellspacing="2" align="center"><tr class="title"><td id="td">VILLA NO.</td><td id="td">REFERENCE</td><td id="td">STARTING</td><td id="td">ENDING</td><td id="td">CUSTOMER</td><td id="td">ADULTS</td><td id="td">KIDS</td><td>STATUS</td></tr>
	 <? $x=0;
	foreach ($checkout as $out){
		$villa=$db->villa($out['villa']);
		$client=$db->customer($out['client']);
		?>

		<? if($out['status']==1 || $out['status']==6 || $out['status']==7){?>
			<!--//<tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="location.href='check_out_tripadvisor.php?id=<?=$out['reserveid']?>&ref=<?=$out['ref']?>'" title="" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >//-->
			  <tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="location.href='check_out_confirm.php?id=<?=$out['reserveid']?>&ref=<?=$out['ref']?>'" title="" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
        <?}else{?>
          <tr class='fila<?=$x?>' bgcolor="#e2e1e1" onclick="location.href='check_out_confirm.php?id=<?=$out['reserveid']?>&ref=<?=$out['ref']?>'" title="" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
        <?}?>
		<td id="td"><?=$villa[0]['no']?></td><td id="td"><?=$out['ref']?></td><td id="td"><?=formatear_fecha($out['start'])?></td><td id="td"><?=formatear_fecha($out['end'])?></td><td id="td"><? echo $client['name'].' '.$client['lastname']?></td><td id="td"><?=$out['adults']?></td><td id="td"><?=$out['kids']?></td>

		<td>
		 <?=booking_status($out['status']);?>
			 	  <? /*
	       switch ($out['status']){
	       	case 0:
	         	echo "<span style='color:red'>Cancelled</span>";
	         	$short=1;
		       	break;
	       	case 1:
	         	echo "<span class='azul2'>Checked in - Short</span>";
	         	$short=1;
		       	break;
		    case 2:
	         	echo "<span class='azul2'>Confirmed - Short</span>";
	         	$short=1;
		       	break;
		    case 3:
	         	echo "<span class='morado'>No Confirmed - Short </span>";
	         	$short=1;
		       	break;
			case 4:
	         	echo "<span class='outck'>Checked out - Short</span>";
	         	$short=1;
		       	break;
		    case 5:
	         	echo "<span style='color:red'>Maintenance (out of service)</span>";
	         	$maintenaced=1;
		       	break;
		   case 6:
	         	echo "<span class='r_vip'>Checked in - VIP, Short</span>";
	         	$short=1;
		       	break;
		    case 7:
	         	echo "<span class='r_owner'>Checked in - Owner, Short</span>";
	         	$owners_in_house=1;
		       	break;
		    case 8:
	         	echo "<span class='r_long'>Checked in - Long</span>";
	         	$long=1;
		       	break;
		    case 9:
	         	echo "<span class='r_long'>Confirmed - Long</span>";
	         	$long=1;
		       	break;
		 	case 10:
	         	echo "<span class='r_long'>No Confirmed - Long</span>";
	         	$long=1;
		       	break;
		    case 11:
	         	echo "<span class='r_long'>Checked Out - Long</span>";
	         	$long=1;
		       	break;
		 	case 12:
	         	echo "<span class='r_vip'>Confirmed - VIP, Short</span>";
	         	$short=1;
		       	break;
		    case 13:
	         	echo "<span class='r_vip'>No Confirmed - VIP, Short</span>";
	         	$short=1;
		       	break;
		 	case 14:
	         	echo "<span class='r_vip'>Checked Out - VIP, Short</span>";
	         	$short=1;
		       	break;
		    case 15:
	         	echo "<span class='r_vip'>Checked in - VIP, Long</span>";
	         	$long=1;
		       	break;
		 	case 16:
	         	echo "<span class='r_vip'>Confirmed - VIP, Long</span>";
	         	$long=1;
		       	break;
		    case 17:
	         	echo "<span class='r_vip'>No Confirmed - VIP, Long</span>";
	         	$long=1;
		       	break;
		 	case 18:
	         	echo "<span class='r_vip'>Checked Out - VIP, Long</span>";
	         	$long=1;
		       	break;
		    case 19:
	         	echo "<span class='r_long'>Confirmed - Owner, Short</span>";
	         	$short=1;
		       	break;
		 	case 20:
	         	echo "<span class='r_long'>No confirmed - Owner, Short</span>";
	         	$short=1;
		       	break;
		    case 21:
	         	echo "<span class='r_long'>Checked Out - Owner, Short</span>";
	         	$short=1;
		       	break;
		 	case 22:
	         	echo "<span class='r_long'>Checked in - Owner, Long</span>";
	         	$long=1;
		       	break;
		    case 23:
	         	echo "<span class='r_long'>Confirmed - Owner, Long</span>";
	         	$long=1;
		       	break;
		 	case 24:
	         	echo "<span class='r_long'>No confirmed - Owner, Long</span>";
	         	$long=1;
		       	break;
		    case 25:
	         	echo "<span class='r_long'>Checked Out - Owner, Long</span>";
	         	$long=1;
		       	break;
	       	default:
		       	echo "<span class='negro'><u>Unavailabe</u></span>";
		       	break;
	       } */
	       ?>
		</td>
		</tr>
	<?
    if ($x==0){$x++;} elseif ($x==1){$x--;}
	}?>

 </table>
 <?} else{
 	echo "<h3 class=\"centro\">There is no check out for today</h3>";
 	}
 	?>