<?php
 if ($_POST['new_client']=="Continue booking"){ //if booking details have been post
	if (!$_SESSION['customer']){
		$_SESSION['C']['n']=$_POST['name'];
		$_SESSION['C']['ln']=$_POST['lastname'];
		$_SESSION['C']['p']=$_POST['passport'];
		$_SESSION['C']['c']=$_POST['cedula'];
		$_SESSION['C']['el']=$_POST['email'];
		$_SESSION['C']['ph']=$_POST['phone'];
		$_SESSION['C']['ph2']=$_POST['phone2'];
		$_SESSION['C']['fx']=$_POST['fax'];
		$_SESSION['C']['lg']=$_POST['language'];
		$_SESSION['C']['ad']=$_POST['address'];
		$_SESSION['C']['zp']=$_POST['zip'];
		$_SESSION['C']['cy']=$_POST['country'];
		$_SESSION['C']['pa']=$_POST['password'];
		$_SESSION['C']['ha']=$_POST['hear_about'];
		$_SESSION['C']['rn']=$_POST['referal_name'];
		$_SESSION['C']['ne']=$_POST['name_emerg'];
		$_SESSION['C']['phe']=$_POST['phone_emerg'];

		//-------------------------------------------
		$_SESSION['C']['state']=$_POST['state'];
		$_SESSION['C']['city']=$_POST['city'];
	}
	$_SESSION['C']['a']=$_POST['adults'];
	$_SESSION['C']['k']=$_POST['kids'];
// $_SESSION['total'];
 }
 if ($_SESSION['C']['n']) $_POST['name']=$_SESSION['C']['n'];
 if ($_SESSION['C']['ln']) $_POST['lastname']=$_SESSION['C']['ln'];
 if ($_SESSION['C']['el']) $_POST['email']=$_SESSION['C']['el'];

// $_POST['adults'];
?>



<p>&nbsp;</p>
<p>&nbsp;</p>
<link type="text/css" rel="stylesheet" href="steps/style.css">
 <div class="uiStepList pbs">
<ol>
	<li class="uiStep ">
        <div class="part back"></div>
        <div class="part middle">
        <div class="content">
        <div class="title fsl fwb fcb" style="color:#96a354;">Step 1</div>
        <span class="description" style="color:#96a354;">Services & more info</span></div>
        </div>
        <div class="part point"></div>
	</li>
	<li class="uiStep midleSelected" >
        <div class="part back"></div>
        <div class="part middle">
        <div class="content">
        <div class="title fsl fwb fcb" style="color:#96a354;" >Step 2</div>
        <span class="description" style="color:#96a354;" >Client and Booking details</span></div>
        </div>
        <div class="part point"></div>
	</li>
     <li class="uiStep uiStepSelected" >
          <div class="part back"></div>
          <div class="part middle">
              <div class="content">
             	 <div class="title fsl fwb fcb" >Step 3</div>
             	 <span class="description" >Guests names and confirm to pay</span>
          	   </div>
          </div>
          <div class="part point"></div>
	 </li>
