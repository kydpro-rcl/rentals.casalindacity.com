
<!--rent invoice / service invoice-->

<p class="header">Printing Long Term invoice</p>
<hr />
<table align="center"><tr><td>
<fieldset><legend>Search booking</legend>
<form method="post" name="" action="invoices_long.php" target="_self" >
<p id="fields" align="right" style="padding-right:5px">Reserve Reference No.: <input type="tex" name="ref" value="<?=$_POST['ref']?>" /></p>
<p align="right" style="padding-right:5px"><input class="book_but" type="submit" name="search" value="Go" /></p>
</form></fieldset>
</td></tr>
<tr><td><p style="color:red; font-weight:bold; font-size:12px; text-align:center"><?=$_GET['error']?></p></td></tr>
</table>

<!--// customers_invoices_print.php//-->

	<? if ( $_POST['search']=="Go"){
            $db=new getQueries();
            $_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
            //echo $_POST['ref'];

			$busy_details=$db->see_occupancy_ref($_POST['ref']);
			$customer_info=$db->customer($busy_details[0]['client']);

			$villa_reserva=$db->villa($busy_details[0]['villa']);

			$payments_date=$db->payments_date($busy_details[0]['reserveid']); //get payments date per long rental
	 //=======================================================================================================
			 if ($busy_details){
			?>
				<? /*echo $busy_details[0]['reserveid']; */ ?>
               <h2 style="text-align:center">Search Result</h2>
             <hr/>


			<table align="center" cellpadding="3" cellspacing="3" >
			<tr bgcolor="#c9dbf3">
				<td style="text-align:center; font-size:10px; font-weight:bold;">
				Status
				</td>
				<td style="text-align:center; font-size:10px; font-weight:bold;">
				Villa No.
				</td>
				<td style="text-align:center; font-size:10px; font-weight:bold;">
				Customer
				</td>
				<td style="text-align:center; font-size:10px; font-weight:bold;">
				From
				</td>
				<td style="text-align:center; font-size:10px; font-weight:bold;">
				To
				</td>
			</tr>

			<tr bgcolor="#c9dbf3">
				<td>
				<?
			       switch ($busy_details[0]['status']){
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
			       } ?>
				</td>
				<td>
				<?=$villa_reserva[0]['no'];?>
				</td>
				<td>
				<?=$customer_info['name']." ".$customer_info['lastname'];?>
				</td>
				<td>
				<?=formatear_fecha($busy_details[0]['start']);?>
				</td>
				<td>
				<?=formatear_fecha($busy_details[0]['end']);?>
				</td>
			</tr></table>

             <table align="center" cellpadding="3" cellspacing="3"><tr><td>
             <fieldset><legend>Printing invoice</legend>
             <form method="post" name="" action="long_invoices_print.php" target="_blank" >
             	<input type="hidden" name="ref" value="<?=$_POST['ref']?>"/>
             	<!--//PAYABLE TO://-->
			    <p>PAYABLE TO:
			     	<select name="payable_to">
			     		<option value="1" selected="selected">The Tenant</option>
			     		<option value="2">Neguen, SRL</option>
			     		<option value="3">RCL Administraciones, SRL.</option>
			     		<option value="4">Owner of the Villa</option>
			     		<?
			     		//only if referal
			     		if ($customer_info['id_commission']>"0"){
				     		?>
				     		<option value="5">Referal Agent</option>
				     		<?
			     		}
			     		//only if referal
			     		?>
			     	</select>
			     	<?
			     		//only if referal
			     		if ($customer_info['id_commission']>"0"){
				     		?>
				     		<input type="hidden" name="referal_id" value="<?=$customer_info['id_commission']?>">
				     		<?
			     		}
			     		//only if referal
			     		?>
		     	</p>
		     	 <p>PAYMENTS:
		     	 <? $pagos_totales=$busy_details[0]['PAYM'];?>
		     	 <input type="hidden" name="pagos_totales" value="<?=$pagos_totales;?>"/>
			     	<select name="numero_de_pago">
			     	<?
			     		for ($x=1; $x<=$pagos_totales; $x++){			     		?>			     		<option value="<?=$x?>" <? if($payments_date[$x-1]['fecha_pago']==date('Y-m-d')) echo "selected=selected";?>><?=$x?> of <?=$pagos_totales?> (<?=formatear_fecha($payments_date[$x-1]['fecha_pago']);?>)</option>
			     		<?}?>
			     	</select>
		     	</p>

			    <!--//PAYABLE TO://-->
             	<p style="text-align:right"><input class="book_but" type="submit" name="print" value="Print" /></p>

             </form></fieldset>
             </td></tr></table>

             <?
            // echo "<pre>";
            // print_r($payments_date);
            // echo "</pre>";
             ?>

	        <?  }else{	        	echo "<p style='text-align:center; color:red; background-color:yellow;'>We sorry, No booking found.</p>" ;	        }	}
	?>

