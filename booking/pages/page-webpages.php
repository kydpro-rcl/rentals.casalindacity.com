<p class="header">Search bookings per URL</p>
<form method="post" action="webpages.php" >
	<p id="fields" style="text-align:center;">Web Address (URL):<?
	$data= new getQueries ();
  	//$commisioners=$data->show_all('commission', 'id');
	?>
	<!--//<select class='input' size=1 name='referal' onchange="window.location='search_bookings_referal.php?re='+this.value">//-->
	<?/*
	foreach($commisioners as $k){
	?>
	    <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_GET['re']==$k['id'])) echo "selected='selected'"; ?> ><?=$k['name']." ".$k['lastname'];?></option>
	    <?
		}
		echo "</select>";
	*/?>
	<input type="text" name="url" value="<?=$_POST['url']?>"/>
	<input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>

<hr />
<?
if ($_POST['url']) $url=$_POST['url'];
//if ($_GET['re']) $referal=$_GET['re'];
?>

 <? if ($url){?>
<?php


		$bookings_found=$data->bookings_url($url);//show bookings per referals
		$total_records=$data->getAffectedRows();

		?>

      <? if ($bookings_found){

      ?>
		<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total bookings found: <?=$total_records?></strong></p>
		<hr />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">

			<tr class="title">
				<td class='centro' id="td">

					BOOKING REFERENCE

				</td>
				<td class='centro' id="td">

					STATUS

				</td>
				<td class='centro' id="td">

					WEBSITE

				</td>
				<td class='centro' id="td">

					CLIENT

				</td>
				<td class='centro' id="td">

					VILLA

				</td>
				<td class='centro' id="td">

					FROM

				</td>
				<td class='centro' id="td">

					TO

				</td>
				<td class='centro' id="td">

					TOTAL USD

				</td>
				<td class='centro' id="td">

					COMMISION

				</td>
			</tr>
		<?php

		$x=0;
		$General_Totals=0;
		foreach ($bookings_found as $k){

		//echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"onmouseout=\"this.style.backgroundColor=''\" onclick=\"location.href='view-clients-details.php?id=".$k['id']."'\" >
        ?>

		<tr class='fila<?=$x;?>'  >
           <td id='td' class='derecha'><?=$k['ref']?></td>
		       <?
		       switch ($k['status']){
		       	case 0:
		         	$status_result="<span style='color:red'>Cancelled</span>";
			       	break;
		       	case 1:
		         	$status_result="<span class='azul2'>Checked in - Short</span>";
			       	break;
			    case 2:
		         	$status_result="<span class='azul2'>Confirmed - Short</span>";
			       	break;
			    case 3:
		         	$status_result= "<span class='morado'>No Confirmed - Short </span>";
			       	break;
				case 4:
		         	$status_result= "<span class='outck'>Checked out - Short</span>";
			       	break;
			    case 5:
		         	$status_result= "<span style='color:red'>Maintenance (out of service)</span>";
			       	break;
			   case 6:
		         	$status_result= "<span class='r_vip'>Checked in - VIP, Short</span>";
			       	break;
			    case 7:
		         	$status_result= "<span class='r_owner'>Checked in - Owner, Short</span>";
			       	break;
			    case 8:
		         	$status_result= "<span class='r_long'>Checked in - Long</span>";
			       	break;
			    case 9:
		         	$status_result= "<span class='r_long'>Confirmed - Long</span>";
			       	break;
			 	case 10:
		         	$status_result= "<span class='r_long'>No Confirmed - Long</span>";
			       	break;
			    case 11:
		         	$status_result= "<span class='r_long'>Checked Out - Long</span>";
			       	break;
			 	case 12:
		         	$status_result= "<span class='r_vip'>Confirmed - VIP, Short</span>";
			       	break;
			    case 13:
		         	$status_result= "<span class='r_vip'>No Confirmed - VIP, Short</span>";
			       	break;
			 	case 14:
		         	$status_result= "<span class='r_vip'>Checked Out - VIP, Short</span>";
			       	break;
			    case 15:
		         	$status_result= "<span class='r_vip'>Checked in - VIP, Long</span>";
			       	break;
			 	case 16:
		         	$status_result= "<span class='r_vip'>Confirmed - VIP, Long</span>";
			       	break;
			    case 17:
		         	$status_result= "<span class='r_vip'>No Confirmed - VIP, Long</span>";
			       	break;
			 	case 18:
		         	$status_result= "<span class='r_vip'>Checked Out - VIP, Long</span>";
			       	break;
			    case 19:
		         	$status_result= "<span class='r_long'>Confirmed - Owner, Short</span>";
			       	break;
			 	case 20:
		         	$status_result= "<span class='r_long'>No confirmed - Owner, Short</span>";
			       	break;
			    case 21:
		         	$status_result= "<span class='r_long'>Checked Out - Owner, Short</span>";
			       	break;
			 	case 22:
		         	$status_result= "<span class='r_long'>Checked in - Owner, Long</span>";
			       	break;
			    case 23:
		         	$status_result= "<span class='r_long'>Confirmed - Owner, Long</span>";
			       	break;
			 	case 24:
		         	$status_result= "<span class='r_long'>No confirmed - Owner, Long</span>";
			       	break;
			    case 25:
		         	$status_result= "<span class='r_long'>Checked Out - Owner, Long</span>";
			       	break;
		       	default:
			       $status_result= "<span class='negro'><u>Unavailabe</u></span>";
			       	break;
		       }
		       ?>
           <td id='td' class='derecha'><?=$status_result?></td>

           <? /*$db= new getQueries ();
           $referal_d=$db->show_id("commission", $k['id_referal']);*/
           ?>
           <td id='td' class='derecha'><?=$k['url'];?><?/* echo $referal_d[0]['name']." ".$referal_d[0]['lastname'];*/?></td>

             <? $db= new getQueries ();
           $client_d=$db->show_id("customers", $k['client']);

           ?>
             <td id='td' class='derecha'><? echo  $client_d[0]['name']." ". $client_d[0]['lastname'];?></td>

			<? $db= new getQueries ();
           $villa_d=$db->show_id("villas", $k['villa']);
           $total_booking=$k['subtotal']-$k['itbis'];
           $General_Totals+=$total_booking;//sum this booking to total
           ?>
              <td id='td' class='derecha'><? echo  $villa_d[0]['no'];?></td>

               <td id='td' class='derecha'><?=formatear_fecha($k['start']);?></td>
                <td id='td' class='derecha'><?=formatear_fecha($k['end']);?></td>
                <td id='td' class='derecha'><?=number_format($total_booking,2);?></td>
                <td id='td' class='derecha'><?=number_format($total_booking*$referal_d[0]['percent'],2);?></td>
             </tr>


         <?
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		 $referal_id=$k['id_referal'];
		}
		//.utf8_encode($k['lastname'])
		?>
		<tr><td colspan="7" class='derecha' style="font-weight:bold;"><!--//General Total=  USD //--></td><td class='derecha' style="font-weight:bold;"><?/*=number_format($General_Totals,2);*/?></td><td>&nbsp;</td></tr>
		<tr><td colspan="7" class='derecha' style="color:green;"><?/*=$referal_d[0]['percent']*100*/?><!--// % of //--><?/*=number_format($General_Totals,2);*/?><!--// =  USD //--></td><td class='derecha' style="color:green;"><?/*=number_format($General_Totals*$referal_d[0]['percent'],2);*/?></td><td>&nbsp;</td></tr>
		</table>
       <p>
       	<form method="post" name="" action="print_bookings_referal.php" target="_blank">
         <input type="hidden" name="referal_id" value="<?/*=$referal_id*/?>"/>
         <!--//<input class="book_but" type="submit" name="imprimir" value="Print this report"/>//-->
       	</form>
       </p>
	  <?}else{        echo "<p style='text-align:center; color:red; font-size:16px;'>There is not bookings for this Referal.</p>";
	  }?>

 <? }?>