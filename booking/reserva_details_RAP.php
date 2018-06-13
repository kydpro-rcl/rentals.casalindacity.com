<?php
require_once('inc/session.php');
  $id=$_GET['id'];
if ($_SESSION['referal']){
 if($id){
	require_once('template/head.php');
	require_once('init.php');

	$db=new getQueries ();   //connect and make a query - Ej. get info from a ref number
	$busy=$db->see_occupancy_id($id);
    $ocupabilidad=$busy[0];
	 $gente_reserva=$db->people($ocupabilidad['reserveid']);
	 $servicios_reserva=$db->services_reserved($ocupabilidad['reserveid']);
	 $villa_reserva=$db->villa($ocupabilidad['villa']);
	 $servicios_reserva_long=$db->services_reserved_long($ocupabilidad['reserveid']);
	 $payments_date=$db->payments_date($ocupabilidad['reserveid']); //get payments date per long rental

	?>
	<script type="text/javascript" src="js/confirm.js"></script>
	  <h1 class="header">Booking Details</h1>

	  <hr>
	 <p> <b>Reference:</b> <!--<a href="edit-booking.php?refnumb=<?/*=$ocupabilidad['ref'];*/?>" title="Change this booking" target="_blank">--><u><?=$ocupabilidad['ref'];?></u><!--</a>--> <b>Status:</b>
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

       if ($ocupabilidad['dep']>0){/*(($ocupabilidad['status']==2)||($ocupabilidad['status']==6))*/ echo " <strong>Deposited:</strong> <span class='azul2'><u>".$ocupabilidad['dep']." USD</u></span>";}

      # $short
	  ?>  </p>
	  <? if (($short==1)||($maintenaced==1)||($owners_in_house)){ //DO THIS ONLY IF SHORT TERM
	  	?>

	  	  <!--//   codigo para promotion code//-->
			<?
                $this_disc=$db->show_any_data_limit1("discount", "reference", $ocupabilidad['ref'], "=");
                $disc_found=$this_disc[0];
	              if ($disc_found){
	              	//print_r($disc_found);
	                    //hacer calculos
	                    $amount_nightsLS=($ocupabilidad['NLS']*$ocupabilidad['ppn']);
	                    $amount_nightsHS=($ocupabilidad['NHS']*$ocupabilidad['PHS']);
	                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

	                     if  ($disc_found['pro_type']=="2"){   //Amount
	                           $descuento=($disc_found['pro_qty']);
	                           $variable_descuento="US$ ".$disc_found['pro_qty']." ";
	                           $tipo_desc="monto";
	                           $promotion_code=$disc_found['pro_code'];

	                     }elseif($disc_found['pro_type']=="1"){
	                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
	                         $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
	                         $tipo_desc="porcient";
	                         $promotion_code=$disc_found['pro_code'];
	                     }
	              }
			?>
			<!--//   codigo para promotion code//-->
	       <div class="money_box" style="margin-left:5px;height:327px;">CURRENCY<hr /><?/* print_r($disc_found);*/?>
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
				    <? if ($descuento>0){?>
                   <P id="left" style="font-weight:bold; color:green;">Amount after discount = USD <? echo number_format($ocupabilidad['subtotal']-$ocupabilidad['itbis'],2);?></p>
                   <?}?>
			     <!--//fin codigo promotion//-->
	         <P id="left"><?=TAX_PERCENT?> - VAT - Taxes = USD <? echo number_format($ocupabilidad['itbis'],2);?></p>
	         <P id="left"><strong>Sub-Total = USD <? echo number_format($ocupabilidad['subtotal'],2);?></strong></p>
	      <?
	        if (!empty($servicios_reserva)){
				$total_services=0;
				foreach ($servicios_reserva as $s){
			   // echo $s['price']." ";
				   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
					echo "<P id='right_blue'>".$s['name']." = ".$s['price']."</p>"; $total_services+=$s['price'];
				   }else{
					echo "<P id='right_blue'>".ucfirst($s['type'])." (".$s['name'].")= ".$s['price']."</p>"; $total_services+=$s['price'];
				   }

				}
	  		 echo "<P id='right_blue'><strong>Total per Services = USD ".number_format($total_services,2)."</strong></p>";
			 }
			 $grand_total=($ocupabilidad['subtotal']+$total_services);
			 echo "<hr />";
			 echo "<P id='left'><strong>GENERAL TOTAL = USD ".number_format($ocupabilidad['total'],2)."</strong></p>";
	       ?>
	       </div>
	       <div class="villa_box" style="height:327px;"><? $v=$villa_reserva[0];?>
	      VILLA AND RESERVATION DETAILS<hr/>
	       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
	       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
	       <p><b>Villa No.</b>  <?=$v['no'];?></p>
	       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
	       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
	      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

	      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
	       </div>
      <?}  ?>

        <? if ($long==1){ //DO THIS ONLY IF LONG TERM
	  	?>
           <div class="money_box" style="width:300px; margin-left:5px;height:327px;">
           <h4 style="margin:0px; padding:0px; margin-top:0px; margin-bottom:0px; font-size:11px;">PAYMENTS INFORMATION</h4>
           <hr style="margin:0px; padding:0px; width:100%" />
                <? if ($ocupabilidad['EN']>0){ $pagos_enteros=($ocupabilidad['PAYM']-1);}else{$pagos_enteros=$ocupabilidad['PAYM'];}?>
	         	<p id="left" style="margin-top:0px; padding-top:0px;"><? echo $pagos_enteros;?> Monthly payments <b><? echo number_format($ocupabilidad['PMV'],2);?></b> = USD <? echo number_format(($pagos_enteros*$ocupabilidad['PMV']),2);?> </p>
               <p id="left"><? echo $ocupabilidad['EN'];?> Extra nights x <b><? echo $ocupabilidad['ppn'];?></b> = USD <? echo number_format(($ocupabilidad['EN']*$ocupabilidad['ppn']),2);?> </p>

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
	       <div class="villa_box" style="width:400px;height:327px;"><? $v=$villa_reserva[0];?>
	      VILLA AND RESERVATION DETAILS<hr/>
	       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
	       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
	       <p><b>Villa No.</b>  <?=$v['no'];?></p>
	       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
	       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
	      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

	      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
	       </div>


	  	<?}?>

<table align="center" witdht="50%" ><tr><td width="50%" align="left">
      <form method="post" action="" >
	<!--<input type="hidden" name="id" value="<?=$id?>" />-->

	<!--<input type="image" src="images/print.jpg" name="image" width="65" height="80" title="Print this page">-->
<!--//	<input type="submit" class="book_but" value="Print" >//-->
</form>
   </td><td>
<form method="post" action="" >
			<!--<input type="hidden" name="ref" value="<?=$ocupabilidad['ref'];?>" />-->
            <!--<input type="image" src="images/resend.jpg" name="image" width="150" height="80" title="Resend this info to the Customer" onClick="return confirmSubmitText('Are you sure you want to re-send information about booking no. <?=$ocupabilidad['ref'];?> to the client ?');">-->
		<!--//	<input type="submit" class="book_but" value="Resend booking to client"  />//-->
		</form>
     </td></tr></table>

    <?} ?>

<?
}else{
	 header('Location:http://www.casalindacity.com');
	die();
  }
?>
