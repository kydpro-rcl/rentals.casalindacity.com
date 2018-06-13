<!--Data picker-->
		<script type="text/javascript" src="../data_todos_mes/js/datepicker.js"></script>
        <link href="../data_picker/css/demo.css"       rel="stylesheet" type="text/css" />
        <link href="../data_picker/css/datepicker.css" rel="stylesheet" type="text/css" />

		<!--<script type="text/javascript">
//<![CDATA[

/*
        A "Reservation Date" example using two datePickers
        --------------------------------------------------

        * Functionality

        1. When the page loads:
                - We clear the value of the two inputs (to clear any values cached by the browser)
                - We set an "onchange" event handler on the startDate input to call the setReservationDates function
        2. When a start date is selected

                - We set the low range of the endDate datePicker to be the start date the user has just selected
                - If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value

        * Caveats (aren't there always)

        - This demo has been written for dates that have NOT been split across three inputs

*/

function makeTwoChars(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
}

function initialiseInputs() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "";
        document.getElementById("ed").value = "";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
}

var initAttempts = 0;

function setReservationDates(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)

        try {
                var sd = datePickerController.getDatePicker("sd");
                var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
                if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
                return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if(dt == 0) return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow( dt );

        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if(edv < dt) {
                document.getElementById("ed").value = "";
        }
}

function removeInputEvents() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
}

datePickerController.addEvent(window, 'load', initialiseInputs);
datePickerController.addEvent(window, 'unload', removeInputEvents);

//]]>
</script>-->
<!--Data Picker-->
 <?

 if ($_GET['sort']){
 	$_SESSION['value']['sort']=$_GET['sort'];

 }

 if ($_GET['paid']){
 	$_SESSION['value']['paid']=$_GET['paid'];

 }

 if ($_GET['act']){
 	$_SESSION['value']['act']=$_GET['act'];
  }


 ?>

<h2>Welcome, <?=$_SESSION['referal']['name']." ".$_SESSION['referal']['lastname']?></h2>
<p style="clear:both; text-align:left;">By using this portal you agree to the RAP Rules of Residencial Casa Linda, <a href="https://docs.google.com/document/d/1UPH8yAoy1ke_TkiNvyT3QHvDCYmw278DM4vcnRYSbqk/edit?usp=sharing" target="_blank">See Here</a></p>


<p style="clear:both;">&nbsp;</p>



		<hr />


<?
 if ((trim ($_POST['desde']!="")) && (trim ($_POST['hasta']))){

     $_SESSION['value']['from']=$_POST['desde']; $_SESSION['value']['to']=$_POST['hasta'];

     echo   "<p>Showing from <strong>".$_POST['desde']."</strong> to <strong>". $_POST['hasta']."</strong></p>";
 }else{
 	if ($_POST){
 	 unset($_SESSION['value']['from']);
 	 unset($_SESSION['value']['to']);
 	}

 }
 /*
echo $_SESSION['value']['from'];
echo $_SESSION['value']['to'];
 */
$referal=$_SESSION['referal']['id'];