</ol>
</div>
			 <!--//   codigo para promotion code//-->
			<?   $_POST['promotion_code']=trim($_POST['promotion_code']);

   			  if ($_POST['promotion_code']!=""){
   			 	$db= new getQueries;
                $this_pro=$db->show_active_limit1("promotion", "code", $_POST['promotion_code'], "=");
                $pro_found=$this_pro[0];
                if (!$pro_found){
                	$_GET['promotion_error']="Promotion code not found in our system.";
        	    }else{
                	//entonces hacer procedimientos de calculos con esta promocion
                    //$_GET['promotion_error']="Promotion encontrada id->".$pro_found['id'];
                    //variables
                    $inicia_pro=strtotime($pro_found['desde']);
                    $fin_pro=strtotime($pro_found['hasta']);

                    // echo $_POST['promotion_code']; echo "hasta:". $pro_found['hasta'];    echo "Hoy:".date('Y-m-d');
                    $today_date=strtotime(date('Y-m-d'));

                    //----------------------------------------------------------------------------------------
                   if ($fin_pro<=$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="We sorry this promotion is over now";
                   }
                    if ($inicia_pro>$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="This promotion is coming soon, not active yet.";
                   }

                   if ((($inicia_pro)<=($today_date))&&(($fin_pro)>=($today_date))){ //esta activa
                    //hacer calculos
                    $amount_nightsLS=($_SESSION['noches_LS']*$_SESSION['villa_details']['p_low']);
                    $amount_nightsHS=($_SESSION['noches_HS']*$_SESSION['villa_details']['p_high']);
                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

                     if  ($pro_found['tipo']=="2"){   //Amount
                      //vefiricar aqui que el monto no sea mayor que la renta, si es asi no descontar nada
                        if  ($pro_found['cant_porc']>=$amount_nights){   //Amount
                            $_GET['promotion_error']="This promotion is not applicable to this booking.";
                        }else{
                           $descuento=($pro_found['cant_porc']);
                           $variable_descuento="US$ ".$pro_found['cant_porc']." ";
                           $tipo_dsec="monto";
                           $promotion_code=$pro_found['code'];
                        }
                     }elseif($pro_found['tipo']=="1"){
                        $descuento=($amount_nights*($pro_found['cant_porc']/100));
                         $variable_descuento=number_format($pro_found['cant_porc'],0)." % ";
                         $tipo_dsec="porcient";
                         $promotion_code=$pro_found['code'];
                     }
                    $pro_id=$pro_found['id'];
                   }
                }
   			  }

			if ($_GET['promotion_error']){?>
			 	<div style="text-align:center; color:#080563; background-color:yellow;">Warning: <?=$_GET['promotion_error'];?></div>
			 <?}?>
			<!--//   codigo para promotion code//-->
<hr/>
<table width="90%" align="center">
	<tr>
        <td width="50%">
        <span style="font-weight:bold;">CUSTOMER:</span><br/>
        <?if (!$_SESSION['customer']){ ?>
	        <?=$_POST['name']?> <?=$_POST['lastname']?><br/>
	        <?=$_POST['email']?><br/>
	        <?=$_POST['phone']?><br/>
	        <?=$_POST['address']?><br/>
       <? }else{?>
	        <?=utf8_decode($_SESSION['customer']['name'])?> <?=utf8_decode($_SESSION['customer']['lastname'])?><br/>
	        <?=$_SESSION['customer']['email']?><br/>
	        <?=$_SESSION['customer']['phone']?><br/>
	        <?=utf8_decode($_SESSION['customer']['address'])?><br/>
       <? } ?>
        </td>
        <td>
        <span style="font-weight:bold;">BOOKING DETAILS:</span><br/>
        Villa No:<?=$_SESSION['villa_details']['no']?><br/>
        From: <?=formatear_fecha($_SESSION['desde'])?> <br/>
        To: <?=formatear_fecha($_SESSION['hasta'])?><br/>
        <?=$_POST['adults']?> adults <br/>
        <?=$_POST['kids']?> children<br/>

        </td>
	</tr>
