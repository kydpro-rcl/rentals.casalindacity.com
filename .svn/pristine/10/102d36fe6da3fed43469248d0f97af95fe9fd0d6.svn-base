<!--///*<h3 style="color:#06F; text-align:center;">Booking Services</h3>*///-->
  <?
 if ( $_POST['excursions']){

 		$excur_selected=array();
        foreach($_POST['excursions'] AS $k){

         $adultos="adults$k"; $ninos="kids$k"; //varialbes que determinan la cantidad de personas de la excursion
         if ($_POST[$adultos]==0 && $_POST[$ninos]==0){  //si no se eligieron cantidad asignar un adulto             $_POST[$adultos]=1; //cantidad de adultos es igual a 1         }

         $_SESSION['excur'][$k]['adults']=$_POST[$adultos]; //cantidad de adultos para esta excursion
         $_SESSION['excur'][$k]['kids']=$_POST[$ninos];    //niños para esta excursion

         $aprecio="priceadults$k"; $nprecio="pricekids$k";   //variables para los precios de adultos y niños
         $exc_titulo="excus_title$k";//variable para el titulo de la excursion

         array_push($excur_selected,array(	'id'=>$k,'qty_adult'=>$_POST[$adultos],
         									'qty_kid'=>$_POST[$ninos],
         									'price_a'=>$_POST[$aprecio],
         									'price_k'=>$_POST[$nprecio],
         									'title'=>$_POST[$exc_titulo]));
        }
    $_SESSION['excursions']=$excur_selected;
 }
 ?>


<?php

$db=new getQueries ();
$servicios_reserva=$db->services_reserved($_SESSION['cust_book']['reserveid']);

/*print_r($servicios_reserva); */

 $ids_services_booked=array();
 foreach($servicios_reserva AS $k){ array_push($ids_services_booked,$k['serviceid']); }
?>

<h3 style="color:#06F; text-align:center;">BOOKING DETAILS:<br/>
	Client: <span style="color:#cc1c0a; text-transform:uppercase;"><?=$_SESSION['cust_online']['name']?> <?=$_SESSION['cust_online']['lastname']?></span><br/>

	 Booking #: <span style="color:#cc1c0a; text-transform:uppercase;"><?=$_SESSION['cust_book']['ref']?></span> Villa No. <span style="color:#cc1c0a; text-transform:uppercase;"><?=$_SESSION['villa_details']['no']?> (<?=$_SESSION['villa_details']['bed']?> Bedrooms)</span><br/>

	 From:  <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['cust_book']['start'])))?></span> To: <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['cust_book']['end'])))?></span></h3>


