<?php
session_start();
//echo $id;

  $id=$_POST['id'];
  //$id=229;
if ($_SESSION['info']){
 if($id){
	require_once('template/head_print.php');
	require_once('init.php');

	$db=new getQueries ();   //connect and make a query - Ej. get info from a ref number
	/*$busy=$db->see_occupancy_id($id);
    $ocupabilidad=$busy[0];
	$gente_reserva=$db->people($ocupabilidad['reserveid']);
	$servicios_reserva=$db->services_reserved($ocupabilidad['reserveid']);
	$villa_reserva=$db->villa($ocupabilidad['villa']);

	$servicios_reserva_long=$db->services_reserved_long($ocupabilidad['reserveid']);
	 $payments_date=$db->payments_date($ocupabilidad['reserveid']); //get payments date per long rental
     */
	 $busy=$db->see_occupancy_id($id);
    $ocupabilidad=$busy[0];
	 $gente_reserva=$db->people($ocupabilidad['reserveid']);
	 $servicios_reserva=$db->services_reserved($ocupabilidad['reserveid']);
	 $excursiones_reserva=$db->excrusiones_reserved($ocupabilidad['reserveid']);
	 $villa_reserva=$db->villa($ocupabilidad['villa']);
	 $servicios_reserva_long=$db->services_reserved_long($ocupabilidad['reserveid']);
	 $payments_date=$db->payments_date($ocupabilidad['reserveid']); //get payments date per long rental
	?>

		<script type="text/javascript">
			function PrintPage(){
			var OLECMDID = 7;
			if (navigator.appName == "Microsoft Internet Explorer"){
			var PROMPT = 1;
			var WebBrowser = '';
			document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
			WebBrowser1.ExecWB(OLECMDID, PROMPT);
			WebBrowser1.outerHTML = "";
			}
			else
			{
			window.print();
			}
			}
		</script>

	<div id="content" ><!--start content-->
       <div id="header_main">
       	<p style="text-align:center; padding:0; margin:0;"><img  src="print_view/images/logo.png" alt="logo" /></p>
        <h1 style="text-align:center; padding:0; margin:0;">R.C.L Administracciones, SRL.</h1>
        <p style="text-align:center; padding:0; margin:0;">Sosua, Rep&uacute;blica Dominicana<br />
           Tel.: 809-571-1190 - Fax: 809-571-1490<br/>
           RNC: 1-05-04480-3</p>
       </div>
	  <h1 class="header">Details of Occupation</h1>
	  <p id="p_date">Date: <? echo date('Y-m-d G:i:s');?></p>
	  <hr>
	 <p> <b>Reference:</b> <a href="edit-booking.php?refnumb=<?=$ocupabilidad['ref'];?>" title="Change this booking" target="_blank"><u><?=$ocupabilidad['ref'];?></u></a> <b>Status:</b>
	  <?
       switch ($ocupabilidad['status']){
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
       }

       if ($ocupabilidad['dep']>0) echo "<p> <strong>Deposited:</strong> <span class='azul2'><u>".$ocupabilidad['dep']." USD</u></span>";
	  ?>  </p>
  <? if (($short==1)||($maintenaced==1)||($owners_in_house)){ //DO THIS ONLY IF SHORT TERM
	  	?>
       <div class="money_box">CURRENCY<hr />
         <? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']>0)){?>
         	<p id="left"><? echo $ocupabilidad['NLS'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['NLS']*$ocupabilidad['ppn']),2);?> </p>
         	<p id="left"><? echo $ocupabilidad['NHS'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['NHS']*$ocupabilidad['PHS']),2);?> </p>
          <? }?>

           <? if (($ocupabilidad['NHS']==0)&&($ocupabilidad['NLS']>0)){?>
         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['ppn']),2);?> </p>
          <? }?>

           <? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']==0)){?>
         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['PHS']),2);?> </p>
          <? }?>

       		            <!--//codigo promotion//-->
                     <?
                     $LS_monto=$ocupabilidad['NLS']*$ocupabilidad['ppn'];
                     $HS_monto=$ocupabilidad['NHS']*$ocupabilidad['PHS'];
                     ?>
				    <? if (($descuento>0)&&($tipo_desc=="monto")){?>

				    <p id="left" style="text-align:right; color:green;">
				    	(<?=$promotion_code?>)	Discount =
				    		<? echo "US$ ".number_format($descuento,2); ?>
				    </p>
				    <?}?>
				    <? if (($descuento>0)&&($tipo_desc=="porcient")){?>
				    	<p id="left" style="text-align:right; color:green;">
				    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> =
				    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
				    	</p>
				    <?}?>
				     <? if (($descuento>0)&&($tipo_desc=="days")){?>
				    	<p id="left" style="text-align:right; color:green;">
				    		(<?=$promotion_code?>) <?=$variable_descuento;?> Discount of <?=$ocupabilidad['NLS']+$ocupabilidad['NHS']?> =
				    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
				    	</p>
				    <?}?>
				    <? if ($descuento>0){?>
                   <P id="left" style="font-weight:bold; color:green;">Amount after discount = USD <? echo number_format(($LS_monto+$HS_monto)-$descuento,2);?></p>
                   <?}?>
			     <!--//fin codigo promotion//-->
			     <?
			      if (!empty($servicios_reserva)){
						$total_services2=0;
						foreach ($servicios_reserva as $s){
                          $total_services2+=$s['price'];
						}
					 }
			     ?>

			     <?
			      if (!empty($excursiones_reserva)){
					$total_excursion=0;
	                 foreach ($excursiones_reserva as $k){
	                 //echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
	                 $total_excursion+=$k['total'];
	                 }
	               //   echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
				  }

			     ?>

	         <P id="left"><strong>Sub-Total = USD <? echo number_format($ocupabilidad['total']-$ocupabilidad['itbis']-$total_services2-$total_excursion,2);?></strong></p>
	      <?
	        if (!empty($servicios_reserva)){
				$total_services=0;
				foreach ($servicios_reserva as $s){
			   // echo $s['price']." ";
				   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
					echo "<P id='right_blue'>".$s['name']." = ".$s['price']."</p>"; $total_services+=$s['price'];
				   }elseif($s['type']=="Car_Rental"){
                    echo "<P id='right_blue'>".substr($s['name'],0,15)." (".$s['qty']." days)= ".$s['price']."</p>"; $total_services+=$s['price'];
				   }else{
					echo "<P id='right_blue'>".ucfirst($s['type'])." ( ".substr($s['name'],0,15).")= ".$s['price']."</p>"; $total_services+=$s['price'];
				   }

				}
	  		 echo "<P id='right_blue'><strong>Total per Services = USD ".number_format($total_services,2)."</strong></p>";
			 }
			 $grand_total=($ocupabilidad['subtotal']+$total_services);
			 ?>

			 <?
			 //------------start showing excursions---------------------------------
			/* echo '<pre>';
			 print_r($excursiones_reserva);
			 echo '</pre>'; */
			  if (!empty($excursiones_reserva)){
				$total_excursion=0;
                 foreach ($excursiones_reserva as $k){
                 echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
                 $total_excursion+=$k['total'];
                 }
                  echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
			  }
			 ?>
			  <p id="left">16% - VAT - Taxes = USD <? echo number_format($ocupabilidad['itbis'],2);?></p>
			 <?
			 echo "<hr />";
			 echo "<P id='left'><strong>GENERAL TOTAL = USD ".number_format($ocupabilidad['total'],2)."</strong></p>";
       ?>
       </div>
   <?}?>

      <? if ($long==1){ //DO THIS ONLY IF LONG TERM
	  	?>
           <div class="money_box" style="width:300px; margin-left:5px;">
           <h4 style="margin:0px; padding:0px; margin-top:0px; margin-bottom:0px; font-size:11px;">PAYMENTS INFORMATION</h4>
           <hr style="margin:0px; padding:0px; width:100%" />
                <? if ($ocupabilidad['EN']>0){ $pagos_enteros=($ocupabilidad['PAYM']-1);}else{$pagos_enteros=$ocupabilidad['PAYM'];}?>
	         	<p id="left" style="margin-top:0px; padding-top:0px; font-size:11px;"><? echo $pagos_enteros;?> Monthly payments <b><? echo number_format($ocupabilidad['PMV'],2);?></b> = USD <? echo number_format(($pagos_enteros*$ocupabilidad['PMV']),2);?> </p>
               <p id="left" style="font-size:11px;"><? echo $ocupabilidad['EN'];?> Extra nights x <b><? echo $ocupabilidad['ppn'];?></b> = USD <? echo number_format(($ocupabilidad['EN']*$ocupabilidad['ppn']),2);?> </p>

	         <?

			 echo "<hr />";
			 echo "<P id='left'><strong>GENERAL TOTAL = USD ".number_format($ocupabilidad['total'],2)."</strong></p>"; ?>
             <span style="color:blue;"><u>First Payment on</u>: <b><?=formatear_fecha($ocupabilidad['start'])?></b> <!--//(See all)//--></span><br/>
             <span style="font-size:10px; color:red;">NOTE: Electricity is charged monthly per consumption</span>
            <p style="color: white; line-height:normal; font-weight:bold; text-align:center; margin-top:0px; margin-bottom:0px; background-color:#09F;">MORE DETAILS</P>
              <?

              if ($servicios_reserva_long){
				$total_services=0;
				foreach ($servicios_reserva_long as $sl){
			   // echo $s['price']." ";

					echo "<P id='right_blue'>".ucfirst($sl['name'])."= ".$sl['price']."</p>"; $total_services+=$sl['price'];
				}
	  		 echo "<P id='right_blue'><strong>Total Monthly per Services = USD ".number_format($total_services,2)."</strong></p>";
			 }
			 $grand_total=($ocupabilidad['subtotal']+$total_services);
	       ?>
	       <p style="line-height:normal; font-weight:bold; text-align:right; margin-top:0px;">Monthly price per villa <?=number_format($ocupabilidad['PL'],2)?></p>
	       </div>

	 <?}?>
       <div class="villa_box"><? $v=$villa_reserva[0];?>
      VILLA AND RESERVATION DETAILS<hr/>
      <!-- <img style="float:left; padding-right:5px;" src="<?/*=$v['pic']*/?>" alt="/*villa No.<?=$v['no']?>*/" title="Villa No.<?/*=$v['no']*/?>" width="153" height="103">-->
       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b> <br /> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
       <p><b>Villa No.</b>  <?=$v['no'];?></p>
       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
       </div>

       <div class="client_box">
      <!--*----------------------------------------------->
    <?  $estado=$ocupabilidad['status'];
    if (($estado==5)||($estado==7)||($estado==19)||($estado==20)||($estado==21)){?>
       <? if (($estado==7)||($estado==19)||($estado==20)||($estado==21)){
		   $owner=$db->show_id('owners', $ocupabilidad['client']);
		   ?>
            <p class="_p">OWNER DETAILS</><hr/>
            <p class="_p"><b>Owner in house: </b><? echo $owner[0]['name'].' '.$owner[0]['lastname']; ?><br/> <b>Own villa (s):</b> <? $vo=$db->show_data('villas', "`id_owner`=".$ocupabilidad['client'], 'id'); foreach( $vo as $vi){ echo "(".$vi['no'].") "; }
             $sending_name=$owner[0]['name']; $sending_lastname=$owner[0]['lastname'];
            ?> </p>
        <? }?>

        <? if ($estado==5){?>
            <p class="_p">OUT OF SERVICE TEMPORARY</><hr/>
        <? }?>
 	</div> <!--*----------------------------------------------->
    <? }else{ ?>
    	<? $cl=$db->customer($ocupabilidad['client']);?>
        <p class="_p">CLIENT AND PERSONS</><hr/>

       <p class="_p"><b>Customer: </b><a href="view-clients-details.php?id=<?=$cl['id'];?>" title="Client details" target="_blank"><? echo $cl['name'].' '.$cl['lastname']; ?></a>&nbsp;&nbsp;&nbsp; <b>No.</b> <? echo $cl['id'];
              $sending_name=$cl['name']; $sending_lastname=$cl['lastname'];
       ?></p>
       <p class="_p"><b>Phone:</b> <? if ($cl['phone']){ echo $cl['phone'];}else{ echo 'unavailable';}?>&nbsp;&nbsp;&nbsp;  <b>Email:</b> <? if ($cl['email']){echo $cl['email'];}else{echo 'unavailable';}?></p>
       <p class="_p"><b>Address:</b> <? if  ($cl['address']){ echo $cl['address'].", ".$cl['country']; }else{ echo 'unavailable';}?></p>

       <div class="people_box" style="text-align:center"><!--<b>PERSONS IN VILLA</b><br>--><?
	   echo '<table border=0 cellpadding=1 cellspacing=1><tr><td class="peq" valign=top><strong>'.$ocupabilidad['adults'].' Adults</strong></td><td class="peq" valign=top><strong>'.$ocupabilidad['kids'].' Children</strong></td></tr>';
	   echo '<tr><td valign=top ><ol id="ol">';
		   foreach ($gente_reserva as $p){

			 if ($p['type']==1)	echo '<li class=\'li_brown\' >'.ucfirst($p['name'])." ".ucfirst($p['lastname'])."</li>";
			}
		echo '</ol></td><td valign=top ><ol id="ol">';
		foreach ($gente_reserva as $p){
			 if ($p['type']==2)	echo '<li >'.ucfirst($p['name'])." ".ucfirst($p['lastname'])."</li>";
			}
	   echo '</ol></td></tr></table>';
       ?>
      </div></div> <!--*----------------------------------------------->
    <?} ?>