?>

 <? if ($referal){?>


      <? if (($_SESSION['value']['act']==1)||(!$_SESSION['value']['act'])){?> <b>Recent Activity</b> <?}else{?><a style="margin-left:15px;" href="home_overview.php?act=1">Recent Activity</a> <?}?>  | <? if ($_SESSION['value']['act']==2){?> <b>All Activity</b> <?}else{?><a style="margin-left:15px;" href="home_overview.php?act=2">All Activity</a> <?}?>   <span style="margin-left:35px;">
       Sort by: <select name="sort" onchange="window.location='home_overview.php?sort='+this.value" >
       		<option value="1" <? if ($_SESSION['value']['sort']==1) echo 'selected="selected"'; ?> >Date</option>
       		<option value="2" <? if ($_SESSION['value']['sort']==2) echo 'selected="selected"'; ?> >Client</option>
       		<option value="3" <? if ($_SESSION['value']['sort']==3) echo 'selected="selected"'; ?> >Reference</option>
       		<option value="4" <? if ($_SESSION['value']['sort']==4) echo 'selected="selected"'; ?> >Status</option>
       		<option value="5" <? if ($_SESSION['value']['sort']==5) echo 'selected="selected"'; ?> >Amount</option>
       	</select>
   </span>
   <span style="margin-left:35px;">
       Payment Status Show: <select name="paid" onchange="window.location='home_overview.php?paid='+this.value">
       		<option value="1" <? if ($_SESSION['value']['paid']==1) echo 'selected="selected"'; ?> >All</option>
       		<option value="2" <? if ($_SESSION['value']['paid']==2) echo 'selected="selected"'; ?> >In process</option>
       		<option value="3" <? if ($_SESSION['value']['paid']==3) echo 'selected="selected"'; ?> >Cancelled</option>
       		<option value="4" <? if ($_SESSION['value']['paid']==4) echo 'selected="selected"'; ?> >Ready to pickup</option>
       		<option value="5" <? if ($_SESSION['value']['paid']==5) echo 'selected="selected"'; ?> >Paid</option>
       		<option value="6" <? if ($_SESSION['value']['paid']==6) echo 'selected="selected"'; ?> >UnPaid</option>
       	</select>
   </span>

   <?php

/*echo $url_gets;*/

       $data= new getQueries();
      /*
      if ((trim ($_POST['desde']!="")) && (trim ($_POST['hasta']))){
        $bookings_found=$data->bookings_referal_dates($referal,$from, $to);//show bookings per referals
	  }else{
		$bookings_found=$data->bookings_referal($referal);//show bookings per referals
	  }   */

     if (!$_SESSION['value']){   //si no hay elecciones para organizar
     	$sql="";
        $sort="`busy`.`starting`";
		$bookings_found=$data->bookings_referal_overview_15($referal, $sql, $sort);  //muestra organizado por fechas 10
     }else{
        if ((!$_SESSION['value']['act'])||($_SESSION['value']['act']==1)){   //gets only ten activities
	       	switch($_SESSION['value']['sort']){
	       		case 1: $sort="`busy`.`starting`";//date
	       				break;
	       		case 2: $sort="`booked`.`id_client`";//client
	       				break;
	       		case 3: $sort="`booked`.`ref`"; //Reference
	       				break;
	       		case 4: $sort="`booked`.`status`";//Status
	       				break;
	       		case 5: $sort="`booked`.`amount`";//Amount
	       				break;
	       		default : $sort="`busy`.`starting`";//date
                         break;
	       	}

	       	switch($_SESSION['value']['paid']){
	       		case 1: $sql="";//all
	       				break;
	       		case 2: $sql="AND `booked`.`status`<>0  AND `booked`.`status`<>4 AND `referred`.`paid`=0";//in process
	       				break;
	       		case 3: $sql="AND `booked`.`status`=0"; //cancelled
	       				break;
	       		case 4: $sql="AND `referred`.`paid`=1";//ready to pickup
	       				break;
	       		case 5: $sql="AND `referred`.`paid`=2";//paid
	       				break;
	       		case 6: $sql="AND `booked`.`status`=4 AND `referred`.`paid`=0";//unpaid
	       				break;
	       		default : $sql="";//all
                         break;
	       	}

			if (($_SESSION['value']['from']!="")&&($_SESSION['value']['to']!="")) {
				$fecha_e=explode('/', trim($_SESSION['value']['from']));
			    $fecha_t=explode('/', trim($_SESSION['value']['to']));

			    $_POST['ddlStartYear']=$fecha_e[2];$_POST['ddlStartMonth']=$fecha_e[0];$_POST['ddlStartDay']=$fecha_e[1];
			    $_POST['ddlEndYear']=$fecha_t[2];$_POST['ddlEndMonth']=$fecha_t[0];$_POST['ddlEndDay']=$fecha_t[1];

			 //--------------------------------------------------------------------------------------------------------------------------
			    $empieza=$_POST['ddlStartYear']."-".$_POST['ddlStartMonth']."-".$_POST['ddlStartDay'];   //join starting date as string
			    $termina=$_POST['ddlEndYear']."-".$_POST['ddlEndMonth']."-".$_POST['ddlEndDay'];        //join ending date as string
			   	$desde=date('Y-m-d',(strtotime($empieza)));
	            $hasta=date('Y-m-d',(strtotime($termina)));
			  if ((is_date($desde)) && (is_date($hasta))){

	             $sql.=" AND  `busy`.`date`>=".$empieza." AND  `busy`.`date`<=".$termina;
	          }else{
	          	echo "<span style='color:red; background-color:yellow'>Error on dates</span>";
	          }
			}


			$bookings_found=$data->bookings_referal_overview_15($referal, $sql, $sort);  //muestra organizado por fechas 10
        }elseif($_SESSION['value']['act']==2){//gets all activities
	        	switch($_SESSION['value']['sort']){
	       		case 1: $sort="`busy`.`date`";//date
	       				break;
	       		case 2: $sort="`booked`.`id_client`";//client
	       				break;
	       		case 3: $sort="`booked`.`ref`"; //Reference
	       				break;
	       		case 4: $sort="`booked`.`status`";//Status
	       				break;
	       		case 5: $sort="`booked`.`amount`";//Amount
	       				break;
	       		default : $sort="`busy`.`starting`";//date
                         break;
	       	}

	       	switch($_SESSION['value']['paid']){
	       		case 1: $sql="";//all
	       				break;
	       		case 2: $sql="AND `booked`.`status`<>0 AND `booked`.`status`<>4 AND `referred`.`paid`=0";//in process
	       				break;
	       		case 3: $sql="AND `booked`.`status`=0"; //cancelled
	       				break;
	       		case 4: $sql="AND `referred`.`paid`=1";//ready to pickup
	       				break;
	       		case 5: $sql="AND `referred`.`paid`=2";//paid
	       				break;
	       		case 6: $sql="AND `booked`.`status`=4 AND `referred`.`paid`=0";//unpaid
	       				break;
	       		default : $sql="";//all
                         break;
	       	}

			if (($_SESSION['value']['from']!="")&&($_SESSION['value']['to']!="")) {
				$fecha_e=explode('/', trim($_SESSION['value']['from']));
			    $fecha_t=explode('/', trim($_SESSION['value']['to']));

			    $_POST['ddlStartYear']=$fecha_e[2];$_POST['ddlStartMonth']=$fecha_e[0];$_POST['ddlStartDay']=$fecha_e[1];
			    $_POST['ddlEndYear']=$fecha_t[2];$_POST['ddlEndMonth']=$fecha_t[0];$_POST['ddlEndDay']=$fecha_t[1];

			 //--------------------------------------------------------------------------------------------------------------------------
			    $empieza=$_POST['ddlStartYear']."-".$_POST['ddlStartMonth']."-".$_POST['ddlStartDay'];   //join starting date as string
			    $termina=$_POST['ddlEndYear']."-".$_POST['ddlEndMonth']."-".$_POST['ddlEndDay'];        //join ending date as string
			   	$desde=date('Y-m-d',(strtotime($empieza)));
	            $hasta=date('Y-m-d',(strtotime($termina)));
			  if ((is_date($desde)) && (is_date($hasta))){

	             $sql.=" AND  `busy`.`date`>=".$empieza." AND  `busy`.`date`<=".$termina;
	          }else{
	          	echo "<span style='color:red; background-color:yellow'>Error on dates</span>";
	          }
			}

			$bookings_found=$data->bookings_referal_overview($referal, $sql, $sort);  //muestra organizado por fechas 10
        }

     }
		$total_records=$data->getAffectedRows();

		?>
		<form method="post" id="bookform" name="dates" action="home_overview.php" >
         <input type="hidden" name="referal_id" value="<?=$referal_id?>"/>
        <p style="text-align:left; margin-left:17px;">Show from:
         <input type="text" name="desde" class="w8em format-m-d-y highlight-days-67 range-low-today" value="<?=$_POST['desde'];?>" id="sd"/> To:  <input type="text" name="hasta" value="<?=$_POST['hasta'];?>" class="w8em format-m-d-y highlight-days-67 range-low-today" id="ed" />
        <input type="submit" name="sort" value="Show"/> </p>
</form>
       	<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total bookings found: <?=$total_records?></strong><span style="color:green; font-size:11px; text-transform:uppercase;"> <a style="margin-left:35px; margin-right:15px;" href="#" onclick="javascript:window.print()">Print</a> <a href="export_overview_excel.php">Export to Excel</a></span>  </p>

      <? if ($bookings_found){

      ?>

		<table  align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
			<tr class="title" style="background-color:#dfdfdf;">
				 <td class='centro' id="td" style="text-align:center;">
					Checkin
				</td>
				 <td class='centro' id="td" style="text-align:center;">
					CLIENT
				</td>
				<td class='centro' id="td" style="text-align:center;">
                   REF. NO.
				</td>
				<td class='centro' id="td" style="text-align:center;">
                   BOOKING
				</td>
				<td class='centro' id="td" style="text-align:center;">
					TATUS
				</td>
				<td class='centro' id="td" style="text-align:center;">
					DETAILS
				</td>
				<td class='centro' id="td" style="text-align:center;">
					DISCOUNT
				</td>
				<td class='centro' id="td" style="text-align:center;">
					COMMISSION
				</td>
			</tr>
		<?php

		$x=0;
		//$General_Totals=0;
		//print_r($bookings_found);
		foreach ($bookings_found as $k){
        ?>

		<tr class='fila<?=$x;?>'  >
		 <td id='td' class='derecha'><? echo  date('Y-m-d',strtotime($k['start']));?></td>
			 <? $db= new getQueries ();
           $client_d=$db->show_id("customers", $k['client']);

           ?>
             <td id='td' class='derecha'><? echo  $client_d[0]['name']." ". $client_d[0]['lastname'];?></td>
             <td id='td' class='derecha'><? echo  $k['ref'];?></td>
                 <?
		       switch ($k['status']){
		       	case 0:
		         	$status_result="<span style='color:red'>Cancelled</span>";
			       	break;
		       	case 1:
		         	$status_result="<span class='azul2'>Checked in-Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 2:
		         	$status_result="<span class='azul2'>Confirmed-Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 3:
		         	$status_result= "<span class='morado'>No Confirmed-Short</span>";
		         	$tipo_de_renta=1;
			       	break;
				case 4:
		         	$status_result= "<span class='outck'>Checked out-Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 5:
		         	$status_result= "<span style='color:red'>Maintenance (out of service)</span>";
			       	break;
			   case 6:
		         	$status_result= "<span class='r_vip'>Checked in-short VIP</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 7:
		         	$status_result= "<span class='r_owner'>Checked in-Owner Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 8:
		         	$status_result= "<span class='r_long'>Checked in - Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			    case 9:
		         	$status_result= "<span class='r_long'>Confirmed - Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			 	case 10:
		         	$status_result= "<span class='r_long'>No Confirmed - Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			    case 11:
		         	$status_result= "<span class='r_long'>Checked Out - Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			 	case 12:
		         	$status_result= "<span class='r_vip'>Confirmed-Short VIP</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 13:
		         	$status_result= "<span class='r_vip'>No Confirmed-Short VIP</span>";
		         	$tipo_de_renta=1;
			       	break;
			 	case 14:
		         	$status_result= "<span class='r_vip'>Checked Out-Short VIP</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 15:
		         	$status_result= "<span class='r_vip'>Checked in-Long VIP</span>";
		         	$tipo_de_renta=2;
			       	break;
			 	case 16:
		         	$status_result= "<span class='r_vip'>Confirmed-Long VIP</span>";
		         	$tipo_de_renta=2;
			       	break;
			    case 17:
		         	$status_result= "<span class='r_vip'>No Confirmed-Long VIP </span>";
		         	$tipo_de_renta=2;
			       	break;
			 	case 18:
		         	$status_result= "<span class='r_vip'>Checked Out-Long VIP</span>";
		         	$tipo_de_renta=2;
			       	break;
			    case 19:
		         	$status_result= "<span class='r_long'>Confirmed-Owner, Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			 	case 20:
		         	$status_result= "<span class='r_long'>No confirmed-Owner, Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			    case 21:
		         	$status_result= "<span class='r_long'>Checked Out - Owner, Short</span>";
		         	$tipo_de_renta=1;
			       	break;
			 	case 22:
		         	$status_result= "<span class='r_long'>Checked in - Owner, Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			    case 23:
		         	$status_result= "<span class='r_long'>Confirmed - Owner, Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			 	case 24:
		         	$status_result= "<span class='r_long'>No confirmed - Owner, Long</span>";
		         	$tipo_de_renta=2;
			       	break;
			    case 25:
		         	$status_result= "<span class='r_long'>Checked Out - Owner, Long</span>";
		         	$tipo_de_renta=2;
			       	break;
		       	default:
			       $status_result= "<span class='negro'><u>Unavailabe</u></span>";
			       	break;
		       }
		       ?>
           <td id='td' class='derecha'><?=$status_result?></td>
           <td> <? if ($k['status']==0){?><span style="color:red; font-weight:bold;"> Cancelled </span><? }?>
                <? if ($k['paid']==2){?> <span style="color:green; font-weight:bold;">Paid</span> <? }?>
                <? if (($k['status']==4)&&($k['paid']==0)){?> UnPaid <? }?>
                <? if ($k['paid']==1){?> Ready to pickup <? }?>
                <? if (($k['status']!=4)&&($k['status']<>0)&&($k['paid']==0)){?> <span style="color:orange; font-weight:bold;">In Process</span> <? }?>

           </td>
           <td><a href="#" onclick="reserva('../booking/reserva_details_RAP.php?id=<?=$k['busyid']?>','Details for Selection', 440, 760)">details</a></td>

		  <? if($tipo_de_renta==1){?>
			<?
           /*$total_booking=$k['subtotal']-$k['itbis']; */
           $total_booking=(($k['ppn']*$k['NLS'])+($k['PHS']*$k['NHS']));
			$comission_discounted_amount=$db->show_any_data_limit1("bookingreferred", "ref_book", $k['ref'], "=");
           $db= new getQueries();
           ?>

                         <!--//   codigo para promotion code//-->
					<?
						/*echo "<pre>";
						print_r($k);
						echo "</pre>"; */

		                $this_disc=$db->show_any_data_limit1("discount", "reference", $k['ref'], "=");
		                $disc_found=$this_disc[0];
			              if ($disc_found){
			               /*echo "<pre>";
			              	print_r($disc_found);
			              	echo "</pre>"; */
			                    //hacer calculos
			                    /*$amount_nightsLS=($ocupabilidad['NLS']*$ocupabilidad['ppn']);
			                    $amount_nightsHS=($ocupabilidad['NHS']*$ocupabilidad['PHS']);
			                    $amount_nights=$amount_nightsLS+$amount_nightsHS;*/
			                    $amount_nights=$total_booking;

			                     if  ($disc_found['pro_type']=="2"){   //Amount
			                           $descuento=($disc_found['pro_qty']);
			                         /*  $variable_descuento="US$ ".$disc_found['pro_qty']." ";
			                           $tipo_desc="monto";
			                           $promotion_code=$disc_found['pro_code']; */

			                     }elseif($disc_found['pro_type']=="1"){ //percent
			                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                        /* $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="porcient";
			                         $promotion_code=$disc_found['pro_code']; */
			                     }elseif($disc_found['pro_type']=="3"){ //days
			                         if ($k['NLS']!=0 &&  $k['NHS']==0){//solo low season
			                           $descuento=$k['ppn']*$disc_found['qty_days'];
			                        }
			                        if (($k['NLS']==0)&&( $k['NHS']!=0)){//solo High season
			                           $descuento=$k['PHS']*$disc_found['qty_days'];
			                        }
			                        if (($k['NLS']!=0) && ($k['NHS']!=0)){//ambas season
			                          if($k['NLS']>=$disc_found['qty_days']){
			                         	$descuento=$k['ppn']*$disc_found['qty_days'];
			                          }else{
			                          	$descuento=$k['ppn']*$k['NLS'];
			                          	$descuento+=$k['PHS']*($disc_found['qty_days']-$k['NLS']);
			                          }
		                       		}
			                     }
			              }
			              $total_booking-=$descuento; //reduce the discount to the total of the booking
                ?>
                 <!--//   codigo para promotion code//-->
			<td id='td' class='derecha' style="text-align:right;"><? 
			if($total_booking){
				//$percent_discounted=((100*$comission_discounted_amount[0]['discounted'])/$total_booking); 
				$percent_discounted=$comission_discounted_amount[0]['discounted'];
			}else{
				$percent_discounted=0;
				$comission_discounted_amount[0]['discounted']=0;
			}
			echo $percent_discounted; ?> % <?/*=$comission_discounted_amount[0]['discounted'];*/?>  </td>	 
            <td id='td' class='derecha' style="text-align:right;"> <? if ($k['status']==0){?> US$ 0.00 <? }else{
				?> 
			US$ <?
			$percent_agent_int=$_SESSION['referal']['percent']*100;
			$percent_calculate=$percent_agent_int-$percent_discounted;
			echo number_format(($total_booking*($percent_calculate/100)),2);
			
			?>

			<? }?></td>
          <?}?>
           <? if($tipo_de_renta==2){?>
			<?
           //$total_booking=$k['subtotal']-$k['itbis'];
           ?>
		     <td id='td' class='derecha' style="text-align:right;"> 0 % </td>
            <? if ($k['EN']>0){ $meses_enteros=($k['PAYM']-1);}else{$meses_enteros=$k['PAYM'];}
            $noches_extras=$k['EN'];
            $precio_por_meses=$k['PL'];
            $total_comision_long=(($precio_por_meses*$meses_enteros)*$_SESSION['referal']['long_percent'])+((($precio_por_meses/30)*$noches_extras)*$_SESSION['referal']['long_percent']);
            ?>
            <td id='td' class='derecha' style="text-align:right;"> US$ <?=number_format($total_comision_long,2);?> </td>
          <?}?>
           <? if($tipo_de_renta==0){?>
			<?
           $total_booking=$k['subtotal']-$k['itbis'];

           ?>
		   <td id='td' class='derecha' style="text-align:right;">US$ 0.00  </td>
            <td id='td' class='derecha' style="text-align:right;">  US$ 0.00 </td>
          <?}?>
           </tr>
         <?
		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		?>
		</table>
	  <?}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>There are no bookings found.</p>";

	  }?>

 <? }?>