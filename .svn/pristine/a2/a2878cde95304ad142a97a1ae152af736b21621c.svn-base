<!--///*<h3 style="color:#06F; text-align:center;">Booking Services</h3>*///-->
<p>&nbsp;</p>
<p>&nbsp;</p>
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
<!--//<link type="text/css" rel="stylesheet" href="steps/style.css">//-->
<!--// <div class="uiStepList pbs">
<ol>
	<li class="uiStep uiStepFirst uiStepSelected">
        <div class="part back"></div>
        <div class="part middle">
        <div class="content">
        <div class="title fsl fwb fcb">Step 1</div>
        <span class="description">Services & more info</span></div>
        </div>
        <div class="part point"></div>
	</li>
	<li class="uiStep" >
        <div class="part back"></div>
        <div class="part middle">
        <div class="content">
        <div class="title fsl fwb fcb" style="color:#96a354;">Step 2</div>
        <span class="description" style="color:#96a354;">Client and Booking details</span></div>
        </div>
        <div class="part point"></div>
	</li>
     <li class="uiStep uiStepLast"  >
          <div class="part back"></div>
          <div class="part middle">
              <div class="content">
             	 <div class="title fsl fwb fcb" style="color:#96a354;">Step 3</div>
             	 <span class="description" style="color:#96a354;">Guests names and confirm to pay</span>
          	   </div>
          </div>
          <div class="part point"></div>
	 </li>
</ol>
</div>//-->

<?php

$db=new getQueries ();
  /*
if ($_POST['continuar']=="Choose this villa"){

	unset($_SESSION['total']); $_SESSION['total']=$_POST['g_total'];//$_SESSION['total']=number_format($_POST['g_total'],2);
	//echo "<br/>";
	unset($_SESSION['desde']); $_SESSION['desde']=$_POST['desde'];
	//echo "<br/>";
	unset($_SESSION['hasta']); $_SESSION['hasta']=$_POST['hasta'];
	//echo "<br/>";
	unset($_SESSION['total_noches']); $_SESSION['total_noches']=$_POST['T_nights'];
	//echo "<br/>";
	unset($_SESSION['noches_LS']); $_SESSION['noches_LS']=$_POST['LS_nights'];
	//echo "<br/>";
	unset($_SESSION['noches_HS']); $_SESSION['noches_HS']=$_POST['HS_nights'];
	unset($_SESSION['itbis']);$_SESSION['itbis']=$_POST['itbis'];// $_SESSION['itbis']=number_format($_POST['itbis'],2);
	unset($_SESSION['villa']); $_SESSION['villa']=$_POST['v'];
	unset($_SESSION['villa_details']);

		$informacion_villa=$db->villa($_SESSION['villa']);
		$_SESSION['villa_details']=$informacion_villa[0];
}
 */
?>

<h3 style="color:#06F; text-align:center;">CHOSEN VILLA FOR THIS BOOKING:<br/>
	 <span style="color:#cc1c0a; text-transform:uppercase;">Villa No. <?=$_SESSION['villa_details']['no']?> (<?=$_SESSION['villa_details']['bed']?> Bedrooms)</span><br/>
	 From:  <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['desde'])))?></span> To: <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_SESSION['hasta'])))?></span></h3>
 <p style="background-color:#FFF; color:#cc1c0a; font-size:18px;"><img src="images/addcar.jpg">Add a rental car and fuel up on savings</p>

<hr style="border: 1px solid #9c0000; clear:both;"/>