<hr style="border: 1px solid #9c0000; clear:both;"/>


 <form name="new_villa" method="post"  action="confirm.php" >
 	<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>

 	<? $retalcars=$db->services("Car_Rental");?>
 	 <? foreach($retalcars as $rc){ if (in_array($rc['id'], $ids_services_booked)) {$serv['servicios']['carros']='no';}}?>
        <?/*=$serv['servicios']['carros'];*/?>
        <?/* echo "<pre>"; print_r($ids_services_booked); echo "</pre>";*/ ?>

	<? if($serv['servicios']['carros']!='no'){?>
		<? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Car_Rental', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="61" height="42"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
		<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">
		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">&nbsp;</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial; border-left:1px dotted #091cd0;border-right:1px dotted #091cd0;" colspan="2" align="center">Cost Low Season</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">&nbsp;</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">&nbsp;</td>
		</tr>
		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Vehicle type</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial; border-left:1px dotted #2671AA;">5 or Less&nbsp;</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;border-left:1px dotted #2671AA;border-right:1px dotted #2671AA;">6 or More</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Select</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Days</td>
		</tr>

	          <? foreach($retalcars as $rc){
					 // substr($rc['name'],0,15)
					 ?>
			  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

				<td valign="bottom" align="left">
				        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$rc['name']?> </p>
			  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0; border-left:1px dotted #2671AA;">
	           <?=number_format($rc['price'],2)?>
			  </td>
			  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;border-left:1px dotted #2671AA;border-right:1px dotted #2671AA;">
	           <?=number_format($rc['price_min'],2)?>
			  </td>
			  </td>
			  	<td align="center" >
			      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
			      <input name="cars" type="radio" value="<?=$rc['id']?>" />
				</td>
	    	  <td valign="middle" align="center"><span id="td0"></span><select  id="text_input" class="azul" style="text-align:right;font-size:10px;" name="qtydcars<?=$rc['id']?>" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"<?/* if ($post['fridge'] == $i) {echo " SELECTED";} */?>><?=$i;?></option>
		         <?
			   }
			   ?></select></td>
	       </tr>
	        <?
			  }
			 ?>
			 <tr><td colspan="5"><p style="color:#2671AA; padding:0;margin:0; font-weight:bold; text-transform:uppercase; font-size:11px;">* Price above do not include tax</p></td></tr>

			</table>
    <?}?>


     <? $fridge=$db->services("Filled Fridge");
        foreach($fridge as $f){ if (in_array($f['id'], $ids_services_booked)) {$serv['servicios']['fride']='no';}}?>


	<? if($serv['servicios']['fride']!='no'){?>

     <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Filled Fridge', $operator='=');?>
      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="41" height="32"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
     	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

	<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">FILLED FRIDGE type</td>
		<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST EACH TIME</td>

		<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

	</tr>

          <? foreach($fridge as $fridge){
				 // substr($rc['name'],0,15)
				 $nombre_compra=$fridge['name'];
				 $buscar=$_SESSION['villa_details']['bed'];

				 $busqueda=strpos($nombre_compra, $buscar);
				if ($busqueda!==false){
				 ?>
				  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

					<td valign="bottom" align="left">
					        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$fridge['name']?> </p>
				  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;">
		           <?=number_format($fridge['price'],2)?>
				  </td>

				  </td>
				  	<td align="center">
				      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
				      <input name="fridge" type="radio" value="<?=$fridge['id']?>" />
					</td>

		       </tr>
		        <?
		        }
		  }
		 ?>

		</table>
	<?}?>

         <? $masaje=$db->services("massage"); foreach($masaje as $m){ if (in_array($m['id'], $ids_services_booked)) {$serv['servicios']['massage']='no';}}?>


     <? if($serv['servicios']['massage']!='no'){?>
          <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='massage', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="71" height="42"><?=stripslashes($serv_t[0]['message'])?><a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	         	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">MASSAGE type</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER HOUR</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

		</tr>

	          <? foreach($masaje as $masaje){
					 // substr($rc['name'],0,15)
					 ?>
			  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

				<td valign="bottom" align="left">
				        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$masaje['name']?> </p>
			  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;">
	           <?=number_format($masaje['price'],2)?>
			  </td>
			  	<td align="center" >
			      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
			      <input name="massage" type="radio" value="<?=$masaje['id']?>" />
				</td>

	       </tr>
	        <?
			  }
			 ?>

			</table>

        <?}?>


		<? $chef=$db->services("chef");
		foreach($chef as $c){ if (in_array($c['id'], $ids_services_booked)) {$serv['servicios']['chef']='no';}}?>


     <? if($serv['servicios']['chef']!='no'){?>
			<? if($chef){?>
	        <!--// <p style=" color:#900; font-size:18px; clear:both;"><img src="images/forknife.png" height="42" width="33">Don't know how to cook? <a href="http://casalindacity.com/PAGES/Renting/Onsite%20Services/on_site_chef.php" target="_blank"/>More Information</a></p>//-->
	         <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='massage', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>"><?=$serv_t[0]['message']?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	         	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">
		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Chef Service</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER DAY</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>
		</tr>

	          <? foreach($chef as $chef){
					 // substr($rc['name'],0,15)
					 ?>
			  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

				<td valign="bottom" align="left">
				        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$chef['name']?> </p>
			  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;">
	           <?=number_format($chef['price'],0)?>
			  </td>
			  </td>
			  	<td align="center" >
			      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
			      <input name="chef" type="radio" value="<?=$chef['id']?>" />
				</td>
	       </tr>
	        <?
			  }
			 ?>

			</table>
	     <?}?>
     <?}?>






	<? $chofer=$db->services("Personal_Driver");
	  foreach($chofer as $c){ if (in_array($c['id'], $ids_services_booked)) {$serv['servicios']['chofer']='no';}}?>

    <? if($serv['servicios']['chofer']!='no'){?>
		 <? if($chofer){?>
	         <!--//<p style=" color:#900; font-size:18px; clear:both;"><img src="images/chofer.png" width="50">Need a personal driver? <a href="#" target="_blank"/>More Information</a></p>//-->
	          <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Personal_Driver', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="50" height="44"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	         	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">
		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Personal Driver</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER DAY</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="right">Days</td>
		</tr>

	          <? foreach($chofer as $chofer){
					 ?>
			  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

				<td valign="bottom" align="left">
				        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$chofer['name']?> </p>
			  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;">
	           <?=number_format($chofer['price'],2)?>
			  </td>
			  </td>
			  	<td align="center" >
			      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
			      <input name="chofer" type="radio" value="<?=$chofer['id']?>" />
				</td>
				<td align="right"><select  id="text_input" class="azul" style="text-align:right;font-size:10px;" name="qtydchofer<?=$chofer['id']?>" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"<?/* if ($post['fridge'] == $i) {echo " SELECTED";} */?>><?=$i;?></option>
		         <?
			   }
			   ?></select></td>
	       </tr>
	        <?
			  }
			 ?>

			</table>
	     <?}?>

    <?}?>



     <? $fridge=$db->services("Dish Washing Service");
      foreach($fridge as $c){ if (in_array($c['id'], $ids_services_booked)) {$serv['servicios']['dish']='no';}}?>

    <? if($serv['servicios']['dish']!='no'){?>

	  <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Dish Washing Service', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="41" height="32"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	     	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Dish Washing Service</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER DAY</td>

			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

		</tr>

          <? foreach($fridge as $fridge){
				 // substr($rc['name'],0,15)
				/* $nombre_compra=$fridge['name'];
				 $buscar=$_SESSION['villa_details']['bed'];

				 $busqueda=strpos($nombre_compra, $buscar);
				if ($busqueda!==false){  */
				 ?>
				  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

					<td valign="bottom" align="left">
					        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$fridge['name']?> </p>
				  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;">
		           <?=number_format($fridge['price'],2)?>
				  </td>

				  </td>
				  	<td align="center">
				      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
				      <input name="dish" type="radio" value="<?=$fridge['id']?>" />
					</td>

		       </tr>
		        <?
		        /*}*/
		  }
		 ?>

		</table>
     <?}?>



   <? $fridge=$db->services("Laundry");
    foreach($fridge as $c){ if (in_array($c['id'], $ids_services_booked)) {$serv['servicios']['laundry']='no';}}?>

    <? if($serv['servicios']['laundry']!='no'){
      if($fridge){      	  /*print_r($fridge);  */
      	?>
		<? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Laundry', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="41" height="32"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	     	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Laundry Service</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER BOOKING</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>
		</tr>

          <? foreach($fridge as $fridge){          	 $qty_nights=$_SESSION['total_noches'];
			 $laun_qty=explode('-', $fridge['description']);
             $laun_qty2=explode(' ', $laun_qty[1]);
			 if(($qty_nights>=$laun_qty[0])&&($qty_nights<=$laun_qty2[0])){
				 ?>
				  <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">

					<td valign="bottom" align="left">
					        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;"> <?=$fridge['name']?> </p>
				  <td align="center" style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#900; padding:0; margin:0;">
		           <?=number_format($fridge['price'],2)?>
				  </td>

				  </td>
				  	<td align="center">
				      <!--//<img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />//-->
				      <input name="laundry" type="radio" value="<?=$fridge['id']?>" />
					</td>

		       </tr>
		        <?
		     }
		  }
		 ?>

		</table>
      <?}
    }?>
       <hr style="border: 1px solid #9c0000; clear:both;"/>
         <p style="text-align:right;"><input class="boton" type="submit" name="services" value="Next"  /></p>

 </form>
