<?php
session_start();
//echo $id;

  $id=$_GET['id'];
if ($_SESSION['info']){
 if($id){
	require_once('template/head.php');
	require_once('init.php');

	$db=new getQueries ();   //connect and make a query - Ej. get info from a ref number
	$busy=$db->see_occupancy_mod_id($id);
    $ocupabilidad=$busy[0];
	//echo $busy[0]['nights'];
	 // echo $ocupabilidad['nights'];
	 $gente_reserva=$db->people_mod($ocupabilidad['reserveid']);
	 $servicios_reserva=$db->services_reserved_mod($ocupabilidad['reserveid']);
	 $villa_reserva=$db->villa($ocupabilidad['villa']);

	//echo  $villa_reserva[0]['no'];
   /*if (!empty($servicios_reserva)){
		foreach ($servicios_reserva as $s){
	    echo $s['price']." ";
	    echo $s['name']."<br>";

		}
   }else{
   	//echo "No hay Servicios<br>";
   } */

	?>
	  <h1 class="header">Details of change on booking</h1>
	  <hr>
	 <p> <b>Reference:</b> <u><?=$ocupabilidad['ref'];?></u>  <b>Status:</b>
	  <?
       switch ($ocupabilidad['status']){
       	case 0:
         	echo "<span style='color:red'><u>Cancelled</u></span>";
	       	break;
       	case 1:
         	echo "<span class='verde'><u>Checked in</u></span>";
	       	break;
	    case 2:
         	echo "<span class='azul2'><u>Confirmed</u></span>";
	       	break;
	    case 3:
         	echo "<span class='morado'><u>No confirmed</u></span>";
	       	break;
		case 4:
         	echo "<span class='outck'><u>Checked out</u></span>";
	       	break;
	    case 5:
         	echo "<span style='color:red'><u>Maintenance (out of service)</u></span>";
	       	break;
	     case 6:
         	echo "<span class='r_vip'>VIP Rental</span>";
	       	break;
	    case 7:
         	echo "<span class='r_owner'>Owner in house</span>";
	       	break;
	    case 8:
         	echo "<span class='r_long'>Long Term Rental</span>";
	       	break;
       	default:
	       	echo "<span class='negro'><u>Unavailabe</u></span>";
	       	break;
       }

       if ($ocupabilidad['status']==2) echo " <strong>Deposited:</strong> <span class='azul2'><u>".$ocupabilidad['dep']." USD</u></span>";
	  ?>  </p>
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

         <P id="left">16% - VAT - Taxes = USD <? echo number_format($ocupabilidad['itbis'],2);?></p>
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
		 echo "<P id='left'><strong>GENERAL TOTAL = USD ".number_format($grand_total,2)."</strong></p>";
       ?>
       </div>
       <div class="villa_box"><? $v=$villa_reserva[0];?>
      VILLA AND STAYING <hr/>
       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
       <p><b>Villa No.</b>  <?=$v['no'];?></p>
       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
       </div>

       <div class="client_box">
           <!--*----------------------------------------------->
	    <?  $estado=$ocupabilidad['status'];
	    if (($estado==5)||($estado==7)){?>
	       <? if ($estado==7){
			   $owner=$db->show_id('owners', $ocupabilidad['client']);
			   ?>
	            <p class="_p">OWNER DETAILS</><hr/>
	            <p class="_p"><b>Owner in house: </b><? echo $owner[0]['name'].' '.$owner[0]['lastname']; ?><br/> <b>Own villa (s):</b> <? $vo=$db->show_data('villas', "`id_owner`=".$ocupabilidad['client'], 'id'); foreach( $vo as $vi){ echo "(".$vi['no'].") "; }?> </p>
	        <? }?>
	        <? if ($estado==5){?>
	            <p class="_p">OUT OF SERVICE TEMPORARY</><hr/>
	        <? }?>
	    <? }else{ ?>
	    	<? $cl=$db->customer($ocupabilidad['client']);?>
	        <p class="_p">CLIENT AND PERSONS</><hr/>

	       <p class="_p"><b>Customer: </b><? echo $cl['name'].' '.$cl['lastname']; ?>&nbsp;&nbsp;&nbsp; <b>No.</b> <? echo $cl['id'];?></p>
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
	    <?} ?>
     <!--*----------------------------------------------->
       </div></div>

<div class="notes_box">NOTES AND COMMENTS<hr/><? if($ocupabilidad['rc']){?><b>Booking Note:</b><br /> <?=$ocupabilidad['rc'];?><br /><br /><?}?>
  <? if ($ocupabilidad['status']==0){  	$cancelled=$db->show_cancelled($ocupabilidad['ref']);
    echo "CANCELLATION REASONS: <span style='color:red;'>".$cancelled[0]['reasons']."</span>";  }
  ?>


 <? if (!empty($servicios_reserva)){
	 echo "<b>Services Comment:</b><br/>";
	 foreach ($servicios_reserva as $s){
    	echo "<span class='c_b'><b>".$s['type']."</b>: ".$s['note']."<br/></span>";
	 }?>
	 <br />
	<?}?>
	<? $link= new DB(); $made=$link->getUserDetails($ocupabilidad['adm']);?>
<p class="derecha">Made by: <?=$made[0]['name'];?></p>
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
<!--<input type="button" value="Reload Page" onClick="window.location.reload()">
<input type="button" value="Reload & close" onclick="window.opener.document.location.reload(); window.close(); return false;"> -->
<!--<input type="button" value="Reload & Close" class="book_but" onclick="javascript: window.parent.history.go(); window.close();">-->
<!--<input type="button" value="Close" onclick="window.close();">-->
<!--<input type="button" value="Reload 2" onclick="javascript:self.close();window.opener.location.reload(true);">  -->

<!--onclick="location.href='edit-booking.php?refnumb= -->