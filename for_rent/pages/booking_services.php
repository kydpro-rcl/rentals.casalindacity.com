<!--///*<h3 style="color:#06F; text-align:center;">Booking Services</h3>*///-->
  <?
 if ( $_POST['excursions']){
 		//session excursiones
 		$_SESSION['excursions']=$_POST['excursions']; //almacenar un array con todos los ids de las excrusiones
        foreach($_POST['excursions'] AS $k){
         #  echo $k; echo '<br/>';
         //aduntos y niños
         $adultos="adults$k"; $ninos="kids$k"; //varialbes que determinan la cantidad de personas de la excursion
         if ($_POST[$adultos]==0 && $_POST[$ninos]==0){  //si no se eligieron cantidad asignar un adulto             $_POST[$adultos]=1; //cantidad de adultos es igual a 1         }
        // echo $_POST[$adultos]; echo '-'; echo $_POST[$ninos]; echo '<br/>';

         $_SESSION['excur'][$k]['adults']=$_POST[$adultos]; //cantidad de adultos para esta excursion
         $_SESSION['excur'][$k]['kids']=$_POST[$ninos];    //niños para esta excursion
         //price adult, price kids
         $aprecio="priceadults$k"; $nprecio="pricekids$k";   //variables para los precios de adultos y niños
         #echo $_POST[$aprecio];  echo '-';  echo $_POST[$nprecio]; echo '<br/>';
         $_SESSION['excur'][$k]['pa']=$_POST[$aprecio];    //precio por adulto en esta excursion
         $_SESSION['excur'][$k]['pc']=$_POST[$nprecio];    //precio por niño en esta excursion
         $exc_titulo="excus_title$k";//variable para el titulo de la excursion
         $_SESSION['excur'][$k]['title']=$_POST[$exc_titulo];    //precio por niño en esta excursion
        }
 }
 ?>


<?php

$db=new getQueries ();

?>

<h3 style="color:#06F; text-align:center;">BOOKING DETAILS:<br/>
	 <span style="color:#cc1c0a; text-transform:uppercase;">Villa No. <?=$_SESSION['villa_details']['no']?> (<?=$_SESSION['villa_details']['bed']?> Bedrooms)</span><br/>
	 From:  <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['desde'])))?></span> To: <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['hasta'])))?></span></h3>