</table>
<p>&nbsp;</p>
<table width="90%" align="center">
	<tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
        <span style="color:#06F; font-weight:bold;">ORDER DETAILS:</span>
        </td>
     </tr>
     <tr>
        <td align="right" >
        None-Peak Season <?=$_SESSION['noches_LS']?> nights x US$ <?=number_format($_SESSION['villa_details']['p_low'],2)?> = <br/>
        Peak Season <?=$_SESSION['noches_HS']?> nights x US$ <?=number_format($_SESSION['villa_details']['p_high'],2)?> =<br/>
          <!--//codigo promotion//-->
	    <? if (($descuento>0)&&($tipo_dsec=="monto")){?>
	       <input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
           <? $_SESSION['promotion_id']=$pro_id; ?>
	    <span style="text-align:right; color:green;">
	    	(<?=$promotion_code?>)	Discount =</span><br/>
	    <?}?>
	    <? if (($descuento>0)&&($tipo_dsec=="porcient")){?>
	    	<input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
             <? $_SESSION['promotion_id']=$pro_id; ?>
	       <span style="text-align:right; color:green;">
	    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> = </span><br/>
	    <?}?>

	     <!--//fin codigo promotion//-->

        <span style="font-weight:bold;">Sub-Total =</span><br/>

        VAT-TAX 16% =<br/>
         <!--SERVICES ADDITIONALS-->
	         <?  if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars']>0){
					$result= new getQueries;
						if ($_SESSION['massage']>0){
						$massage_details=$result->additional_service($_SESSION['massage'], 'massage');
						?>
						<span style="color:blue;">Massage <?=$massage_details['name'];?> =</span> <? $amount_massage=$massage_details['price']; ?><br/>

						<? } ?>

						 <?
						if ($_SESSION['pickup']>0){
						$pickup_details=$result->additional_service($_SESSION['pickup'], 'Airport Pick Up');
						?>
							<span style="color:blue;"><?=$pickup_details['name'];?> =</span><? $amount_pickup=$pickup_details['price'];  ?><br/>
						<? } ?>

					 	<?
						if ($_SESSION['VIPpickup']>0){
						$VIPpickup_details=$result->additional_service($_SESSION['VIPpickup'], 'VIP Airport Pick Up');
						?>
						<span style="color:blue;"><?=$VIPpickup_details['name'];?> =</span><? $amount_VIPpickup=$VIPpickup_details['price']; ?><br/>
						<? } ?>

						 <?
						if ($_SESSION['chef']>0){
						$chef_details=$result->additional_service($_SESSION['chef'], 'chef');
						?>
						<span style="color:blue;"> <?=$chef_details['name'];?> =</span><? $amount_chef=$chef_details['price']; ?><br/>
						<? } ?>

						<?
						if ($_SESSION['fridge']>0){
							$fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
						?>
						<span style="color:blue;">Filled Fridge <?=$fridge_details['name'];?> =</span><? $amount_fridge=$fridge_details['price']; ?><br/>
						<? }?>
						<? //empiezan los servicios para carros
						if ($_POST['cars']>0){
						$cars_details=$result->additional_service($_POST['cars'], 'Car_Rental');
						if ($_POST['qtydcars']<5){ $precio_renta_cars=$cars_details['price'];}else{$precio_renta_cars=$cars_details['price_min'];}
						?>
						<span style="color:blue;"><?=substr($cars_details['name'],0,15);?> (<?=$_POST['qtydcars']?> days at <?=$precio_renta_cars?>)=</span><? $amount_cars=$precio_renta_cars*$_POST['qtydcars'];?><br/><? $deta_carro=substr($cars_details['name'],0,15)." (".$_POST['qtydcars']." days at ".$precio_renta_cars." )"; ?>
	                   <!--// <input type="hidden" name="cars_id" value="<?=$_POST['cars'];?>" /> <input type="hidden" name="carros_online" value="<?=$deta_carro;?>" />
	             		<input type="hidden" name="cars_amount" value="<?=$amount_cars;?>" />
	             		<input type="hidden" name="cars_days" value="<?=$_POST['qtydcars'];?>" />//-->
						<? } ///terminan los servicios para carro

						$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup+$amount_cars); ?>
	                   Total additionals services=<br/>


			<?	}?>

	            <!--SERVICES ADDITIONALS-->
         <span style="font-weight:bold;">TOTAL =</span>
         <?
          $total_ls=($_SESSION['noches_LS']*$_SESSION['villa_details']['p_low']);
		  $total_hs=($_SESSION['noches_HS']*$_SESSION['villa_details']['p_high']);
		 ?>
        </td>
        <td align="right" width="105px">
        US$ <?=number_format($total_ls,2)?><br/>
        US$ <?=number_format($total_hs,2)?><br/>
        <!--//promotion code//-->
         <? if ($descuento>0){
          echo "<span style=\" color:green;\">US$ ".number_format($descuento,2)."</span><br/>";
         }?>
        <!--//promotion code//-->
        <span style="font-weight:bold;">
        US$ <? echo number_format((($total_ls+$total_hs)-$descuento),2); ?><br/>
        </span>


		US$ <? $sub_totales=(($total_ls+$total_hs)-$descuento); $itbis_desc=($sub_totales*0.16); $_SESSION['itbis']=$itbis_desc; echo number_format($itbis_desc,2)?><br/>
				<?  if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars']>0){

						if ($_SESSION['massage']>0){
							?>
						 <span style="color:blue;">US$ <? echo $amount_massage; ?> </span><br/>

						<? } ?>

						 <?
						if ($_SESSION['pickup']>0){

						?>
						<span style="color:blue;">US$ <?  echo $amount_pickup; ?></span><br/>
						<? } ?>

					 	<?
						if ($_SESSION['VIPpickup']>0){
						?>
						<span style="color:blue;">US$ <? $amount_VIPpickup=$VIPpickup_details['price']; echo $amount_VIPpickup; ?></span> <br/>
						<? } ?>

						 <?
						if ($_SESSION['chef']>0){
						?>
						<span style="color:blue;">US$ <? echo $amount_chef; ?></span> <br/>
						<? } ?>

						<?
						if ($_SESSION['fridge']>0){

						?>
						<span style="color:blue;">US$ <?  echo $amount_fridge; ?></span> <br/>
						<? }
						?>
						<?
						if ($_POST['cars']>0){

						?>
						<span style="color:blue;">US$ <?  echo $amount_cars; ?></span> <br/>
						<? } ?>
	                 US$ <?=number_format($sub_services,2); ?><br/>

				<?	}?>
		<span style="font-weight:bold;">
        US$ <?=number_format($sub_totales+$itbis_desc+$sub_services,2)?> <? $_SESSION['total']=$sub_totales+$itbis_desc+$sub_services;?>
        </span>

        </td>
	</tr>
