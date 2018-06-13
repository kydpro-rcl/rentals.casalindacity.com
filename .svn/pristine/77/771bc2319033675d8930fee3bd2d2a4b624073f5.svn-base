<? include('menu_CSS/menu-admin.php');?>
<p class="header">Rental Cars Monthly</p>
<form method="post" action="Rental_cars.php" >
	<p id="fields" style="text-align:center;">Month:
	     <select name="m">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['m']==sp2($i)){?> selected="selected" <?} if(!$_POST){?> <? if(date('m')==sp2($i)){?> selected="selected" <?}}?>  ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>
      Year:
   	<select name="y">
      	<?
      	for($i=(date('Y')-3); $i<=date('Y'); $i++){?>
         <option value="<?=$i?>" <? if($_POST['y']==$i){?> selected="selected" <?} if(!$_POST){?>  <? if(date('Y')==$i){?> selected="selected" <?}}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>

      <input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>

<hr />
<?
/*if ($_POST['referal']) $referal=$_POST['referal'];
if ($_GET['re']) $referal=$_GET['re']; */
/*$referal='79';*//*id belong to referral Expedia.com */
?>

 <?/* if ($referal){*/?>
<?php
       $data= new getQueries ();

		//$bookings_found=$data->bookings_referal($referal);//show bookings per referals
		if(!$_POST){$_POST['m']=date('m'); $_POST['y']=date('Y');}
		/*$bookings_found=$data->booking_per_months_referral($month=$_POST['m'], $year=$_POST['y'], $id_referral='79'); */
		$bookings_found=$data->bookings_with_rentalcars($month=$_POST['m'], $year=$_POST['y']);
		$total_records=$data->getAffectedRows();
		/*echo '<pre>';
         print_r($bookings_found);
         echo '</pre>';*/
		?>

      <? if ($bookings_found){
      /*	echo $total_records;      		echo "<pre>";
            print_r($bookings_found);
            echo "</pre>"; */

      ?>
		<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total Vehicles Rented: <?=$total_records?></strong></p>
		<!--//(anterior) mes mostrando (proximo)//-->
		<hr />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">
			<tr class="title">
				<td class='centro' id="td">
					RCL REF.
				</td>
				<td class='centro' id="td">
					DATE
				</td>
				<td class='centro' id="td">
					STATUS
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
					PRICES CARS
				</td>
				<td class='centro' id="td">
					DAYS CARS
				</td>
				<!--//<td class='centro' id="td">
					AMOUNT CARS
				</td>//-->
			</tr>
		<?php

		$x=0;
		$General_Totals=0;
		$expedia_totals=0;
		$expedia_payable=0;
		foreach ($bookings_found as $k){
         //=========================EXPEDIA============================================
     		$link= new getQueries();
		    $expedia=$link->show_any_data_limit1('expedia', 'rcl_ref', $k['ref'], '=');
		    $exp=$expedia[0];
           //------------------------------------------------------------------------------
        ?>

		<tr class='fila<?=$x;?>'  onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';" >
           <td id='td' class='derecha' style="font-size:8px;" onclick="reserva('reserva_details.php?id=<?=$k['reserveid']?>','Details for Selection', 530, 800)"><a href="#" alt="" title=""><?=$k['ref']?></a></td>
           <td><?=$k['date']?></td>
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
           <td id='td' class='derecha' style="font-size:8px;"><?=$status_result?></td>

           <?/* $db= new getQueries ();*/
          /* $referal_d=$db->show_id("commission", $k['id_referal']);*/
           ?>
             <? $db= new getQueries ();
           $client_d=$db->show_id("customers", $k['client']);
           ?>
             <td id='td' class='derecha'><? echo  $client_d[0]['name']." ". $client_d[0]['lastname'];?></td>
			<? $db= new getQueries ();
           $villa_d=$db->show_id("villas", $k['villa']);

            if($k['status']!=0){/* efectuar cuando no esta cancelado el booking*/
           	$total_cars_days+=$k['qty_days'];
		 	$total_cars_prices+=$k['car_price'];
            $days_in_cars=$k['qty_days'];
            $prices_in_car=$k['car_price'];
           }

           ?>
              <td id='td' class='derecha'><? echo  $villa_d[0]['no'];?></td>

               <td id='td' class='derecha'><?=date('m/d/Y',strtotime($k['start']))?></td>
                <td id='td' class='derecha'><?=date('m/d/Y',strtotime($k['end']))?></td>
                <td id='td' class='derecha'><?=number_format($prices_in_car,2);?></td>
                <td id='td' class='derecha'><?=$days_in_cars;?></td>
                <!--//<td><?=$k['car_taxes']?></td>//-->
             </tr>


         <?
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		 /*$referal_id=$k['id_referal']; */

		}
		//.utf8_encode($k['lastname'])
		?>

		<tr class='fila<?=$x;?>'><td colspan="7" class='derecha' style="font-weight:bold;">Total</td><td class='derecha' style="font-weight:bold;"><?=number_format($total_cars_prices,2);?></td>
		<td class='derecha' style="font-weight:bold;"><?=$total_cars_days;?></td>
		<td>&nbsp;</td>
		</tr>
		<!--//<tr class='fila<?=$x;?>'><td colspan="7" class='derecha' style="font-weight:bold; color:green;text-transform:uppercase;">Total payable from Expida.com</td>
		<td class='derecha' colspan="2" style="font-weight:bold;text-align:center;color:green;"> USD <?=number_format($expedia_payable,2);?></td>
		<td>&nbsp;</td>
		</tr>//-->
		</table>
       <p>
       	<!--//<form method="post" name="" action="#" target="_blank">
         <input type="hidden" name="referal_id" value="<?=$referal?>"/>
         <input type="hidden" name="month" value="<?=$_POST['m']?>"/>
         <input type="hidden" name="year" value="<?=$_POST['y']?>"/>
         <input class="book_but" type="submit" name="imprimir" value="Print bill report"/>
       	</form>//-->
       </p>
	  <?}else{        echo "<p style='text-align:center; color:red; font-size:16px;'>There is not bookings with rental cars on the selected date.</p>";	  }?>

 <? /*}*/?>