<div class="notes_box">NOTES AND COMMENTS<hr/><? if($ocupabilidad['rc']){?><b>Booking Note:</b><br /> <?=stripslashes($ocupabilidad['rc']);?><br /><br /><?}?>
  <? if ($ocupabilidad['status']==0){
  	$cancelled=$db->show_cancelled($ocupabilidad['ref']);
    echo "CANCELLATION REASONS: <span style='color:red;'>".stripslashes($cancelled[0]['reasons'])."</span>";
  }
  ?>


 <? if (!empty($servicios_reserva)){
	 echo "<b>Services Comment:</b><br/>";
	 foreach ($servicios_reserva as $s){
    	echo "<span class='c_b'><b>".$s['type']."</b>: ".stripslashes($s['note'])."<br/></span>";
	 }?>
	 <br />
	<?}?>
	<? $link= new DB(); $made=$link->getUserDetails($ocupabilidad['adm']);?>

    <? if ($ocupabilidad['adm']!="0"){?>
		<? $link= new DB(); $made=$link->getUserDetails($ocupabilidad['adm']);?>
		<? if ($ocupabilidad['upd']>0){?>
		<p class="derecha">Last modified by: <?=$made[0]['name'];?><br>
			<?
			$fecha_modificado=$db->show_id("occupancy_mod", $ocupabilidad['upd']);
			?>
		On: <span  style="color:red"><?=$fecha_modificado[0]['date'];?></span>
		</p>

		<?}else{?>
		<p class="derecha">Made by: <?=$made[0]['name'];?><br>
		 On: <span  style="color:red"><?=$ocupabilidad['date'];?></span>
		</p>

		<?}?>
	<?}else{
      if ($cl['online']==1){
      	 echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">client online</span><br/>";
      	 echo "On: <span  style=\"color:red\">".$ocupabilidad['date']."</span></p>";
      }else{
       if ($ocupabilidad['line']==1){
        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Client online</span><br/>";
      	echo "On: <span  style=\"color:red\">".$ocupabilidad['date']."</span></p>";
       }else{
        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Unavailable</span><br/>";
      	echo "On: <span  style=\"color:red\">".$ocupabilidad['date']."</span></p>";
       }
      }
	}?>

</div>


	<?
 }else{
	 header('Location:booking-calendar.php');
	die();
	 }
}else{
	 header('Location:login.php');
	die();
	 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
  }
?>
<p style="clear:both">&nbsp;</p>
<!--//<p style="clear:both"><input type="button" class="book_but" onclick="javascript:PrintPage();" value="Print Preview" title="Print this page"> </p>//-->

	<? if ($_SESSION['info']['level']<=4){
		if (($ocupabilidad['status']!=0)&&($ocupabilidad['status']!=5)){?>

		<? }
	}?>

	  <? if ($ocupabilidad['upd']>0){
			if ($_SESSION['info']['level']==1){?>

			<!--<span class="error" style="font-size:10px;">Book changed<span>-->
		<? }
		}?>
<!--onclick="location.href='edit-booking.php?refnumb= -->
    <div id="footer_main">
       Please, Visit: <strong>http://www.CasaLindaCity.com</strong> Email: <strong>Reservations@CasaLindaCity.com</strong>
    </div>
</div><!--end content-->