</table>
<hr/>
<p style="color:red">Due to security reasons, please type the first and last names of all guests occupying the villa.</p>
<form action="booking_confirm.php" method="post" >
 <input type="hidden" name="cars_id" value="<?=$_POST['cars'];?>" />
 <input type="hidden" name="carros_online" value="<?=$deta_carro;?>" />
 <input type="hidden" name="cars_amount" value="<?=$amount_cars;?>" />
 <input type="hidden" name="cars_days" value="<?=$_POST['qtydcars'];?>" />

	<input type="hidden" name="massage_amount" value="<?=$amount_massage;?>" />
	<input type="hidden" name="pickup_amount" value="<?=$amount_pickup;?>" />
	<input type="hidden" name="VIPpickup_amount" value="<?=$amount_VIPpickup;?>" />
	<input type="hidden" name="chef_amount" value="<?=$amount_chef;?>" />
	<input type="hidden" name="fridge_amount" value="<?=$amount_fridge;?>" />
	<input type="hidden" name="services_amount" value="<?=$sub_services;?>" />
    <fieldset id="fieldsets"><legend id="legends"> <?=$_POST['adults']?>Adults Names </legend>
          <?
          if ($_SESSION['C']['a']){
          	$_POST['adults']=$_SESSION['C']['a'];
          }

          for ($i=1; $i<=$_POST['adults'];$i++){

               if ($i==1){
                  //$custom=new getQueries; $client_name=$custom->customer($client); //$cm=$client_name['name']." ".$client_name['lastname'];
                    ?>
                     <?if (!$_SESSION['customer']){ ?>
                    	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">(<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$_POST['name']?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$_POST['lastname'];?>" /></p>
                    <?}else{ ?>
                    	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">(<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=utf8_decode($_SESSION['customer']['name'])?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=utf8_decode($_SESSION['customer']['lastname']);?>" /></p>
                    <?}?>
              <? }else{  ?>
                   <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
                   (<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="" /></p>
              <?  } ?>
           <?} ?>
              </fieldset><br>

              <? if($_POST['kids']>0){?>
                   <fieldset id="fieldsets"><legend id="legends"> <?=$_POST['kids']?> Children Names </legend>
                  <? for ($i=1; $i<=$_POST['kids'];$i++){?>
                       <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
                        (<?=$i;?>) Name: <input type="text" size="25" name="c_name<?=$i;?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" />
                       </p>
                  <? }  ?>
                </fieldset>
              <? }?>
<p style="text-align:right; padding-right:12px;"><input id="boton" type="submit" name="confirm" value="Confirm Booking" onClick="return confirmSubmitText('Even if you do not have a paypal account you can pay with your debit or credit card. \n Are you sure you want to continue, payment will be apply?');"/></p>
</form>