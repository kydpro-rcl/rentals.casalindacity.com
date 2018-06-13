<? include('menu_CSS/menu-admin.php');?>

 <? if (!$_GET['date']){?>
	<h2>Result of activities for today <span style="font-size:10px; color:blue;"><a href="last-activities.php?date=yes" alt="Go to a different date" title="Go to a different date">Search a date</a></span></h2>
<?}?>

	<? if ($_GET['date']=="yes"){?>
	<form method="post" name="date" action="">
	 <p class="centro" style="font-weight:bold;">DATE <span style="font-size:9px; font-weight:bold; color:blue;">(YYYY-MM-DD)</span>
	 		<input type="text" name="date" size="10" value="<?=$_POST['date']?>"/>
			<input type="submit" name="go" value="Search" class="book_but"/> <span style="font-size:10px; color:blue;"><a href="last-activities.php" alt="Go to today" title="Go to today">Go to Today</a></span></p>
	</form>
	<?}?>
<hr/>

<?php
$data= new getQueries ();


//$date=('2010-05-04');
	if (!$_POST['date']){
		$date=date('Y-m-d');
	}else{
		$date=trim($_POST['date']);
	}

?>

<!--############################BELOW A NEW REPORT FOR BOOKING MADE TODAY#########################-->

<?
  if (!validate_date($date)){
	   echo "<p class='error centro'>Invalid date</p>";
  }else{
  	$validar_fecha=is_date($date);
  	 if ($validar_fecha){
		$booked=$data->see_occupancy_date($date);
		$total_booked=$data->getAffectedRows();

		if ($total_booked >= 1){?>
		<p id="small_title_p">Bookings created (<?=$total_booked?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">VILLA</td><td class="title">FROM</td><td class="title">TO</td><td class="title">REF</td><td class="title">STATUS</td><td class="title">CREATED BY</td><td class="title">DATE</td></tr>

			<?
			$x=0;
			$link= new DB();
			//print_r($booked);
			foreach ($booked as $b){
			 $villa=$data->villa($b['villa']);
			 echo "<tr onmouseover=\"this.style.backgroundColor='#87a2fa';this.style.cursor='hand';this.style.cursor='pointer'; \"onmouseout=\"this.style.backgroundColor=''\" onclick=\"reserva('reserva_details.php?id=".$b['busyid']."','Details for Selection', 570, 820)\" class='fila$x'><td>".$villa[0]['no']."</td><td>".$b['start']."</td><td>".$b['end']."</td><td>".$b['ref']."</td>";
             echo '<td>'.booking_status($b['status']).'</td>';

			/* switch ($b['status']){
		       	case 0:
		         	echo "<td><span style='color:red'><u>Cancelled</u></span></td>";
			       	break;
		       	case 1:
		         	echo "<td><span class='verde'><u>Checked in</u></span></td>";
			       	break;
			    case 2:
		         	echo "<td><span class='azul2'><u>Confirmed</u></span></td>";
			       	break;
			    case 3:
		         	echo "<td><span class='morado'><u>Transit</u></span></td>";
			       	break;
				case 4:
		         	echo "<td><span class='outck'><u>Checked out</u></span></td>";
			       	break;
			    case 5:
		         	echo "<td><span style='color:red'><u>Maintenance (out of service)</u></span></td>";
			       	break;
			   case 6:
		         	echo "<td><span class='r_vip'>VIP Rental</span></td>";
			       	break;
			    case 7:
		         	echo "<td><span class='r_owner'>Owner in house</span></td>";
			       	break;
			    case 8:
		         	echo "<td><span class='r_long'>Long Term Rental</span></td>";
			       	break;
		       	default:
			       	echo "<td><span class='negro'><u>Unavailabe</u></span></td>";
			       	break;
		       }  */
			//echo "<td>".$b['status']."</td>";

			 $made=$link->getUserDetails($b['adm']);

			echo "<td>".$made[0]['name']."</td>";

			echo "<td>".$b['date']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>



		<!--############################BELOW A NEW REPORT FOR BOOKING CHANGED TODAY#########################-->

		<?
		$booked_mod=$data->see_occupancy_mod_date($date);
		$total_booked_mod=$data->getAffectedRows();

		if ($total_booked_mod >= 1){?>
		<p id="small_title_p">Bookings modified (<?=$total_booked_mod?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">VILLA</td><td class="title">FROM</td><td class="title">TO</td><td class="title">REF</td><td class="title">STATUS</td><td class="title">MODIFIED BY</td><td class="title">DATE</td></tr>

			<?
			$x=0;
			$link= new DB();
			foreach ($booked_mod as $bm){
			$villa=$data->villa($bm['villa']);
			echo "<tr onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" onclick=\"reserva('reserva_details.php?id=".$bm['busyid']."','Details for Selection', 570, 820)\" class='fila$x'><td>".$villa[0]['no']."</td><td>".$bm['start']."</td><td>".$bm['end']."</td><td>".$bm['ref']."</td>";

			 echo '<td>'.booking_status($bm['status']).'</td>';
			 /*
			switch ($bm['status']){
		       	case 0:
		         	echo "<td><span style='color:red'><u>Cancelled</u></span></td>";
			       	break;
		       	case 1:
		         	echo "<td><span class='verde'><u>Checked in</u></span></td>";
			       	break;
			    case 2:
		         	echo "<td><span class='azul2'><u>Confirmed</u></span></td>";
			       	break;
			    case 3:
		         	echo "<td><span class='morado'><u>Transit</u></span></td>";
			       	break;
				case 4:
		         	echo "<td><span class='outck'><u>Checked out</u></span></td>";
			       	break;
			    case 5:
		         	echo "<td><span style='color:red'><u>Maintenance (out of service)</u></span></td>";
			       	break;
			   case 6:
		         	echo "<td><span class='r_vip'>VIP Rental</span></td>";
			       	break;
			    case 7:
		         	echo "<td><span class='r_owner'>Owner in house</span></td>";
			       	break;
			    case 8:
		         	echo "<td><span class='r_long'>Long Term Rental</span></td>";
			       	break;
		       	default:
			       	echo "<td><span class='negro'><u>Unavailabe</u></span></td>";
			       	break;
		       }  */

			 $made=$link->getUserDetails($bm['adm']);

			echo "<td>".$made[0]['name']."</td>";

			echo "<td>".$bm['date']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>
        <!--############################BELOW A NEW REPORT FOR BOOKING CANCELLED #########################-->

		<?
		$cancelled_book=$data->show_any_data('cancelled_books', 'date', $date."%", 'LIKE');
		$total_cancelled=$data->getAffectedRows();

		if ($total_cancelled >= 1){?>
		<p id="small_title_p">Booking Cancelled (<?=$total_cancelled?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">REF</td><td class="title">REASONS</td><td class="title">DATE</td><td class="title">USER</td></tr>

			<?
			$x=0;
			$link= new DB();
			foreach ($cancelled_book as $bc){
			 echo "<tr onmouseover=\"this.style.backgroundColor='#87a2fa';this.style.cursor='hand';this.style.cursor='pointer'; \"onmouseout=\"this.style.backgroundColor=''\" onclick=\"reserva('reserva_details.php?id=".$bc['busyid']."','Details for Selection', 570, 820)\" class='fila$x'><td>".$bc['ref']."</td><td>".$bc['reasons']."</td><td>".$bc['date']."</td>";

			 $made=$link->getUserDetails($bc['id_adm']);

			echo "<td>".$made[0]['name']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>

		<!--############################BELOW A  REPORT FOR CLIENTS CREATED TODAY #########################-->
		<?
		//echo $date;
		$client=$data->show_a_date('customers', $date);
		$total_clients_today=$data->getAffectedRows();

		if ($total_clients_today >= 1){?>
		<p id="small_title_p">Customers created (<?=$total_clients_today?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">NO</td><td class="title">NAME</td><td class="title">DATE</td><td class="title">CREATED BY</td></tr>

			<?
			$x=0;
			$link= new DB();
			foreach ($client as $c){
			 echo "<tr class='fila$x'><td>".$c['id']."</td><td>".$c['name']." ".$c['lastname']."</td><td>".$c['date']."</td>";

			 $made=$link->getUserDetails($c['id_adm']);

			echo "<td>".$made[0]['name']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>

		<!--############################BELOW A NEW REPORT FOR CHANGE MADE ON CUSTOMERS #########################-->

		<?
		$client_mod=$data->show_any_data('customers_mod', 'date_mod', $date."%", 'LIKE');
		$total_clients_mod=$data->getAffectedRows();

		if ($total_clients_mod >= 1){?>
		<p id="small_title_p">Customers modified (<?=$total_clients_mod?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">NO</td><td class="title">NAME</td><td class="title">DATE</td><td class="title">MODIFIED BY</td></tr>

			<?
			$x=0;
			$link= new DB();
			foreach ($client_mod as $cm){
			 echo "<tr   class='fila$x'><td>".$cm['id_cust_mod']."</td><td>".$cm['name']." ".$cm['lastname']."</td><td>".$cm['date_mod']."</td>";

			 $made=$link->getUserDetails($cm['id_adm_mod']);

			echo "<td>".$made[0]['name']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>
		<!--############################BELOW A NEW REPORT FOR INVOICES PRINTED TODAY #########################-->
		<?php

			$invoices=$data->show_any_data('invoice', 'date', $date."%", 'LIKE ');
			//$total_records=$data->getAffectedRows();?>

			<? if (!empty($invoices)){?>
		    <p id="small_title_p">Invoices printed (<?=$total_ckout?>) </p>

				<table  align="center" cellpadding="2" cellspacing="2" border="0"><tr class="title"><tr class="title"><td class='centro' id="td">REFERENCE</td><td class='centro' id="td">FILE</td><td class='centro' id="td">PRINTED BY</td><td class='centro' id="td">DATE</td><td class='centro' id="td">INVOICE NO.</td><td class='centro' id="td">TYPE</td></tr>

				<?
				$x=0;
				$link= new DB();
				foreach ($invoices as $k){
				#echo $customers['4']['name'];
				echo "<tr class='fila$x'  onmouseover=\"this.style.backgroundColor='#87a2fa'; \"onmouseout=\"this.style.backgroundColor=''\" >
				<td id='td'>".$k['ref']."</td>".
				"<td id='td'><a href=\"".$k['src']."\" alt=\"".$k['src']."\" title=\"".$k['src']."\" target=\"_blank\">click to view</a></td>";

				 $made=$link->getUserDetails($k['id_adm']);

				echo "<td>".$made[0]['name']."</td>";

				echo "<td>".$k['date']."</td>";

				echo "<td>".$k['fact_no']."</td>";


					if ($k['type']==1){
						echo "<td class='centro' style='color:green;'  id='td'>check in</td>";
					}elseif($k['type']==2){
						echo "<td class='centro' id='td'>check out</td>";
					}

				if ($x==0){$x++;} elseif ($x==1){$x--;}
				}

				?>
				</table>

			<? }?>
		<!--############################BELOW A NEW REPORT FOR CHECK IN #########################-->

		<?
		$ckin=$data->show_any_data('checkin', 'fecha', $date."%", 'LIKE ');
		$total_ckin=$data->getAffectedRows();

		if ($total_ckin >= 1){?>
		<p id="small_title_p">Checked in (<?=$total_ckin?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">ID</td><td class="title">REF</td><td class="title">DATE</td><td class="title">IN BY</td></tr>

			<?
			$x=0;
			$link= new DB();
			foreach ($ckin as $cki){
			 echo "<tr class='fila$x'><td>".$cki['id']."</td><td>".$cki['reser_no']."</td><td>".$cki['fecha']."</td>";

			 $made=$link->getUserDetails($cki['id_adm']);

			echo "<td>".$made[0]['name']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>

		<!--############################BELOW A NEW REPORT FOR CHECK OUT #########################-->

		<?
		$ckout=$data->show_any_data('checkout', 'fecha', $date."%", 'LIKE ');
		$total_ckout=$data->getAffectedRows();

		if ($total_ckout >= 1){?>
		<p id="small_title_p">Check out (<?=$total_ckout?>) </p>
			<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="title">ID</td><td class="title">REF</td><td class="title">DATE</td><td class="title">OUT BY</td></tr>

			<?
			$x=0;
			$link= new DB();
			foreach ($ckout as $co){
			 echo "<tr class='fila$x'><td>".$co['id']."</td><td>".$co['reser_no']."</td><td>".$co['fecha']."</td>";

			 $made=$link->getUserDetails($co['id_adm']);

			echo "<td>".$made[0]['name']."</td></tr>";

			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 }
		}

		?>
		</table>

  <?



            if((!$booked)&&(!$booked_mod)&&(!$client)&&(!$client_mod)&&(!$invoices)&&(!$ckin)&&(!$ckout)&&(!$cancelled_book))  echo "<p style='color:blue;'>There is not activities for ".formatear_fecha($date)."</p>";





     }else{
        echo "<p class='error centro'>We sorry, Wrong date</p>";
     }

  }?>