<hr style="border: 1px solid #9c0000; clear:both;"/>


 <form name="new_villa" method="post"  action="booking_details.php" >
 	<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
	<!--//<fieldset><legend style="font-size:9px; color:#2671AA;text-transform:uppercase; font-weight:bold;">Additional Services</legend>//-->
	<?
	  $rantals_car=$db->show_all_active($table='carros', $order='id');
      /*echo "<pre>";
      print_r($rantals_car);
      echo "</pre>";
       */
	#$serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Car_Rental', $operator='=');

	/*if($serv_t){
	?>
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
	   <? $retalcars=$db->services("Car_Rental");?>
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
	         <option value="<?=$i?>"><?=$i;?></option>
	         <?
		   }
		   ?></select></td>
       </tr>
        <?
		  }
		 ?>
		 <tr><td colspan="5"><p style="color:#2671AA; padding:0;margin:0; font-weight:bold; text-transform:uppercase; font-size:11px;">* Price above do not include tax</p></td></tr>

		</table>
    <?}*/?>
         <!--// <p style=" color:#900; font-size:18px;"><img src="images/cart.png" height="32" width="41">We'll do the shopping for you! <a href="http://casalindacity.com/PAGES/Renting/Onsite%20Services/Filled_Fridge.php" target="_blank"/>More Information</a></p>//-->
         <div style="background-color:white; padding:5px; margin:5px;">
         <p>
         <?
          /*tempradas alta y baja de los carros*/
         if($rantals_car){?>
          <h1 style="text-transform:uppercase;">Car Rentals</h1>
          <table cellpadding="0px" style="border: 1px solid #9c0000;" width="100%"><tr>
	          <td><strong>Select</strong></td>
	          <td align="center"><strong>Details</strong></td>
	          <td><strong>Days</strong></td>
          </tr>
         <?
         foreach ($rantals_car AS $k) {
            $precio_carro=priceRentalCar($idCar=$k['id'], $start_date=$_SESSION['desde'], $qtyDays='1');
         ?>
			<tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#87a2fa';">
				<td>
					<input type="checkbox" value="<?=$k['id']?>" name="car[<?=$k['id']?>]" >
				</td>
				<td>
					<?=substr($k['name'], 0, 20);?>
					(US$ <?=number_format($precio_carro,0)?>)
				</td>
				<td>
					<select name="car_qty[<?=$k['id']?>]">
						<?for($i=1; $i<=50; $i++){?>
						<option value="<?=$i;?>" ><?=$i;?></option>
						<?}?>
					</select>
		 			<input type="hidden" name="car_price[<?=$k['id']?>]" value="<?=$precio_carro?>"/>
		 		</td>
		 	</tr>
		 <?
		 }
         ?>
		</table>
		<?
       }
        /*===================================================================================================*/

        ?>

         </p>
         </div>

         <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Filled Fridge', $operator='=');?>
      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="41" height="32"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
     	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

	<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">FILLED FRIDGE type</td>
		<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST EACH TIME</td>

		<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

	</tr>
	   <? $fridge=$db->services("Filled Fridge");?>
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
           <!--//<p style=" color:#900; font-size:18px; clear:both;"><img src="images/massage.png" height="42" width="71">Need a massage? <a href="http://casalindacity.com/PAGES/Renting/Onsite%20Services/Massage.php" target="_blank"/>More Information</a></p>//-->
          <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='massage', $operator='=');?>
      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="71" height="42"><?=stripslashes($serv_t[0]['message'])?><a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
         	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

	<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">MASSAGE type</td>
		<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER HOUR</td>
		<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

	</tr>
	  <? $masaje=$db->services("massage");?>
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
		<? $chef=$db->services("chef");?>
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

     <? $chofer=$db->services("Personal_Driver");?>
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
				 // substr($rc['name'],0,15)
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
	<!--//</fieldset>//-->
		<!--// <p style=" color:#900; font-size:18px;"><img src="images/cart.png" height="32" width="41">We'll do the shopping for you! <a href="http://casalindacity.com/PAGES/Renting/Onsite%20Services/Filled_Fridge.php" target="_blank"/>More Information</a></p>//-->
	         <? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Dish Washing Service', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="41" height="32"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	     	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Dish Washing Service</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER DAY</td>

			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

		</tr>
	   <? $fridge=$db->services("Dish Washing Service");?>
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

		<? $serv_t=$db->show_any_data_limit1($table='service_type', $field='tipo', $value='Laundry', $operator='=');?>
	      <p style=" color:#900; font-size:18px;"><img src="images/<?=$serv_t[0]['picture']?>" width="41" height="32"><?=stripslashes($serv_t[0]['message'])?> <a href="<?=$serv_t[0]['link']?>" target="_blank"/><?=$serv_t[0]['name_link']?></a></p>
	     	<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%"  style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px; padding-bottom:5px; padding-left:5px; margin-bottom:5px;">

		<tr ><td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;">Laundry Service</td>
			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">COST PER BOOKING</td>

			<td style="font-size:10px; text-transform:uppercase; font-weight:bold; font:arial;" align="center">Select</td>

		</tr>
	   <? $fridge=$db->services("Laundry");?>
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

        <p>Are you interested in information pertaining to purchase property in Residencial Casa Linda?&nbsp;<select name="buy" id="text_input"><option value="0">No</option><option value="1">Yes</option></select></p>
       <!--// <p>Type here any relevant information for this booking:<br/><textarea id="text_input"  cols="70" rows="5" name="comment" style="border-color: #acaaa7;  border-radius: 2px 2px 2px 2px; border-style: solid; border-width: 3px 1px 1px;"></textarea></p>//-->
       <hr style="border: 1px solid #9c0000; clear:both;"/>
         <p style="text-align:right;"><input class="boton" type="submit" name="services" value="Next"  /></p>

 </form>