<p>&nbsp;</p>
 <form name="new_villa" method="post"  action="booking_details.php" >
 	<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>
	<fieldset><legend style="font-size:9px; color:#390;">Additional Services</legend>
   <table align="center" cellpadding="0" cellspacing="0" border="0">

    	<!--//<tr>
         	<td >
		        <? $retalcars=$db->services("Car_Rental");?>
		      <img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />
			</td>
			<td valign="bottom" align="center">
		      <select  class="azul" style="text-align:center" id="text_input" name="cars" size=1>
		       <option value="0" >None selected</option>
			   <? foreach($retalcars as $rc){
				 ?>
		         <option value="<?=$rc['id']?>"><?=substr($rc['name'],0,15)." ".number_format($rc['price'],0)?>-<?=number_format($rc['price_min'],0)?></option>
		         <?
			   }
			   ?></select><br /><a href="#" style="color:#390;" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/Rental%20Vehicles.php','','scrollbars=yes,width=600,height=300')"  alt="Read details">Read details</a></p>
		  </td>
    	  <td valign="middle" align="left"><span id="td0">Qty. days </span><select  id="text_input" class="azul" style="text-align:left" name="qtydcars" size=1>
		   <? for($i=1; $i<=90; $i++){
			 ?>
	         <option value="<?=$i?>"<? if ($post['fridge'] == $i) {echo " SELECTED";} ?>><?=$i;?></option>
	         <?
		   }
		   ?></select></td>
       </tr>//-->

       <? $retalcars=$db->services("Car_Rental");?>

          <? foreach($retalcars as $rc){
				 ?>
		  <tr>
         	<td >
		      <img src="images/services/vehcile_rentals.jpg" alt="Onsite Chef"  width="100" height="78" />
			</td>
			<td valign="bottom" align="center">
		      <select  class="azul" style="text-align:center" id="text_input" name="cars" size=1>
		       <option value="0" >None selected</option>

		         <option value="<?=$rc['id']?>"><?=substr($rc['name'],0,15)." ".number_format($rc['price'],0)?>-<?=number_format($rc['price_min'],0)?></option>
		        </select><br /><a href="#" style="color:#390;" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/Rental%20Vehicles.php','','scrollbars=yes,width=600,height=300')"  alt="Read details">Read details</a></p>
		  </td>
    	  <td valign="middle" align="left"><span id="td0"></span><select  id="text_input" class="azul" style="text-align:left" name="qtydcars" size=1>
		   <? for($i=1; $i<=90; $i++){
			 ?>
	         <option value="<?=$i?>"<? if ($post['fridge'] == $i) {echo " SELECTED";} ?>><?=$i;?></option>
	         <?
		   }
		   ?></select></td>
       </tr>
        <?
		  }
		 ?>
   		 <tr>
         	<td >
		        <? $fridge=$db->services("Filled Fridge");?>
		        <img src="images/services/filledfridge1.jpg" alt="Filled Fridge" width="100" height="78" /></span>
             </td>
             <td valign="middle" align="center">
		        <select class="azul" style="text-align:center" id="text_input" name="fridge" size=1>
		       <option value="0" >None selected</option>
			   <? foreach($fridge as $fridge){
				 ?>
		         <option value=<?=$fridge['id']?><? if ($post['fridge'] == $fridge['id']) {echo " SELECTED";} ?>><?=$fridge['name']." ".$fridge['price']?></option>
		         <?
			   }
			   ?></select><br /><a href="#" style="color:#390;" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/Filled_Fridge.php','','scrollbars=yes,width=600,height=600')" alt="Read details">Read details</a></p>
      	  </td>
            <td>&nbsp;</td>
         </tr>
   		 <!--//<tr>
         	<td >
		         <? $pickup=$db->services("Airport Pick Up");?>
		       <img src="images/services/airport1.jpg" alt="Airport pick up"  width="100" height="78" />
            </td>
            <td valign="middle" align="center">
		       <select class="azul" style="text-align:center"  id="text_input" name="pickup" size=1>
		       <option value="0" >None selected</option>
			   <? foreach($pickup as $pickup){
			     // echo $masaje['name']."<br>";
				 ?>
		         <option value=<?=$pickup['id']?><? if ($post['pickup'] == $pickup['id']) {echo " SELECTED";} ?>><?=$pickup['name']." ".$pickup['price']?></option>
		         <?
			   }
			   ?></select><br /><a href="#" style="color:#390;" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/airport_pickup.php','','scrollbars=yes,width=600,height=200')" alt="Read details">Read details</a></p>
            </td>
            <td rowspan="2" align="right">
               <fieldset><legend style="font-size:11px; color:#390;">Required only if some airport pick up selected</legend>
        		<p>Arrival Airline:<input id="text_input" type="text" name="aairline" value="" size="10"/>&nbsp;Departure Airline:<input id="text_input" type="text" name="dairline" size="10" value=""/></p>
        		<p>Arrival Date/Time:<input id="text_input" type="text" name="adatetime" size="10" value=""/>Departure Date/Time:<input id="text_input" type="text" name="ddatetime" size="10" value=""/></p>
     			</fieldset>
            </td>
         </tr>//-->
         <!--//<tr>
         	<td >
		        <? $VIPpickup=$db->services("VIP Airport Pick Up");?>
		       <img src="images/services/vip.jpg" alt="Airport VIP pick up"  width="100" height="78" /> </span>
            </td>
            <td valign="middle" align="center">
		       <select class="azul" style="text-align:center" id="text_input" name="VIPpickup" size=1>
		       <option value="0" >None selected</option>
			   <? foreach($VIPpickup as $VIPpickup){
			     // echo $masaje['name']."<br>";
				 ?>
		         <option value=<?=$VIPpickup['id']?><? if ($post['VIPpickup'] == $VIPpickup['id']) {echo " SELECTED";} ?>><?=$VIPpickup['name']." ".$VIPpickup['price']?></option>
		         <?
			   }
			   ?></select><br /><a href="#" style="color:#390;" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/VIP_AIRPORT.php','','scrollbars=yes,width=600,height=350')" alt="Read details">Read details</a>
         </td>
         </tr>//-->
   		<tr><td >
		       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
		       <? $masaje=$db->services("massage");?>
		       <img style="float:left;" src="images/services/massage1.jpg" alt="Onsite Massage"  width="100" height="78" />
		     </td>
             <td valign="middle" align="center">
		        <select class="azul" style="text-align:center"  id="text_input" name="massage" size=1>
		           <option value="0" >None selected</option>
			   <? foreach($masaje as $masaje){
			     // echo $masaje['name']."<br>";
				 ?>
		         <option value=<?=$masaje['id']?><? if ($post['massage'] == $masaje['id']) {echo " SELECTED";} ?>><?=$masaje['name']." ".$masaje['price']?></option>
		         <?
			   }
			   ?></select><br /><a style="color:#390;" href="#" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/Massage.php','','scrollbars=yes,width=400,height=300')" alt="Read details">Read details</a>
            </td>
            <td>&nbsp;</td>
         </tr>
         <tr>
         	<td >
		        <? $chef=$db->services("chef");?>
		      <img src="images/services/chef1.jpg" alt="Onsite Chef"  width="100" height="78" />
			</td>
			<td valign="middle" align="center">
		      <select  class="azul" style="text-align:center" id="text_input" name="chef" size=1>
		       <option value="0" >None selected</option>
			   <? foreach($chef as $chef){
				 ?>
		         <option value=<?=$chef['id']?><? if ($post['chef'] == $chef['id']) {echo " SELECTED";} ?>><?=$chef['name']." ".$chef['price']?></option>
		         <?
			   }
			   ?></select><br /><a href="#" style="color:#390;" onclick="MM_openBrWindow('http://casalindacity.com/PAGES/Renting/on_site_chef.php','','scrollbars=yes,width=600,height=400')"  alt="Read details">Read details</a></p>
		  </td>
    	  <td>&nbsp;</td>
       </tr>


       </table>

	</fieldset>

        <p>Are you interested in information pertaining to purchase property in Residencial Casa Linda?&nbsp;<select name="buy" id="text_input"><option value="0">No</option><option value="1">Yes</option></select></p>
        <p>Type here any relevant information for this booking:<br/><textarea id="text_input"  cols="70" rows="5" name="comment"></textarea></p>
       <hr style="border: 1px solid #9c0000; clear:both;"/>
         <p style="text-align:right;"><input class="boton" type="submit" name="services" value="Next"  /></p>

 </form>
