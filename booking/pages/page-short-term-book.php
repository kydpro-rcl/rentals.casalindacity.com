 <?
 quitar_evento();/*quita la session de evento en caso de que existiera antes*/
  if ($_SESSION['info']){
		$_SESSION['consultas']=new getQueries ();
		$_SESSION['subDB']=new subDB;
      /*//get details for pricing and week, month, long term setting.*/
     $prices_setting=$_SESSION['consultas']->show1_active('price_settings');
     if(!$prices_setting) die('There is not, price setting found');
     /*#print_r($prices_setting);*/
     /*//----------------------------------------------------------------*/
	 if (!$_POST){
	   	$villa=$_GET['villa'];
	   	$v2=$_GET['v2'];
	       if ($villa!=$v2){
			       /*// $villa1=new getQueries;*/
				   $villa1=$_SESSION['consultas'];
					$v1=$villa1->villa($villa);
					foreach($v1 as $keyv1)
					/*//echo $keyv1['no'];*/
					 $villa2=$_SESSION['consultas'];
					$v2=$villa2->villa($v2);
					foreach($v2 as $keyv2)
				/*//	echo $keyv2['no'];*/
			?>
	        <table border="0" cellpadding="0" cellspacing="0"><tr><td>
	        <img src="images/error.jpg" title="Error" alt="Error Villa" width="50" width="50" class="img_left"/></td><td><p class="error" style="color:#999">We sorry, There was an error: <span class="error">Different Villas Selected.</span></p></td>
	        <!--<hr />--></tr></table>


	        <br /><br /><br />
			<fieldset id="fieldset"><legend>Error Details</legend>
				<p class="p_azul">You can't choose: <strong>Starting villa No. <?=$keyv1['no']?></strong> and <strong>Ending villa No.<?=$keyv2['no']?></strong>, between dates.</p>
				<p class="p_azul">Please, go to <a href="booking-calendar.php">Calendar</a> and try again.</p>
				<p class="p_center"><img src="images/unallow_houses.png" title="Choose only one house" alt="Different Villas" /></p>
			</fieldset>

			<?
			echo "<img src=\"images/loading.gif\"/>";
			echo "We will be send you to Calendar in 5 seconds...";
			echo ("<meta http-equiv=\"refresh\" content=\"5;url=booking-calendar.php\">");
			require_once('template/footer1.php');
			/*//die("Villas Diferentes");*/
			exit();
			/*#die();*/
			}
           $end=$_GET['end']; $start=$_GET['start'];
			$result_dias=$_SESSION['subDB'];
			/* // $result_dias=new subDB;*/
			@  $noches=$result_dias->daysDifference($end,$start);  /*//say how many niths between ending date minus starting one*/
			/*//echo $a."noches";*/
			if ($noches==0){

				?>
	        <table border="0" cellpadding="0" cellspacing="0"><tr><td>
	        <img src="images/error.jpg" title="Error" alt="Error Villa" width="50" width="50" class="img_left"/></td><td><p class="error" style="color:#999">We sorry, There was an error: <span class="error">Dates are the Same.</span></p></td>
	        <!--<hr />--></tr></table>


	        <br /><br /><br />
			<fieldset id="fieldset"><legend>Error Details</legend>

	        <p class="p_azul">You can't choose: Starting at <strong><?=formatear_fecha($start);?> </strong>and Ending <strong> <?=formatear_fecha($end);?></strong>.</p>
	        <p class="p_azul">Please, go to <a href="booking-calendar.php">Calendar</a> and try again.</p>
			<p class="p_center"><img src="images/wrong_dates.png" title="Choose different dates" alt="Same dates" /></p>
	</fieldset>

			<?
			echo "<img src=\"images/loading.gif\"/>";
			echo "We will be send you to Calendar in 3 seconds...";
			echo ("<meta http-equiv=\"refresh\" content=\"3;url=booking-calendar.php\">");
			/*#die();*/

				}

			if ($noches<0){
					$fecha_start=strtotime($start);
					$fecha_end=strtotime($end);
			  		/*//  $fecha_inicio1=date('Y-m-d', $fecha_inicio);*/
					$fecha1=date('D. F j, Y', $fecha_start);
					$fecha2=date('D. F j, Y', $fecha_end);
				?>
	        <table border="0" cellpadding="0" cellspacing="0"><tr><td>
	        <img src="images/error.jpg" title="Error" alt="Error Villa" width="50" width="50" class="img_left"/></td><td><p class="error" style="color:#999">We sorry, There was an error: <span class="error">Problem with dates.</span></p></td>
	        <!--<hr />--></tr></table>


	        <br /><br /><br />
			<fieldset id="fieldset"><legend>Error Details</legend>
				<p class="p_azul">You can't choose: Starting date <strong><?=formatear_fecha($start);?> </strong>and Ending <strong> <?=formatear_fecha($end);?></strong>.</p>
				<p class="p_azul">Note: <strong>Ending date must be later than starting date.</strong></p>
				<p class="p_azul">Please, go to <a href="booking-calendar.php">Calendar</a> and try again.</p>
				<p class="p_center"><img src="images/wrong_dates.png" title="Choose different dates" alt="Same dates" /></p>
			</fieldset>

			<?
			echo "<img src=\"images/loading.gif\"/>";
			echo "We will be send you to Calendar in 3 seconds...";
			echo ("<meta http-equiv=\"refresh\" content=\"3;url=booking-calendar.php\">");


			}

			if ($noches>0){/*// STARTING PROCCESS WHEN ALL IS RIGHT*/
			  $o=$_SESSION['consultas'];
			  /*//if villa is busy in that period*/
              $busy=$o->see_occupancy_for_a_period($villa, $start, $end);

		              /*//VERIFY PERIOD############################################################################*/

						$fecha_rota=explode('-',$start);
						$fecha_rota2=explode('-',$end);
						$mes=$fecha_rota[1]; $year=$fecha_rota[0];
			           /*//   $busy=$db->busy_availability_noID($villa_id, $mes, $year, $reserveid);//debe seleccionarse una reserva sin escoger esta para comparar*/
			           $counting=0;
		               /*//VARIABLES*/
		               $AI=$fecha_rota[0];
		               $MI=$fecha_rota[1];
		               $DI=$fecha_rota[2];
		               $AF=$fecha_rota2[0];
		               $MF=$fecha_rota2[1];
		               $DF=$fecha_rota2[2];

			        foreach ($busy as $occ){

				               $alojamiento=strtotime($year."-".$mes."-".($fecha_rota[2]+$i));
				               $f_a=date('Y-m-d',$alojamiento);
				              for ($z=$AI; $z<=$AF; $z++){ /*//a�os*/
				              	if ($z==$AI){$mes_inicial=$MI;}else{$mes_inicial=1;}
				              	if ($z==$AF){$mes_final=$MF;}else{$mes_final=12;}

				                for ($m=$mes_inicial; $m<=$mes_final; $m++){ /*//meses*/

				                	if (($z==$AI)&&($m==$MI)){ $dia_inicial=$DI; }else{$dia_inicial=1; }
				                	if (($z==$AF)&&($m==$MF)){ $dia_final=$DF; }else{ $dia_final=ultimoDia($m,$z); }
				                   for ($x=$dia_inicial; $x<=$dia_final; $x++){ /* //dias*/
				                        $contador=$x;
					      				if (($z==$AF)&&($m==$MF)&&($x==$DF)){$contador--;}/*//para que se pueda tomar el mismo dia que empieza otra*/
					      				$estadia=strtotime($z."-".$m."-".$contador);
				               			$f_a=date('Y-m-d',$estadia);
									   if ((strtotime($f_a))==(strtotime($occ['start']))){
										   echo "<h2>Error: Busy period selected</h2>";
										   die();
									   }
									}/*//fin dias*/
								 }/*//fin meses*/
							   }/*//fin de los a�os*/
					} /*//fin ocupaciones*/
						/*//VERIFY ####################################################################################*/
			/*//if everything is right on the selections*/
					$r=$o->villa($villa);
					foreach($r as $k)
					/*//echo $k['no'];
				//	echo $k['no'];*/
				$_SESSION['info_villa']=$k;
				$_SESSION['noches']=$noches;
			   if (!$_GET['destine']){
			   ?>
	          <!-- <img src="images/logo.gif" border="0" style="float:left"> -->
	            <h2 style="text-align:center; color:#06C;">Starting occupability</h2>
	             <hr>
	             <p>&nbsp;</p>
			  <table align="center"><tr><td  valign="middle" width="300">
	          <fieldset id="fieldset"><legend>Villa Details</legend><img width="153" height="103" style="float:left; padding-right:5px; padding-bottom:5px;" src="<?=$k['pic']?>" border="0" align="Villa No. <?=$k['no']?>" title="Villa No. <?=$k['no']?>" />
	           <p id="td0"><strong>Villa No:</strong><span class="azul"> <?=$k['no']?></span></p>
	           <p id="td0"><strong>Villa Type:</strong><span class="azul"> <?=$k['type']?></span></p>
	           <p id="td0"><strong>Dimensions:</strong><br /><span class="azul"> <?=number_format($k['ft2'])?> ft&sup2;</span> / <span class="azul"><?=$k['m2']?> m&sup2;</span></p>
	           <p id="td0"><strong><!--Maximum-->Max. People:</strong> <span class="azul"><?=$k['capacity']?> persons</span></p>

	            <p id="td0" style="clear:both"><strong>Bedrooms: </strong><span class="azul"><?=$k['bed']?></span><br />
	           <strong>Bathrooms: </strong><span class="azul"><?=$k['bath']?></span><br />
	            <strong>Airconditioners: </strong><span class="azul"><?=$k['AC']?></span></p>
	             <?
					$owner=$o->show_id('owners', $k['id_owner']);
				/*//	foreach($owner as $ow)*/
	              ?>
	            <p id="td0"><strong>Owner: </strong><span class="rojo"><? echo $owner[0]['name'].' '.$owner[0]['lastname'];?></span></p>
	            <?

	            $k['p_low']=special_event(date('Y-m-d',strtotime($start)), date('Y-m-d',strtotime($end)), $k['p_low']);
	            $k['p_high']=special_event(date('Y-m-d',strtotime($start)), date('Y-m-d',strtotime($end)), $k['p_high']);
	            ?>
	            <p id="td0" style="text-align:right; padding-right:10px;"><strong>Price per Night: </strong><span class="azul">Low season US$ <?=number_format($k['p_low'], 2);?></span> </p>
	           <p id="td0" style="text-align:right; padding-right:10px;"><strong>Price per Night: </strong><span class="azul">Hight season US$ <?=number_format($k['p_high'], 2);?></span></p>
	            </fieldset>
			   </td><td width="300"><fieldset id="fieldset"><legend>Time Selected</legend>
	           <!-- <a href="nights.php" target="_blank">New customer</a>-->
	           <br />
			     <form name="reserva" method="post" action="<?php echo $PHP_SELF;?>">

			      <input type="hidden" name="nights" value="<?=$noches?>" />
			       <input type="hidden" name="villa_id" value="<?=$villa?>" />
	             <?

					$fecha1=formatear_fecha($start);
					$fecha2=formatear_fecha($end);

				 ?>
				   <input type="hidden" name="start" value="<?=$start;?>" />
			       <input type="hidden" name="end" value="<?=$end?>" />
	              <table>
	              <tr><td id="td0">Villa selected: </td><td class="big"><strong>Villa No. <?=$k['no']?> </strong> </td></tr>
	              <tr><td id="td0">From:</td><td class="big"><strong> <?=$fecha1?></strong></td></tr>
	              <tr><td id="td0">To:</td><td class="big"><strong> <?=$fecha2?></strong></td></tr>
	              <tr><td id="td0">Nights between period:</td><td class="big"> <strong><?=$noches?> nights</strong></td></tr>
	              <tr><td colspan="2">
	              <hr />
					<? if (($_GET['dest']!="owner")&&($_GET['dest']!="mantenimiento")){/* echo $_GET['dest']*/ ?>
		              <fieldset>
		              <p style="text-align:center"><span id="fields" >Is this customer new?</span></p>
		              <p style="text-align:center;">
		              	<input onclick="windowOpener('550','800','New_Client','referal_customer.php');this.disabled=true; this.value='Client...';" class="book_but" type="button" name="new_client" value="Create Customer" title="Create a new client">
		              </p>
		               </fieldset>
	                  <?}?>
	              <p id="fields" style="text-align:center"> What To Do With Selected Period?</p></td></tr>
			      <tr><td colspan="2" align="center">
			      <select name="destination" onchange="window.location='short-term-book.php?villa=<?=$villa?>&v2=<?=$villa?>&start=<?=$start;?>&end=<?=$end?>&dest='+this.value">

	                   <!--///*onchange="window.location='articulos.php?c='+this.value"*///-->
	        	  <? if ($_SESSION['info']['level']<=1){?>
	               	  <option value="mantenimiento" <? if ($_GET['dest']=="mantenimiento") echo "selected=selected"?> >Maintenance</option>
	              <?}?>

				  
				  
	              <? if ($noches>=$prices_setting['long_m_night']){?>
	               	  	<? if ($k['long_able']!=1){/*solo si esta disponible para renta a largo plazo*/?>
                     		 <option value="long"  <? if (($_GET['dest']=="long")||(!$_GET['dest'])) echo "selected=selected"?> >Long Term Rental</option>
                     		 <option value="long_owner" <? if (($_GET['dest']=="long_owner")||(!$_GET['dest'])) echo "selected=selected"?>>Long Term Rental Owner</option>
                      	<?}?>
                      	<option value="Buyer" <? if (($_GET['dest']=="Buyer")||(!$_GET['dest'])) echo "selected=selected"?>>Buyer Long</option>
						<option value="regular" >Short Term Rental</option>
               	  <?}else{
               	  	/*if ($_SESSION['info']['manager']==1){
                        ?>
                         <option value="long"  <? if (($_GET['dest']=="long")||(!$_GET['dest'])) echo "selected=selected"?> >Long Term Rental</option>
                         <option value="long_owner" <? if (($_GET['dest']=="long_owner")||(!$_GET['dest'])) echo "selected=selected"?>>Long Term Rental Owner</option>

                        <?
						}*/

               	}?>
					  <option value="regular" <? if (($_GET['dest']=="regular")||(!$_GET['dest'])) echo "selected=selected"?>>Short Term Rental</option>
               	  	  <option value="Buyers" <? if (($_GET['dest']=="Buyers")) echo "selected=selected"?>>Buyer Short</option>
	               	  <option value="owner"  <? if ($_GET['dest']=="owner") echo "selected=selected"?> >Owner, Short Term</option>	
					  <option value="TB" <? if (($_GET['dest']=="TB")) echo "selected=selected"?>>Try and Buy</option>
				
				   <? 
				   if ($noches>=$prices_setting['mid_m_night']){?>
                     	<option value="mid"  <? if (($_GET['dest']=="mid")||(!$_GET['dest'])) echo "selected=selected"?> >Mid Term Rental</option>
               	  <?php 
				  }
				  ?>
			      </select>
			      <input type="hidden" name="price" value="<?=$k['p_low']?>">  <!--SUPONIENDO QUE ES TEMPORADA BAJA-->

			     <input  class="book_but" type="submit" name="next" value="Next" title="Go to next step"></td></tr></table>
			     </form>
			   </fieldset>
	           </td></tr></table>
	            <?
	           }
			}
	 }
  /*//  echo $_POST['destination'];*/
    if ($_GET['destine']){
    	$destine=$_GET['destine'];

    }else{
		$destine=$_POST['destination'];

	}

	function maidLong($maid, $sel=0){
	 $casa['p_in_clear']=$maid;
		?>
			<select  class="azul" style="text-align:right" name="maid" size=1>
	       	<option value="<?=$casa['p_in_clear']?>" <? if($sel==1){?> selected="selected"<?}?>>Full (<?=$casa['p_in_clear']?>)</option>
	       	<option value="<?=$casa['p_in_clear']*0.7?>"   <? if($sel==2){?> selected="selected"<?}?> >3 days (<?=$casa['p_in_clear']*0.7?>)</option>
			<option value="<?=$casa['p_in_clear']*0.4?>"  <? if($sel==3){?> selected="selected"<?}?> <? if($sel==0){?> selected="selected"<?}?>>2 days (<?=$casa['p_in_clear']*0.4?>)</option>
			<option value="0.00" >None</option>
			 
	       	 <? /*switch($casa['bed']){
                	case 2: echo "<option value=\"50.00\" >A day per week (50.00)</option>";
                			echo "<option value=\"125.00\" >Two days per week (125.00)</option>";
                			break;
                	case 3: echo "<option value=\"60.00\" >A day per week (60.00)</option>";
                			
                			break;
                	case 4: echo "<option value=\"70.00\" >A day per week (70.00)</option>";
                			
                			break;
                	case 6: echo "<option value=\"100.00\" >A day per week (100.00)</option>";
                		
                			break;
	       	 }*/

	       	 ?>
	       	</select>
			<?
	}
	function poolLong($pool, $sel=0, $owner=0){
	 $casa['p_out_clear']=$pool;
	?>
		 <select name="pool_garden">
				<option value="<?=$casa['p_out_clear']?>" <? if($sel==0){?> selected="selected"<?}?><? if($sel==1){?> selected="selected"<?}?>>Full <?=$casa['p_out_clear']?></option>
				<option value="<?=($casa['p_out_clear']*0.70)?>"  <? if($sel==0){?> selected="selected"<?}?> >3 days (<?=($casa['p_out_clear']*0.70)?>)</option>
				<?
				if($owner==3){?>
				<option value="0.00"  <? if($sel==2){?> selected="selected"<?}?> >None</option>
				<?
				}
				?>
				
		   </select>
		   <?
	}
	
	


	  switch ($destine) {
	    case "mantenimiento":
	      /*//  echo "i equals 0";*/
	      $price_default=$_SESSION['info_villa']['p_low'];
	       $qty_nights=$_SESSION['noches'];
	       /*#$qty_nights=$noches;*/
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }
	       $casa=$_SESSION['info_villa'];
			/*//echo  $_SESSION['info']['id'];*/
		  ?>
		  	<script language="javascript" src="js/formfields.js"></script>
			<script language="javascript" src="js/formvalidation.js"></script>
		  <h2 style="text-align:center; color:#06C;">Making villa out of service</h2>
		  <hr />

		  <div class="book_inserted1" style="padding:7px 0px 12px 0px;">
	 	<p class="bloques">Villa No.:<span class="info_details"> <?=$casa['no']?></span></p>
	 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
	 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
	 </div><!--END SHOWING DATES AND VILLA-->

		 <div style="text-align:center; width:400px; margin:0 auto;" >

		  <form method="post" name="maintenance" action="maintenance_book.php" onsubmit="return(check(this));">
		  	<div id="globalmsg" align="center"></div>
		  	<input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       	<input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       	<input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       	<input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       	<input type="hidden" name="villa_no" value="<?=$casa['no']?>" />
           	<p id="fields" style="text-align:left;"><span style="font-size:14px; color:#000000;">Reasons:</span><br/>
           		<textarea name="reasons" cols="60" rows="15" valtype="mandatory" valmsg="* reasons required" valgrp="contactfrm" ></textarea>&nbsp;<span
class="form_err" id="reasonsm">*</span>
           	<br/>
	      	<input class="book_but" type="submit" name="confirm" value="Confirm" /></p>
	      </form>
		 </div>
		  <?
	        break;
	    case "regular":
			/*//header('location:regular_reserves.php');
	       // echo "i equals 1";*/
	       $price_default=$_SESSION['info_villa']['p_low'];
	       /*//--------------------high season and low season prices-----*/
	       $price_LS=$_SESSION['info_villa']['p_low'];
	       $price_HS=$_SESSION['info_villa']['p_high'];


	       /*//---------------------------------------------------------*/
	       $qty_nights=$_SESSION['noches'];
	       /*#$qty_nights=$noches;*/
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }

           $price_default=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_default);
           $price_LS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_LS);
	       $price_HS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_HS);

           /*//-----------------------apply weekly and monthly rate-------------------------------------------------------------*/
             $nights_qty=daysDifference2(date('Y-m-d',strtotime($ending_date)), date('Y-m-d',strtotime($starting_date)));
             /*$price_default=price_rent($nights_qty, $normal_price=$price_default);
             $price_LS=price_rent($nights_qty, $normal_price=$price_LS);
             $price_HS=price_rent($nights_qty, $normal_price=$price_HS);*/
           /*//----------------------end apply weekly and monthly rate----------------------------------------------------*/


	      $selected_villa_id=$_SESSION['info_villa']['id'];
	     /* //--------------starting and ending dates --------------*/
	     $fecha_empiezas=date_to_insert($starting_date);
	     $fecha_termina=date_to_insert($ending_date);
         /* //----------------------- hight and low seasons dates ------------*/

		   $casa=$_SESSION['info_villa'];
		   ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:#06C;">Short Term Rental Booking</h2><hr />
	       <form method="post" action="short-term-book2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
		 if (is_date($fecha_empiezas)){
		 	if (is_date($fecha_termina)){


				$db= new getQueries ();
				  $p=$db->get_season3_prices($startdate=$fecha_empiezas, $pricelow=$casa['p_low'], $priceshoulder=$casa['p_shoulder'], $pricehigh=$casa['p_high']);	
				  /*echo "<pre>";
				  print_r($p);
				  echo "</pre>";*/
					if($p['price']==0){
					    //if the villa price for that season is 0 or there is problems with seasons getting price, do not continue.
						die('Fatal Error: There is a pricing error, please try again.');
					}
					 $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);  
					 $price_default=$p['price'];
					 $price_LS=$p['price'];
					 $price_HS=$p['price'];
				/*$season=$db->show_id('seasons', 1);
				//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)

				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];

				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);
				 $LS_inicio=explode('-', $inicio_t_baja);
				 $LS_fin=explode('-', $fin_t_baja);
				$Fecha_Inicio=explode('-', $fecha_empiezas);
				$Fecha_Final=explode('-', $fecha_termina);
				// ---------------------------------------------
				$MI=$Fecha_Inicio[1];   //Mes inicio
				$DI=$Fecha_Inicio[2];   //dia inicio
				$AI=$Fecha_Inicio[0];  //a�o inicio

				$MF=$Fecha_Final[1];  //mes final
				$DF=$Fecha_Final[2];  //dia final
				$AF=$Fecha_Final[0];  //a�o final

				$MIHS=$HS_inicio[1];  //mes inicio HS
				$DIHS=$HS_inicio[2];   //dia inicio HS
				$AIHS=$HS_inicio[0];   //a�o inicio HS

				$MFHS=$HS_fin[1];    //mes final HS
				$DFHS=$HS_fin[2];   //Dia final HS
				$AFHS=$HS_fin[0];   //a�o final HS

				 //================================================================================
				  $temporada_alta_mes_dia=array();  //array than content all the month and day of HS

				 //SOLO SI FECHA DE INICIO DE HS IS MAYOR FINAL, SINO ERROR (WEBMASTER)
				 if ($AIHS==$AFHS){
				 	echo "Error year1:Seasons";
				 	die();
				  //echo "el mismo year";

				 }elseif(($AIHS+1)==$AFHS){ //a�o de inio de HS es uno anterior al que termina
				   // echo "diferente year";
				   $m=0;
				   $x=0;
				  // echo "year inicio:"; echo "<br/>";
				   for ($m=$MIHS; $m<=12; $m++){   //meses


				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias
				     #echo "mes:".$m." dia:".$x;
				     #echo "<br/>";
				     	$HS_array=array('mes'=>$m,'dia'=>$x);

					     array_push($temporada_alta_mes_dia,$HS_array);

				    }
				   }
				   //proximo a�o
				   $m=0;
				   $x=0;
				  // echo "year fin:"; echo "<br/>";
				    for ($m=1; $m<=$MFHS; $m++){  //meses

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){ //dias
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);
				     // echo "mes:".$m." dia:".$x;
				     // echo "<br/>";
				    }
				   }

				  //TERMINO DE ESCRIBIR LOS MES CON SUS DIAS CORRESPONDIENTE A LA TEMPORADA ALTA

				   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);

				  //INICIO PROCESO CON LAS FECHAS SELECCIONADAS PARA ESTA RESERVA A DETERMINAR LOS HS Y LS
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){//a�os
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){//meses
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){//dias

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }

				 }else{
				 	echo "Error year:Seasons";
				 	die();

				 }*/


			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }


			$LS_nights=($night_qty);          $HS_nights=0;

			if (($LS_nights=="0")&&($HS_nights>=
			"1")){    /*//solo HS*/
             ?>
            	<? if ($_SESSION['info']['level']==1){?>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="price" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceHS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="price" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}elseif(($HS_nights=="0")&&($LS_nights>="1")){ /*//solo LS*/
             ?>
	             <? if ($_SESSION['info']['level']==1){?>
		       		Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		<input type="hidden" name="priceHS" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	<input type="hidden" name="priceHS" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?

			}else{ /*//existen ambas*/
                 ?>
             	<? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	PriceLH&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}
/*//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------*/
           ?>
          <!--// promotion code//-->
             <br>
             Apply promotion: <select name="applypro">
				<option value="1" selected="selected"> No</option>
				<option value="2" > Yes</option>
				</select>
			 <!--code:<input type="text" size="7" name="promotion_code" />-->
           <!--// promotion code//-->
	       </p>
	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Additional Services</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
	       <div style="height:174px; overflow:auto;">
	       <?
		   $servicios=$_SESSION['consultas']->show_all($table='services', $order='id');
			servicios_reserva($servicios,$qty_nights, $beds=$casa['bed']);
			
			
            $servicios_activos=$_SESSION['consultas']->show_all_active('serv_add', 'id');
            /*//falta arreglar los servicios de laundry que se calculan de acurdo a la cantidad de dia de la reserva*/
			nuevo_servicios_bookings($servicios_activos,$qty_nights);
			/*selectServices($start_date=$starting_date);*/
           ?>
           </div>
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=($casa['capacity']/2);$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size=1 required="required">
			 <option value="">None</option>
			 <? foreach ($customers as $cu ) {    /* //$owner as $k => $v*/
								?><option value=<?=$cu['id']?><? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)<?/*=utf8_encode($cu['name'])." ".utf8_encode($cu['lastname'])*/?></option>
								<?
			 } ?></select><!-- <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onclick="reserva('new-client1.php','Creat a new client', 530, 800)">New customer</a></span>&nbsp;&nbsp;&nbsp;--></p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="4" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="1" checked="checked">Checking in
				     <input type="radio" name="status" value="2">Confirmed
				     <input type="radio" name="status" value="3" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="2" >Confirmed
				     <input type="radio" name="status" value="3" checked="checked">No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="1" checked="checked">Checked in
				  <?}?>
		      </span>
		<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  /*//starting referals   $_SESSION['consultas']*/
						//$commisioners=$_SESSION['consultas']->show_all('commission', 'name');  /*///elegir solo los activos*/
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  /*///elegir solo los activos*/
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							/*//ending referals*/
				?>

		      <!--///*REFERAL AGENTS*///-->
		<?php }?>
	      </p>
	       <?/*=expedia_fields($id_exp='', $amount_exp='');*/?>
	     <!--// <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->
	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>
	   <!--INFORMACIONES DE LA RENTA TERMINAN-->

	      <?
	        break;
			
			//====================================================INICIO CODIGO PARA TRY AND BUY===========================================================
			
		case "TB":
			/*//header('location:regular_reserves.php');
	       // echo "i equals 1";*/
	       $price_default=$_SESSION['info_villa']['p_low'];
	       /*//--------------------high season and low season prices-----*/
	       $price_LS=$_SESSION['info_villa']['p_low'];
	       $price_HS=$_SESSION['info_villa']['p_high'];


	       /*//---------------------------------------------------------*/
	       $qty_nights=$_SESSION['noches'];
	       /*#$qty_nights=$noches;*/
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }

           $price_default=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_default);
           $price_LS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_LS);
	       $price_HS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_HS);

           /*//-----------------------apply weekly and monthly rate-------------------------------------------------------------*/
             $nights_qty=daysDifference2(date('Y-m-d',strtotime($ending_date)), date('Y-m-d',strtotime($starting_date)));
             /*$price_default=price_rent($nights_qty, $normal_price=$price_default);
             $price_LS=price_rent($nights_qty, $normal_price=$price_LS);
             $price_HS=price_rent($nights_qty, $normal_price=$price_HS);*/
           /*//----------------------end apply weekly and monthly rate----------------------------------------------------*/


	      $selected_villa_id=$_SESSION['info_villa']['id'];
	     /* //--------------starting and ending dates --------------*/
	     $fecha_empiezas=date_to_insert($starting_date);
	     $fecha_termina=date_to_insert($ending_date);
         /* //----------------------- hight and low seasons dates ------------*/

		   $casa=$_SESSION['info_villa'];
		   ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:#06C;">Try and Buy Renters</h2><hr />
	       <form method="post" action="short-term-TB2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
		 if (is_date($fecha_empiezas)){
		 	if (is_date($fecha_termina)){


				$db= new getQueries ();
				
				$p=$db->get_season3_prices($startdate=$fecha_empiezas, $pricelow=$casa['p_low'], $priceshoulder=$casa['p_shoulder'], $pricehigh=$casa['p_high']);	
				  /*echo "<pre>";
				  print_r($p);
				  echo "</pre>";*/
					if($p['price']==0){
					    //if the villa price for that season is 0 or there is problems with seasons getting price, do not continue.
						die('Fatal Error: There is a pricing error, please try again.');
					}
					 $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);  
					 $price_default=$p['price'];
					 $price_LS=$p['price'];
					 $price_HS=$p['price'];
				/*$season=$db->show_id('seasons', 1);
				

				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];

				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);
				 $LS_inicio=explode('-', $inicio_t_baja);
				 $LS_fin=explode('-', $fin_t_baja);
				$Fecha_Inicio=explode('-', $fecha_empiezas);
				$Fecha_Final=explode('-', $fecha_termina);
		
				$MI=$Fecha_Inicio[1];   
				$DI=$Fecha_Inicio[2];   
				$AI=$Fecha_Inicio[0]; 

				$MF=$Fecha_Final[1];  
				$DF=$Fecha_Final[2]; 
				$AF=$Fecha_Final[0];  

				$MIHS=$HS_inicio[1]; 
				$DIHS=$HS_inicio[2];   
				$AIHS=$HS_inicio[0];   

				$MFHS=$HS_fin[1];   
				$DFHS=$HS_fin[2];   
				$AFHS=$HS_fin[0];   

				
				  $temporada_alta_mes_dia=array();  

				 if ($AIHS==$AFHS){
				 	echo "Error year1:Seasons";
				 	die();
				  

				 }elseif(($AIHS+1)==$AFHS){ 
				   $m=0;
				   $x=0;
				
				   for ($m=$MIHS; $m<=12; $m++){     


				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  
				
				     	$HS_array=array('mes'=>$m,'dia'=>$x);

					     array_push($temporada_alta_mes_dia,$HS_array);

				    }
				   }
				 
				   $m=0;
				   $x=0;
				 
				    for ($m=1; $m<=$MFHS; $m++){     

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){     
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);
				   
				    }
				   }

				

				   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);

				 
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }

				 }else{
				 	echo "Error year:Seasons";
				 	die();

				 }
*/

			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }


			$LS_nights=($night_qty);          $HS_nights=0;

			if (($LS_nights=="0")&&($HS_nights>=
			"1")){    /*//solo HS*/
             ?>
            	<? if ($_SESSION['info']['level']==1){?>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="price" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceHS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="price" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}elseif(($HS_nights=="0")&&($LS_nights>="1")){ /*//solo LS*/
             ?>
	             <? if ($_SESSION['info']['level']==1){?>
		       		Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		<input type="hidden" name="priceHS" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	<input type="hidden" name="priceHS" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?

			}else{ /*//existen ambas*/
                 ?>
             	<? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	PriceLH&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}
/*//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------*/
           ?>
          <!--// promotion code//-->
             <!--<br>
             Apply promotion: <select name="applypro">
				<option value="1" selected="selected"> No</option>
				<option value="2" > Yes</option>
				</select>-->
			 <!--code:<input type="text" size="7" name="promotion_code" />-->
           <!--// promotion code//-->
	       </p>
	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Try and Buy Options</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
	       <div style="height:174px; overflow:auto;">
		   <p>
			   <select name="tbtype">
				   <option value="1" selected="selected">TB price per night </option>
				   <option value="2">TB flat total price </option>
			   </select>
		   </p>
		   
		   <p><input type="text" name="tbprice" value="<?=number_format($price_default,2);?>" /></p>
		   
	       <?
		   /*$servicios=$_SESSION['consultas']->show_all($table='services', $order='id');
			servicios_reserva($servicios,$qty_nights, $beds=$casa['bed']);
			
			
            $servicios_activos=$_SESSION['consultas']->show_all_active('serv_add', 'id');
           
			nuevo_servicios_bookings($servicios_activos,$qty_nights);*/
			/*selectServices($start_date=$starting_date);*/
           ?>
           </div>
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=($casa['capacity']/2);$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size=1 required="required">
			 <option value="">None</option>
			 <? foreach ($customers as $cu ) {    /* //$owner as $k => $v*/
								?><option value=<?=$cu['id']?><? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)<?/*=utf8_encode($cu['name'])." ".utf8_encode($cu['lastname'])*/?></option>
								<?
			 } ?></select><!-- <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onclick="reserva('new-client1.php','Creat a new client', 530, 800)">New customer</a></span>&nbsp;&nbsp;&nbsp;--></p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="41" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="38" checked="checked">Checking in
				     <input type="radio" name="status" value="40">Confirmed
				     <input type="radio" name="status" value="39" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="40" >Confirmed
				     <input type="radio" name="status" value="39" checked="checked">No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="38" checked="checked">Checked in
				  <?}?>
		      </span>
			<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  /*//starting referals   $_SESSION['consultas']*/
						//$commisioners=$_SESSION['consultas']->show_all('commission', 'name');  /*///elegir solo los activos*/
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  /*///elegir solo los activos*/
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							/*//ending referals*/
				?>
			<?php }?>
		      <!--///*REFERAL AGENTS*///-->
	      </p>
	       <?/*=expedia_fields($id_exp='', $amount_exp='');*/?>
	     <!--// <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->
	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>
	   <!--INFORMACIONES DE LA RENTA TERMINAN-->

	      <?
	        break;
			
			//===================================TERMINA CODIGO PARA TRY AND BUY==========================================================================
			
			
			
			
		case "apolo":
			/*//header('location:regular_reserves.php');
	       // echo "i equals 1";*/
	       $price_default=$_SESSION['info_villa']['p_low'];
	       /*//--------------------high season and low season prices-----*/
	       $price_LS=$_SESSION['info_villa']['p_low'];
	       $price_HS=$_SESSION['info_villa']['p_high'];
		   $_SESSION['apolo']=3;
		
	       /*//---------------------------------------------------------*/
	       $qty_nights=$_SESSION['noches'];
	       /*#$qty_nights=$noches;*/
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }

           $price_default=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_default);
           $price_LS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_LS);
	       $price_HS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_HS);

           /*//-----------------------apply weekly and monthly rate-------------------------------------------------------------*/
             $nights_qty=daysDifference2(date('Y-m-d',strtotime($ending_date)), date('Y-m-d',strtotime($starting_date)));
             /*$price_default=price_rent($nights_qty, $normal_price=$price_default);
             $price_LS=price_rent($nights_qty, $normal_price=$price_LS);
             $price_HS=price_rent($nights_qty, $normal_price=$price_HS);*/
           /*//----------------------end apply weekly and monthly rate----------------------------------------------------*/


	      $selected_villa_id=$_SESSION['info_villa']['id'];
	     /* //--------------starting and ending dates --------------*/
	     $fecha_empiezas=date_to_insert($starting_date);
	     $fecha_termina=date_to_insert($ending_date);
         /* //----------------------- hight and low seasons dates ------------*/

		   $casa=$_SESSION['info_villa'];
		   ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:green;">Apollo - Short Term Booking</h2><hr />
	       <form method="post" action="short-term-book2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
		 if (is_date($fecha_empiezas)){
		 	if (is_date($fecha_termina)){


				$db= new getQueries ();
				$season=$db->show_id('seasons', 1);
				/*//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)*/
				$p=$db->get_season3_prices($startdate=$fecha_empiezas, $pricelow=$casa['p_low'], $priceshoulder=$casa['p_shoulder'], $pricehigh=$casa['p_high']);	
				  /*echo "<pre>";
				  print_r($p);
				  echo "</pre>";*/
				if($p['price']==0){
					//if the villa price for that season is 0 or there is problems with seasons getting price, do not continue.
					die('Fatal Error: There is a pricing error, please try again.');
				}
				$night_qty=daysDifference2($fecha_termina, $fecha_empiezas);  
				$price_default=$p['price'];
				$price_LS=$p['price'];
				$price_HS=$p['price'];
				
				/*
				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];

				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);
				 $LS_inicio=explode('-', $inicio_t_baja);
				 $LS_fin=explode('-', $fin_t_baja);
				$Fecha_Inicio=explode('-', $fecha_empiezas);
				$Fecha_Final=explode('-', $fecha_termina);
				
				$MI=$Fecha_Inicio[1]; 
				$DI=$Fecha_Inicio[2];   
				$AI=$Fecha_Inicio[0];  

				$MF=$Fecha_Final[1];  
				$DF=$Fecha_Final[2];  
				$AF=$Fecha_Final[0];  

				$MIHS=$HS_inicio[1];  
				$DIHS=$HS_inicio[2];   
				$AIHS=$HS_inicio[0];    

				$MFHS=$HS_fin[1];   
				$DFHS=$HS_fin[2];   
				$AFHS=$HS_fin[0];    

				 
				  $temporada_alta_mes_dia=array();  

				
				 if ($AIHS==$AFHS){
				 	echo "Error year1:Seasons";
				 	die();
				

				 }elseif(($AIHS+1)==$AFHS){ 
				 
				   $m=0;
				   $x=0;
				
				   for ($m=$MIHS; $m<=12; $m++){     


				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  
				   
				     	$HS_array=array('mes'=>$m,'dia'=>$x);

					     array_push($temporada_alta_mes_dia,$HS_array);

				    }
				   }
			
				   $m=0;
				   $x=0;
				
				    for ($m=1; $m<=$MFHS; $m++){       

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){    
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);
				    
				    }
				   }

				

				   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);

				 
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){/

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }

				 }else{
				 	echo "Error year:Seasons";
				 	die();
				 }*/
			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }


			$LS_nights=($night_qty);          $HS_nights=0;

			if (($LS_nights=="0")&&($HS_nights>=
			"1")){    /*//solo HS*/
             ?>
            	<? if ($_SESSION['info']['level']==1){?>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="" required="required" /></span>
		       		<input type="hidden" name="price" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{
				die('not allow to be over here');
				}?>
            <?
			}elseif(($HS_nights=="0")&&($LS_nights>="1")){ /*//solo LS*/
             ?>
	             <? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="" required="required" /></span>
		       		<input type="hidden" name="priceHS" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{die('not allow to be over here');}?>
            <?

			}else{ /*//existen ambas*/
                 ?>
             	<? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="" required="required" /></span>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="" required="required" /></span>
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{die('not allow to be over here');}?>
            <?
			}
/*//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------*/
           ?>
          <!--// promotion code//-->
             <br>
             Promotion code:<input type="text" size="7" name="promotion_code" />
           <!--// promotion code//-->
	       </p>
	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Additional Services</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
	       <div style="height:174px; overflow:auto;">
	       <?

            $servicios_activos=$_SESSION['consultas']->show_all_active('serv_add', 'id');
            /*//falta arreglar los servicios de laundry que se calculan de acurdo a la cantidad de dia de la reserva*/
			nuevo_servicios_bookings($servicios_activos,$qty_nights);
			selectServices($start_date=$starting_date);
           ?>
           </div>
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=($casa['capacity']/2);$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size=1 required>
						<option value="0">None</option>
						<? foreach ($customers as $cu ) {     /*//$owner as $k => $v*/
								?><option value=<?=$cu['id']?><? if (4109== $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)<?/*=utf8_encode($cu['name'])." ".utf8_encode($cu['lastname'])*/?></option>
								<?
			 } ?></select><!-- <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onclick="reserva('new-client1.php','Creat a new client', 530, 800)">New customer</a></span>&nbsp;&nbsp;&nbsp;--></p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="4" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="1" checked="checked">Checking in
				     <input type="radio" name="status" value="2">Confirmed
				     <input type="radio" name="status" value="3" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="2" checked="checked">Confirmed
				     <input type="radio" name="status" value="3" >No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="1" checked="checked">Checked in
				  <?}?>
		      </span>
		<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  /*//starting referals   $_SESSION['consultas']*/
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  /*///elegir solo los activos*/
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							/*//ending referals*/
				?>
		<?php }?>
		      <!--///*REFERAL AGENTS*///-->
	      </p>

	       <?/*=expedia_fields($id_exp='', $amount_exp='');*/?>
	     <!--// <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->


	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>
	   <!--INFORMACIONES DE LA RENTA TERMINAN-->

	      <?
	        break;

	    case "long":

		    ?>

		    <!---------------------------------------------------------------->
		<?     /* //  echo "i equals 0";
	     # $price_default=$_SESSION['info_villa']['p_low'];

	       #$qty_nights=$noches;*/
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }
	       $qty_nights=dayPeriod($ending_date, $starting_date);
	       $casa=$_SESSION['info_villa'];

       /* //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================
        #if ($qty_nights<$prices_setting['Long_nights']){/*poner dinamico, buscar datos en la base de datos o dar error si es cero o menor*/
        if ($qty_nights<2){/*poner dinamico, buscar datos en la base de datos o dar error si es cero o menor*/
             	echo $qty_nights." nights";
             	echo "<br/>";
             	echo "<span style='color:red'>Long term rental must be minimun ".($prices_setting['Long_nights']/30)." months</span>";
        }else{
              $entrada=breakdate($starting_date); /*//return dates in pieces*/
              $salida=breakdate($ending_date); /*//return dates in pieces*/

              $payment_day=array();
              $fechas_de_pago=array();
              	$years_qty=($salida['year']-$entrada['year']);  /*//return quantity of years*/
                /*//echo "<br><span style='color:red'>diferencias de year $years_qty</span><br>";*/
                for ($years=$entrada['year']; $years<=$salida['year']; $years++){
                	/*//echo $years."<br>";*/
                	if ($years==$entrada['year']){  /*//starting year*/

                       if ($entrada['year']!=$salida['year']){/*//si tiene mas de un a�o*/
                        $months_start_year=12-$entrada['month'];

                         $months_starting=12-$months_start_year; /*//return month starting first year*/
	                        for ($i=$months_starting; $i<=12; $i++){ /*//each month first year*/
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

                                   array_push($fechas_de_pago,$payment_day);

	                        } /*//END MONTH FIRST YEAR*/
	                   }else{/*//ES EL MISMO A�O DE ENTRADA QUE DE SALIDA*/
                             for ($i=$entrada['month']; $i<=$salida['month']; $i++){ /*//each month first year*/
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                                if  ($i!=$salida['month']){
	                                   	array_push($fechas_de_pago,$payment_day);
	                                 }

									if  ($i==$salida['month']){
			                       		if ($salida['day']>$dia_de_pago){ /* //SI SALE DESPPUES DE LA FECHA DE PAGO*/

		                                   array_push($fechas_de_pago,$payment_day);/*//agregar una fecha de pago en el ultimo a�o*/

		                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
		                                  /*//echo  $ultimo_pago;*/
		                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
		                                 /*// echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO*/
			                       		 $nights_last_payment= $noches_por_cobrar;  /*//NOCHES EN EL ULTIMO PAGO*/
			                       		}

		                          		if ($salida['day']<$dia_de_pago){/*// SI SALE ANTES DE LA FECHA DE PAGO*/

		                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

		                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

		                                 $solo_cobrar=30-$noches_NO_cobrar;
		                                 $nights_last_payment=$solo_cobrar;  /*//NOCHES EN EL ULTIMO PAGO*/
		                                }

										if ($salida['day']==$dia_de_pago){/*// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)*/
		                               	 	array_push($fechas_de_pago,$payment_day);/*//agregar una fecha de pago en el ultimo a�o*/
		                                	$nights_last_payment=0; /* //NOCHES EN EL ULTIMO PAGO*/
		        						}

			                        }
	                        } /*//END MONTH FIRST YEAR*/

	                   }/*//END MONTH FIRST YEAR*/
                	}elseif($years==$salida['year']){   /*//ending year*/

                        $months_end_year=$salida['month'];

                        for ($i=1; $i<=$salida['month']; $i++){ /*//each month last year*/

	                        $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }

                              $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                           if  ($i!=$salida['month']){

		                         array_push($fechas_de_pago,$payment_day);  /*//fechas de pago para ultimo a�o*/
		                        /*# echo "<br/>";*/
	                           }

	                           if  ($i==$salida['month']){
	                       		if ($salida['day']>$dia_de_pago){  /*//SI SALE DESPPUES DE LA FECHA DE PAGO*/

                                   array_push($fechas_de_pago,$payment_day);/*//agregar una fecha de pago en el ultimo a�o*/

                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
                                  /*//echo  $ultimo_pago;*/
                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
                                 /*// echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO*/
	                       		 $nights_last_payment= $noches_por_cobrar;  /*//NOCHES EN EL ULTIMO PAGO*/
	                       		}

                          		if ($salida['day']<$dia_de_pago){/*// SI SALE ANTES DE LA FECHA DE PAGO*/

                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

                                 $solo_cobrar=30-$noches_NO_cobrar;
                                 $nights_last_payment=$solo_cobrar;  /*//NOCHES EN EL ULTIMO PAGO*/

                                }

								if ($salida['day']==$dia_de_pago){/*// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)*/
                               	 	array_push($fechas_de_pago,$payment_day);/*//agregar una fecha de pago en el ultimo a�o*/
                                	$nights_last_payment=0;  /*//NOCHES EN EL ULTIMO PAGO*/
        						}

	                           }

	                    } /*//END MONTHS ENDIND YEAR*/



                	}else{  /*//middle years*/

                		for ($i=1; $i<=12; $i++){ /*//each month last year*/
	                          /*// echo $i."meses;";
	                          // echo "<br/>";*/
	                          $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }
	                           $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

	                         array_push($fechas_de_pago,$payment_day);  /*//fechas de pago para a�os del medio*/
	                    } /*//END MONTHS MIDDLE YEAR*/

                    }
                   /*//print whole array*/


                } /*//END ALL THE YEARS*/

    			$size_pagos=count($fechas_de_pago);/*//CANTIDAD DE PAGOS A HACER*/
    			$contador=0;

    			if ($_SESSION['last_payment_date']) unset($_SESSION['last_payment_date']);
    			if ($_SESSION['payments']) unset($_SESSION['payments']);
    			if ($_SESSION['payments_qty']) unset($_SESSION['payments_qty']);
    			if ( $_SESSION['nights_last_payment']) unset( $_SESSION['nights_last_payment']);
                 $_SESSION['last_payment_date']="";  /*//ultima fecha de pago*/
                 $_SESSION['payments']=array(); /*//fechas de pago*/
                 $_SESSION['payments_qty']=0;    /*//cantidad de pagos*/
                 $_SESSION['nights_last_payment']=0; /*//cantidad de noches*/

       		 foreach ($fechas_de_pago AS $k){
                   $contador++;
                   if ($contador!=$size_pagos){
                	/*#echo $k['year']."-";      //OJO
                   # echo $k['month']."-";      //OJO
                    #echo $k['day']."<br/>";     //OJO
                    //array_push(($_SESSION['payments']), (date_to_insert($k['year']."-".$k['month']."-".$k['day'])));  //fechas de pago*/
                    }

                 if ($contador==$size_pagos){
                     /*#echo "ultimo pago: ";     //OJO
                     #echo $k['year']."-";     //OJO
	                 #echo $k['month']."-";    //OJO
	                # echo $k['day']."<br/>";    //OJO*/
	                 if ($nights_last_payment>0){
                       $_SESSION['last_payment_date']=date_to_insert($k['year']."-".$k['month']."-".$k['day']);    /*//ultimo pago*/
                    /* //  array_push($_SESSION['payments'], date_to_insert($k['year']."-".$k['month']."-".$k['day']));  //fechas de pago*/
                       $_SESSION['payments_qty']=$size_pagos;/*//cantidad de pagos*/
                     }else{
                      	$_SESSION['payments_qty']=($size_pagos-1);/*//cantidad de pagos*/
                     }
                }

               $_SESSION['payments']=$fechas_de_pago;
               /*// $_SESSION['payments_qty']=$size_pagos;*/
                $_SESSION['nights_last_payment']=$nights_last_payment;
             }
            /*//============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================*/


              /*//============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================*/
                 ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:red;">Long Term Rental Booking</h2><hr />
	       <form method="post" action="long-term-book2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
                $price_long=$casa['p_long'];

             	 if ($_SESSION['info']['level']==1){?>
		       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
	            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
	            <?}?>


	       </p>
	       <!--END PRICE FOR THIS RENT-->


	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Services for Long Term</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->

	      <p style="text-align:right; font-weight:bold"><span id="td0" > Maintenance: </span><!--<br />-->
	      <input type="text" class="azul" style="text-align:right" name="maintenance" value="<?=$casa['maintenance']?>" READONLY>
	           </p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Pool and garden: </span><!--<br />-->
		  <? poolLong($casa['p_out_clear']);?><!--Pool Long Term-->
		   <!--<input type="text" class="azul" style="text-align:right" name="pool_garden" value="<?=$casa['p_out_clear']?>" READONLY>--></p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Water: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_water" value="<?=price_water($bed=$casa['bed'])?>" READONLY></p>
	       <p style="text-align:right; font-weight:bold"><span id="td0">Gas: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_gas" value="<?=price_gas($bed=$casa['bed'])?>" READONLY></p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold">
	       	<span id="td0">Maid service: </span><!--<br />-->
	       	<? maidLong($casa['p_in_clear']);?><!--Maid Long Term-->
			</p>
	       <!--<br />-->

	      <!--// <p style="text-align:right; font-weight:bold"><span id="td0">Electricity: </span><input type="text" class="azul" style="text-align:right" name="electricity" value="by consumption" DISABLED></p>//-->

	       <!--aeropuerto vip->choose->cantidad(Note:______)<br />-->
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	      <? if ($_SESSION['info']['level']==1){ /*//start flat fee*/
	       	?>
	       <tr><td colspan="2">
	       <!--Flat Feet per month and per booking start here-->
	       <p style="text-align:right; font-weight:bold"><span id="td0">
	      	 <input type="radio" name="rate" value="regular" id="regular_rate" CHECKED >Regular pricing</input>
	      	  <script type="text/javascript">
				function f_boxcheck()
				{

				if(document.getElementById("regular_rate").checked){
				document.getElementById("FM").disabled=true;
				document.getElementById("FB").disabled=true;

				}
				}

				document.getElementById("regular_rate").onclick=f_boxcheck;
			</script>
			 <input type="radio" name="rate" value="flat_month" id="Flat_month">Flat amount per Months</input>
			 <script type="text/javascript">
				function f_boxcheck2()
				{

				if(document.getElementById("Flat_month").checked){
				document.getElementById("FM").disabled=false;
				document.getElementById("FB").disabled=true;

				}else {document.getElementById("FM").disabled=true;}
				}

				document.getElementById("Flat_month").onclick=f_boxcheck2;
			</script>
			  <input type="text" name="FM" value="" disabled="disabled" id="FM" size="5"/>
			 <input type="radio" name="rate" value="flat_booking" id="Flat_booking">Flat amount per booking</input>
			   <script type="text/javascript">
				function f_boxcheck3()
				{

				if(document.getElementById("Flat_booking").checked){
				document.getElementById("FB").disabled=false;
				document.getElementById("FM").disabled=true;

				}else {document.getElementById("FB").disabled=true;}
				}

				document.getElementById("Flat_booking").onclick=f_boxcheck3;
			</script>
			 <input type="text" id="FB" name="FB" value="" size="5" disabled="disabled"/>
			</span></p>
		   <!--Flat Feet per month and per booking start here-->
		  </td></tr>
          <?}else{?>
          <tr><td colspan="2">
             <input type="hidden" name="rate" value="regular" />
          </td></tr>
          <?}// end flat fee
          ?>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size="1" required="required">
					<option value="">None</option>
			 <? foreach ($customers as $cu ) {     //$owner as $k => $v
				?> 
				
				<option value=<?=$cu['id']?>
						<? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
					</option>
				<?} ?></select>
				</p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Payments: </span><u><span style="color:#09F"><?if ($nights_last_payment==0){ echo ($contador-1);}else{echo $contador;}?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="11" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="8" checked="checked">Checking in
				     <input type="radio" name="status" value="9">Confirmed
				     <input type="radio" name="status" value="10" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="9" checked="checked">Confirmed
				     <input type="radio" name="status" value="10" >No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="8" checked="checked">Checked in
				  <?}?>
		      </span>
		<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
		      <!--///*REFERAL AGENTS*///-->
		<?php }?>
	      </p>
	      <!--//<p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->


	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$casa['id']?>&v2=<?=$casa['id']?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>

	    <? }   //end else long rental
               //============= TERMINA LONG TERM RENTAL PARTE 1 =====================

	    /*=============================================START BOOKING FOR BUYER=============================================================================================================================================*/
	      break;

	    case "Buyer":   /*buyer long term*/

		    ?>

		    <!---------------------------------------------------------------->
		<?
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }
	       $qty_nights=dayPeriod($ending_date, $starting_date);
	       $casa=$_SESSION['info_villa'];


        if ($qty_nights<2){/*poner dinamico, buscar datos en la base de datos o dar error si es cero o menor*/
             	echo $qty_nights." nights";
             	echo "<br/>";
             	echo "<span style='color:red'>Buyer must be minimun ".($prices_setting['Long_nights']/30)." months</span>";
        }else{
              $entrada=breakdate($starting_date); //return dates in pieces
              $salida=breakdate($ending_date); //return dates in pieces

              $payment_day=array();
              $fechas_de_pago=array();
              	$years_qty=($salida['year']-$entrada['year']);  //return quantity of years
                //echo "<br><span style='color:red'>diferencias de year $years_qty</span><br>";
                for ($years=$entrada['year']; $years<=$salida['year']; $years++){
                	//echo $years."<br>";
                	if ($years==$entrada['year']){  //starting year

                       if ($entrada['year']!=$salida['year']){//si tiene mas de un a�o
                        $months_start_year=12-$entrada['month'];

                         $months_starting=12-$months_start_year; //return month starting first year
	                        for ($i=$months_starting; $i<=12; $i++){ //each month first year
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

                                   array_push($fechas_de_pago,$payment_day);

	                        } //END MONTH FIRST YEAR
	                   }else{//ES EL MISMO A�O DE ENTRADA QUE DE SALIDA
                             for ($i=$entrada['month']; $i<=$salida['month']; $i++){ //each month first year
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                                if  ($i!=$salida['month']){
	                                   	array_push($fechas_de_pago,$payment_day);
	                                 }

									if  ($i==$salida['month']){
			                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

		                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o

		                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
		                                  //echo  $ultimo_pago;
		                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
		                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
			                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
			                       		}

		                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

		                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

		                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

		                                 $solo_cobrar=30-$noches_NO_cobrar;
		                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO
		                                }

										if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
		                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o
		                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
		        						}

			                        }
	                        } //END MONTH FIRST YEAR

	                   }//END MONTH FIRST YEAR
                	}elseif($years==$salida['year']){   //ending year

                        $months_end_year=$salida['month'];

                        for ($i=1; $i<=$salida['month']; $i++){ //each month last year

	                        $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }

                              $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                           if  ($i!=$salida['month']){

		                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para ultimo a�o
		                        # echo "<br/>";
	                           }

	                           if  ($i==$salida['month']){
	                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o

                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
                                  //echo  $ultimo_pago;
                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
	                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
	                       		}

                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

                                 $solo_cobrar=30-$noches_NO_cobrar;
                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO

                                }

								if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o
                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
        						}

	                           }

	                    } //END MONTHS ENDIND YEAR



                	}else{  //middle years

                		for ($i=1; $i<=12; $i++){ //each month last year
	                          // echo $i."meses;";
	                          // echo "<br/>";
	                          $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }
	                           $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

	                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para a�os del medio
	                    } //END MONTHS MIDDLE YEAR

                    }
                   //print whole array


                } //END ALL THE YEARS

    			$size_pagos=count($fechas_de_pago);//CANTIDAD DE PAGOS A HACER
    			$contador=0;

    			if ($_SESSION['last_payment_date']) unset($_SESSION['last_payment_date']);
    			if ($_SESSION['payments']) unset($_SESSION['payments']);
    			if ($_SESSION['payments_qty']) unset($_SESSION['payments_qty']);
    			if ( $_SESSION['nights_last_payment']) unset( $_SESSION['nights_last_payment']);
                 $_SESSION['last_payment_date']="";  //ultima fecha de pago
                 $_SESSION['payments']=array(); //fechas de pago
                 $_SESSION['payments_qty']=0;    //cantidad de pagos
                 $_SESSION['nights_last_payment']=0; //cantidad de noches

       		 foreach ($fechas_de_pago AS $k){
                   $contador++;
                   if ($contador!=$size_pagos){
                	#echo $k['year']."-";      //OJO
                   # echo $k['month']."-";      //OJO
                    #echo $k['day']."<br/>";     //OJO
                    //array_push(($_SESSION['payments']), (date_to_insert($k['year']."-".$k['month']."-".$k['day'])));  //fechas de pago
                    }

                 if ($contador==$size_pagos){
                     #echo "ultimo pago: ";     //OJO
                     #echo $k['year']."-";     //OJO
	                 #echo $k['month']."-";    //OJO
	                # echo $k['day']."<br/>";    //OJO
	                 if ($nights_last_payment>0){
                       $_SESSION['last_payment_date']=date_to_insert($k['year']."-".$k['month']."-".$k['day']);    //ultimo pago
                     //  array_push($_SESSION['payments'], date_to_insert($k['year']."-".$k['month']."-".$k['day']));  //fechas de pago
                       $_SESSION['payments_qty']=$size_pagos;//cantidad de pagos
                     }else{
                      	$_SESSION['payments_qty']=($size_pagos-1);//cantidad de pagos
                     }
                }

               $_SESSION['payments']=$fechas_de_pago;
               // $_SESSION['payments_qty']=$size_pagos;
                $_SESSION['nights_last_payment']=$nights_last_payment;
             }
            //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================


              //============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================
                 ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:orange;">Buyer rental booking</h2><hr />
	       <form method="post" action="buyer2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
                $price_long=$casa['p_long'];

             	 if ($_SESSION['info']['level']==1){?>
		       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
	            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
	            <?}?>


	       </p>
	       <!--END PRICE FOR THIS RENT-->


	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Services for buyer</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->

	      <p style="text-align:right; font-weight:bold"><span id="td0" > Maintenance: </span><!--<br />-->
	      <input type="text" class="azul" style="text-align:right" name="maintenance" value="<?=$casa['maintenance']?>" READONLY>
	           </p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Pool and garden: </span><!--<br />--> <? poolLong($casa['p_out_clear']);?><!--Pool buyer Long Term--></p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Water: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_water" value="<?=price_water($bed=$casa['bed'])?>" READONLY></p>
	       <p style="text-align:right; font-weight:bold"><span id="td0">Gas: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_gas" value="<?=price_gas($bed=$casa['bed'])?>" READONLY></p>

	       <p style="text-align:right; font-weight:bold">
	       	<span id="td0">Maid service: </span><!--<br />-->
	       	 <? maidLong($casa['p_in_clear'],2);?><!--Maid buyer Long Term--></p>
	       <!--<br />-->


	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	      <? if ($_SESSION['info']['level']==1){ //start flat fee
	       	?>
	       <tr><td colspan="2">
	       <!--Flat Feet per month and per booking start here-->
	       <p style="text-align:right; font-weight:bold"><span id="td0">
	      	 <input type="radio" name="rate" value="regular" id="regular_rate" CHECKED >Regular pricing</input>
	      	  <script type="text/javascript">
				function f_boxcheck()
				{

				if(document.getElementById("regular_rate").checked){
				document.getElementById("FM").disabled=true;
				document.getElementById("FB").disabled=true;

				}
				}

				document.getElementById("regular_rate").onclick=f_boxcheck;
			</script>
			 <input type="radio" name="rate" value="flat_month" id="Flat_month">Flat amount per Months</input>
			 <script type="text/javascript">
				function f_boxcheck2()
				{

				if(document.getElementById("Flat_month").checked){
				document.getElementById("FM").disabled=false;
				document.getElementById("FB").disabled=true;

				}else {document.getElementById("FM").disabled=true;}
				}

				document.getElementById("Flat_month").onclick=f_boxcheck2;
			</script>
			  <input type="text" name="FM" value="" disabled="disabled" id="FM" size="5"/>
			 <input type="radio" name="rate" value="flat_booking" id="Flat_booking">Flat amount per booking</input>
			   <script type="text/javascript">
				function f_boxcheck3()
				{

				if(document.getElementById("Flat_booking").checked){
				document.getElementById("FB").disabled=false;
				document.getElementById("FM").disabled=true;

				}else {document.getElementById("FB").disabled=true;}
				}

				document.getElementById("Flat_booking").onclick=f_boxcheck3;
			</script>
			 <input type="text" id="FB" name="FB" value="" size="5" disabled="disabled"/>
			</span></p>
		   <!--Flat Feet per month and per booking start here-->
		  </td></tr>
          <?}else{?>
          <tr><td colspan="2">
             <input type="hidden" name="rate" value="regular" />
          </td></tr>
          <?}// end flat fee
          ?>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
				?> <option value=<?=$cu['id']?>
						<? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
					</option>
				<?} ?></select>
				</p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Payments: </span><u><span style="color:#09F"><?if ($nights_last_payment==0){ echo ($contador-1);}else{echo $contador;}?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="29" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="26" checked="checked">Checking in
				     <input type="radio" name="status" value="28">Confirmed
				     <input type="radio" name="status" value="27" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="28" checked="checked">Confirmed
				     <input type="radio" name="status" value="27" >No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="26" checked="checked">Checked in
				  <?}?>
		      </span>
			  <?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
		      <!--///*REFERAL AGENTS*///-->
			  <?php }?>
	      </p>
	      <!--//<p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->


	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$casa['id']?>&v2=<?=$casa['id']?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>

	    <? }   //end else long rental
	    /*============================================END BOOKING FOR BUYER=========================================================================================================================================================*/


	        break;

          case "Buyers":    /*======BUYER SHORT TERM===========*/
			  ?>

		    <!---------------------------------------------------------------->
		<?
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }
	       $qty_nights=dayPeriod($ending_date, $starting_date);
	       $casa=$_SESSION['info_villa'];


        if ($qty_nights<2){/*poner dinamico, buscar datos en la base de datos o dar error si es cero o menor*/
             	echo $qty_nights." nights";
             	echo "<br/>";
             	echo "<span style='color:red'>Buyer must be minimun ".($prices_setting['Long_nights']/30)." months</span>";
        }else{
              $entrada=breakdate($starting_date); //return dates in pieces
              $salida=breakdate($ending_date); //return dates in pieces

              $payment_day=array();
              $fechas_de_pago=array();
              	$years_qty=($salida['year']-$entrada['year']);  //return quantity of years
                //echo "<br><span style='color:red'>diferencias de year $years_qty</span><br>";
                for ($years=$entrada['year']; $years<=$salida['year']; $years++){
                	//echo $years."<br>";
                	if ($years==$entrada['year']){  //starting year

                       if ($entrada['year']!=$salida['year']){//si tiene mas de un a�o
                        $months_start_year=12-$entrada['month'];

                         $months_starting=12-$months_start_year; //return month starting first year
	                        for ($i=$months_starting; $i<=12; $i++){ //each month first year
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

                                   array_push($fechas_de_pago,$payment_day);

	                        } //END MONTH FIRST YEAR
	                   }else{//ES EL MISMO A�O DE ENTRADA QUE DE SALIDA
                             for ($i=$entrada['month']; $i<=$salida['month']; $i++){ //each month first year
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                                if  ($i!=$salida['month']){
	                                   	array_push($fechas_de_pago,$payment_day);
	                                 }

									if  ($i==$salida['month']){
			                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

		                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o

		                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
		                                  //echo  $ultimo_pago;
		                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
		                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
			                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
			                       		}

		                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

		                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

		                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

		                                 $solo_cobrar=30-$noches_NO_cobrar;
		                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO
		                                }

										if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
		                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o
		                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
		        						}

			                        }
	                        } //END MONTH FIRST YEAR

	                   }//END MONTH FIRST YEAR
                	}elseif($years==$salida['year']){   //ending year

                        $months_end_year=$salida['month'];

                        for ($i=1; $i<=$salida['month']; $i++){ //each month last year

	                        $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }

                              $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                           if  ($i!=$salida['month']){

		                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para ultimo a�o
		                        # echo "<br/>";
	                           }

	                           if  ($i==$salida['month']){
	                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o

                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
                                  //echo  $ultimo_pago;
                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
	                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
	                       		}

                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

                                 $solo_cobrar=30-$noches_NO_cobrar;
                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO

                                }

								if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o
                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
        						}

	                           }

	                    } //END MONTHS ENDIND YEAR



                	}else{  //middle years

                		for ($i=1; $i<=12; $i++){ //each month last year
	                          // echo $i."meses;";
	                          // echo "<br/>";
	                          $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }
	                           $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

	                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para a�os del medio
	                    } //END MONTHS MIDDLE YEAR

                    }
                   //print whole array


                } //END ALL THE YEARS

    			$size_pagos=count($fechas_de_pago);//CANTIDAD DE PAGOS A HACER
    			$contador=0;

    			if ($_SESSION['last_payment_date']) unset($_SESSION['last_payment_date']);
    			if ($_SESSION['payments']) unset($_SESSION['payments']);
    			if ($_SESSION['payments_qty']) unset($_SESSION['payments_qty']);
    			if ( $_SESSION['nights_last_payment']) unset( $_SESSION['nights_last_payment']);
                 $_SESSION['last_payment_date']="";  //ultima fecha de pago
                 $_SESSION['payments']=array(); //fechas de pago
                 $_SESSION['payments_qty']=0;    //cantidad de pagos
                 $_SESSION['nights_last_payment']=0; //cantidad de noches

       		 foreach ($fechas_de_pago AS $k){
                   $contador++;
                   if ($contador!=$size_pagos){
                	#echo $k['year']."-";      //OJO
                   # echo $k['month']."-";      //OJO
                    #echo $k['day']."<br/>";     //OJO
                    //array_push(($_SESSION['payments']), (date_to_insert($k['year']."-".$k['month']."-".$k['day'])));  //fechas de pago
                    }

                 if ($contador==$size_pagos){
                     #echo "ultimo pago: ";     //OJO
                     #echo $k['year']."-";     //OJO
	                 #echo $k['month']."-";    //OJO
	                # echo $k['day']."<br/>";    //OJO
	                 if ($nights_last_payment>0){
                       $_SESSION['last_payment_date']=date_to_insert($k['year']."-".$k['month']."-".$k['day']);    //ultimo pago
                     //  array_push($_SESSION['payments'], date_to_insert($k['year']."-".$k['month']."-".$k['day']));  //fechas de pago
                       $_SESSION['payments_qty']=$size_pagos;//cantidad de pagos
                     }else{
                      	$_SESSION['payments_qty']=($size_pagos-1);//cantidad de pagos
                     }
                }

               $_SESSION['payments']=$fechas_de_pago;
               // $_SESSION['payments_qty']=$size_pagos;
                $_SESSION['nights_last_payment']=$nights_last_payment;
             }
            //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================


              //============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================
                 ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:orange;">Buyer rental booking</h2><hr />
	       <form method="post" action="buyer2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
                $price_long=$casa['p_long'];

             	 if ($_SESSION['info']['level']==1){?>
		       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
	            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
	            <?}?>


	       </p>
	       <!--END PRICE FOR THIS RENT-->


	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Services for buyer</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->

	      <p style="text-align:right; font-weight:bold"><span id="td0" > Maintenance: </span><!--<br />-->
	      <input type="text" class="azul" style="text-align:right" name="maintenance" value="<?=$casa['maintenance']?>" READONLY>
	           </p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Pool and garden: </span><!--<br />--> <? poolLong($casa['p_out_clear'],1);?><!--Pool buyer short Term--></p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Water: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_water" value="<?=price_water($bed=$casa['bed'])?>" READONLY></p>
	       <p style="text-align:right; font-weight:bold"><span id="td0">Gas: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_gas" value="<?=price_gas($bed=$casa['bed'])?>" READONLY></p>

	       <p style="text-align:right; font-weight:bold">
	       	<span id="td0">Maid service: </span><!--<br />-->
	       	 <? maidLong($casa['p_in_clear'],1);?><!--Maid buyer short Term--></p>
	       <!--<br />-->


	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	      <? if ($_SESSION['info']['level']==1){ //start flat fee
	       	?>
	       <tr><td colspan="2">
	       <!--Flat Feet per month and per booking start here-->
	       <p style="text-align:right; font-weight:bold"><span id="td0">
	      	 <input type="radio" name="rate" value="regular" id="regular_rate" CHECKED >Regular pricing</input>
	      	  <script type="text/javascript">
				function f_boxcheck()
				{

				if(document.getElementById("regular_rate").checked){
				document.getElementById("FM").disabled=true;
				document.getElementById("FB").disabled=true;

				}
				}

				document.getElementById("regular_rate").onclick=f_boxcheck;
			</script>
			 <input type="radio" name="rate" value="flat_month" id="Flat_month">Flat amount per Months</input>
			 <script type="text/javascript">
				function f_boxcheck2()
				{

				if(document.getElementById("Flat_month").checked){
				document.getElementById("FM").disabled=false;
				document.getElementById("FB").disabled=true;

				}else {document.getElementById("FM").disabled=true;}
				}

				document.getElementById("Flat_month").onclick=f_boxcheck2;
			</script>
			  <input type="text" name="FM" value="" disabled="disabled" id="FM" size="5"/>
			 <input type="radio" name="rate" value="flat_booking" id="Flat_booking">Flat amount per booking</input>
			   <script type="text/javascript">
				function f_boxcheck3()
				{

				if(document.getElementById("Flat_booking").checked){
				document.getElementById("FB").disabled=false;
				document.getElementById("FM").disabled=true;

				}else {document.getElementById("FB").disabled=true;}
				}

				document.getElementById("Flat_booking").onclick=f_boxcheck3;
			</script>
			 <input type="text" id="FB" name="FB" value="" size="5" disabled="disabled"/>
			</span></p>
		   <!--Flat Feet per month and per booking start here-->
		  </td></tr>
          <?}else{?>
          <tr><td colspan="2">
             <input type="hidden" name="rate" value="regular" />
          </td></tr>
          <?}// end flat fee
          ?>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
				?> <option value=<?=$cu['id']?>
						<? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
					</option>
				<?} ?></select>
				</p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Payments: </span><u><span style="color:#09F"><?if ($nights_last_payment==0){ echo ($contador-1);}else{echo $contador;}?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="33" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="30" checked="checked">Checking in
				     <input type="radio" name="status" value="32">Confirmed
				     <input type="radio" name="status" value="31" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="32" checked="checked">Confirmed
				     <input type="radio" name="status" value="31" >No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="30" checked="checked">Checked in
				  <?}?>
		      </span>
			<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
		      <!--///*REFERAL AGENTS*///-->
			<?php }?>
	      </p>
	      <!--//<p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->


	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$casa['id']?>&v2=<?=$casa['id']?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>

	    <? }
	    /*============================================END BOOKING FOR BUYER=========================================================================================================================================================*/

	        break;
           /*===========================================FIN BUYER SHORT TERM=================================================*/

	    case "owner":

		    ?>

		   		    <!---------------------------------------------------------------->
		<?
	       $price_default=$_SESSION['info_villa']['p_low'];
	       //--------------------high season and low season prices-----
	       $price_LS=$_SESSION['info_villa']['p_low'];
	       $price_HS=$_SESSION['info_villa']['p_high'];
	       //---------------------------------------------------------
	       $qty_nights=$_SESSION['noches'];
	       #$qty_nights=$noches;
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }

	      $selected_villa_id=$_SESSION['info_villa']['id'];

	      //-----------------------apply weekly and monthly rate-------------------------------------------------------------
             $nights_qty=daysDifference2(date('Y-m-d',strtotime($ending_date)), date('Y-m-d',strtotime($starting_date)));
             $price_default=price_rent($nights_qty, $normal_price=$price_default);
             $price_LS=price_rent($nights_qty, $normal_price=$price_LS);
             $price_HS=price_rent($nights_qty, $normal_price=$price_HS);
           //----------------------end apply weekly and monthly rate----------------------------------------------------

	      //--------------starting and ending dates --------------
	     $fecha_empiezas=date_to_insert($starting_date);
	     $fecha_termina=date_to_insert($ending_date);

		   $casa=$_SESSION['info_villa'];
		   ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:#18d62e;">Owner Staying - Short Term</h2><hr />
	       <form method="post" action="owner_staying.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?

		 if (is_date($fecha_empiezas)){
		 	if (is_date($fecha_termina)){

				$db= new getQueries ();
				$season=$db->show_id('seasons', 1);

				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];

				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);
				 $LS_inicio=explode('-', $inicio_t_baja);
				 $LS_fin=explode('-', $fin_t_baja);
				$Fecha_Inicio=explode('-', $fecha_empiezas);
				$Fecha_Final=explode('-', $fecha_termina);
				// ---------------------------------------------
				$MI=$Fecha_Inicio[1];   //Mes inicio
				$DI=$Fecha_Inicio[2];   //dia inicio
				$AI=$Fecha_Inicio[0];  //a�o inicio

				$MF=$Fecha_Final[1];  //mes final
				$DF=$Fecha_Final[2];  //dia final
				$AF=$Fecha_Final[0];   //a�o final

				$MIHS=$HS_inicio[1];  //mes inicio HS
				$DIHS=$HS_inicio[2];   //dia inicio HS
				$AIHS=$HS_inicio[0];    //a�o inicio HS

				$MFHS=$HS_fin[1];    //mes final HS
				$DFHS=$HS_fin[2];   //Dia final HS
				$AFHS=$HS_fin[0];    //a�o final HS

				 //================================================================================
				  $temporada_alta_mes_dia=array();  //array than content all the month and day of HS

				 //SOLO SI FECHA DE INICIO DE HS IS MAYOR FINAL, SINO ERROR (WEBMASTER)
				 if ($AIHS==$AFHS){
				 	echo "Error year1:Seasons";
				 	die();
				  //echo "el mismo year";

				 }elseif(($AIHS+1)==$AFHS){ //a�o de inio de HS es uno anterior al que termina
				   // echo "diferente year";
				   $m=0;
				   $x=0;
				  // echo "year inicio:"; echo "<br/>";
				   for ($m=$MIHS; $m<=12; $m++){       //meses


				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias

				     	$HS_array=array('mes'=>$m,'dia'=>$x);
						//if (!in_array($esta_villa,$villas_ocupadas)){
					     array_push($temporada_alta_mes_dia,$HS_array);

				    }
				   }
				   //proximo a�o
				   $m=0;
				   $x=0;
				  // echo "year fin:"; echo "<br/>";
				    for ($m=1; $m<=$MFHS; $m++){       //meses

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){       //dias
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);

				    }
				   }

				  ////TERMINO DE ESCRIBIR LOS MES CON SUS DIAS CORRESPONDIENTE A LA TEMPORADA ALTA
				   //$night_qty=dayPeriod($termina, $empieza);
				   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);

				  //INICIO PROCESO CON LAS FECHAS SELECCIONADAS PARA ESTA RESERVA A DETERMINAR LOS HS Y LS
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){//a�os
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){//meses
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){//dias

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }

				 }else{
				 	echo "Error year:Seasons";
				 	die();

				 }

			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }


			$LS_nights=($night_qty-$cant_noches_HS);          $HS_nights=$cant_noches_HS;

			if (($LS_nights=="0")&&($HS_nights>=
			"1")){    //solo HS
             ?>
            	<? if ($_SESSION['info']['level']==1){?>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="price" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceHS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="price" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}elseif(($HS_nights=="0")&&($LS_nights>="1")){ //solo LS
             ?>
	             <? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		<input type="hidden" name="priceHS" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	<input type="hidden" name="priceHS" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?

			}else{ //existen ambas
                 ?>
             	<? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	PriceLH&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}
//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------
           ?>

	       </p>
	       <!--END PRICE FOR THIS RENT-->


	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Additional Services</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
	       <?

            $servicios_activos=$_SESSION['consultas']->show_all_active('serv_add', 'id');
            //falta arreglar los servicios de laundry que se calculan de acurdo a la cantidad de dia de la reserva
			nuevo_servicios_bookings($servicios_activos,$qty_nights);
           ?>
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>


	       </select>&nbsp;&nbsp;&nbsp;

	         <? $owners=$_SESSION['consultas']->owners();?>
			 <span  style="color:#5e7d07;">Choose Owner:</span>
			 	<select name="client">
			 		<? foreach ($owners as $ow ) { ?>
						<option value=<?=$ow['id']?><? if ($post['client'] == $ow['id']) {echo " SELECTED";} ?>>
							<? $vils=$_SESSION['consultas']->show_data('villas', "`id_owner`=".$ow['id'], 'id');?>
							<? echo $ow['name']." ".$ow['lastname']; foreach( $vils as $vi){ echo " (".$vi['no'].") "; }?>
						</option>
					<?}?>
				</select>
			</p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="21" checked="checked"><span  style="color:#5e7d07;">Checked out</span>
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="7" checked="checked"><span  style="color:#5e7d07;">Checking in</span>
				     <input type="radio" name="status" value="19"><span  style="color:#5e7d07;">Confirmed</span>
				     <input type="radio" name="status" value="20" ><span  style="color:#5e7d07;">No confirmed</span>
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="19" checked="checked"><span  style="color:#5e7d07;">Confirmed</span>
				     <input type="radio" name="status" value="20" ><span  style="color:#5e7d07;">No confirmed</span>
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="7" checked="checked"><span  style="color:#5e7d07;">Checked in</span>
				  <?}?>
		      </span>
			<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
			<?php }?>
		      <!--///*REFERAL AGENTS*///-->
	      </p>
	       <?/*=expedia_fields($id_exp='', $amount_exp='');*/?>
	     <!--// <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->


	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>
	   <!--INFORMACIONES DE LA RENTA TERMINAN-->

	      <?
	        break;

           case "long_owner":

		    ?>

		    <!---------------------------------------------------------------->
		<?      //  echo "i equals 0";
	     # $price_default=$_SESSION['info_villa']['p_low'];

	       #$qty_nights=$noches;
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }
	       $qty_nights=dayPeriod($ending_date, $starting_date);
	       $casa=$_SESSION['info_villa'];

        //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================
        #if ($qty_nights<$prices_setting['Long_nights']){/*poner dinamico, buscar datos en la base de datos o dar error si es cero o menor*/
        if ($qty_nights<2){/*poner dinamico, buscar datos en la base de datos o dar error si es cero o menor*/
             	echo $qty_nights." nights";
             	echo "<br/>";
             	echo "<span style='color:red'>Long term rental must be minimun ".($prices_setting['Long_nights']/30)." months</span>";
        }else{
              $entrada=breakdate($starting_date); //return dates in pieces
              $salida=breakdate($ending_date); //return dates in pieces

              $payment_day=array();
              $fechas_de_pago=array();
              	$years_qty=($salida['year']-$entrada['year']);  //return quantity of years
                //echo "<br><span style='color:red'>diferencias de year $years_qty</span><br>";
                for ($years=$entrada['year']; $years<=$salida['year']; $years++){
                	//echo $years."<br>";
                	if ($years==$entrada['year']){  //starting year

                       if ($entrada['year']!=$salida['year']){//si tiene mas de un a�o
                        $months_start_year=12-$entrada['month'];

                         $months_starting=12-$months_start_year; //return month starting first year
	                        for ($i=$months_starting; $i<=12; $i++){ //each month first year
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

                                   array_push($fechas_de_pago,$payment_day);

	                        } //END MONTH FIRST YEAR
	                   }else{//ES EL MISMO A�O DE ENTRADA QUE DE SALIDA
                             for ($i=$entrada['month']; $i<=$salida['month']; $i++){ //each month first year
		                          $last_day_month=ultimoDia($i,$years);
		                          if ($last_day_month<=$entrada['day']){
		                          	$dia_de_pago=$last_day_month;
		                          }else{
		                          	$dia_de_pago=$entrada['day'];

		                          }
		                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                                if  ($i!=$salida['month']){
	                                   	array_push($fechas_de_pago,$payment_day);
	                                 }

									if  ($i==$salida['month']){
			                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

		                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o

		                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
		                                  //echo  $ultimo_pago;
		                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
		                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
			                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
			                       		}

		                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

		                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

		                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

		                                 $solo_cobrar=30-$noches_NO_cobrar;
		                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO
		                                }

										if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
		                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o
		                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
		        						}

			                        }
	                        } //END MONTH FIRST YEAR

	                   }//END MONTH FIRST YEAR
                	}elseif($years==$salida['year']){   //ending year

                        $months_end_year=$salida['month'];

                        for ($i=1; $i<=$salida['month']; $i++){ //each month last year

	                        $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }

                              $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
	                           if  ($i!=$salida['month']){

		                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para ultimo a�o
		                        # echo "<br/>";
	                           }

	                           if  ($i==$salida['month']){
	                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o

                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
                                  //echo  $ultimo_pago;
                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
	                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
	                       		}

                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

                                 $solo_cobrar=30-$noches_NO_cobrar;
                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO

                                }

								if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo a�o
                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
        						}

	                           }

	                    } //END MONTHS ENDIND YEAR



                	}else{  //middle years

                		for ($i=1; $i<=12; $i++){ //each month last year
	                          // echo $i."meses;";
	                          // echo "<br/>";
	                          $last_day_month=ultimoDia($i,$years);
	                          if ($last_day_month<=$entrada['day']){
	                          	$dia_de_pago=$last_day_month;
	                          }else{
	                          	$dia_de_pago=$entrada['day'];

	                          }
	                           $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);

	                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para a�os del medio
	                    } //END MONTHS MIDDLE YEAR

                    }
                   //print whole array


                } //END ALL THE YEARS

    			$size_pagos=count($fechas_de_pago);//CANTIDAD DE PAGOS A HACER
    			$contador=0;

    			if ($_SESSION['last_payment_date']) unset($_SESSION['last_payment_date']);
    			if ($_SESSION['payments']) unset($_SESSION['payments']);
    			if ($_SESSION['payments_qty']) unset($_SESSION['payments_qty']);
    			if ( $_SESSION['nights_last_payment']) unset( $_SESSION['nights_last_payment']);
                 $_SESSION['last_payment_date']="";  //ultima fecha de pago
                 $_SESSION['payments']=array(); //fechas de pago
                 $_SESSION['payments_qty']=0;    //cantidad de pagos
                 $_SESSION['nights_last_payment']=0; //cantidad de noches

       		 foreach ($fechas_de_pago AS $k){
                   $contador++;
                   if ($contador!=$size_pagos){
                	#echo $k['year']."-";      //OJO
                   # echo $k['month']."-";      //OJO
                    #echo $k['day']."<br/>";     //OJO
                    //array_push(($_SESSION['payments']), (date_to_insert($k['year']."-".$k['month']."-".$k['day'])));  //fechas de pago
                    }

                 if ($contador==$size_pagos){
                     #echo "ultimo pago: ";     //OJO
                     #echo $k['year']."-";     //OJO
	                 #echo $k['month']."-";    //OJO
	                # echo $k['day']."<br/>";    //OJO
	                 if ($nights_last_payment>0){
                       $_SESSION['last_payment_date']=date_to_insert($k['year']."-".$k['month']."-".$k['day']);    //ultimo pago
                     //  array_push($_SESSION['payments'], date_to_insert($k['year']."-".$k['month']."-".$k['day']));  //fechas de pago
                       $_SESSION['payments_qty']=$size_pagos;//cantidad de pagos
                     }else{
                      	$_SESSION['payments_qty']=($size_pagos-1);//cantidad de pagos
                     }
                }

               $_SESSION['payments']=$fechas_de_pago;
               // $_SESSION['payments_qty']=$size_pagos;
                $_SESSION['nights_last_payment']=$nights_last_payment;
             }
            //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================


              //============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================
                 ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:red;">Long Term Rental Booking</h2><hr />
	       <form method="post" action="long-term-book2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?
                $price_long=$casa['p_long'];

             	 if ($_SESSION['info']['level']==1){?>
		       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
	            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
	            <?}?>


	       </p>
	       <!--END PRICE FOR THIS RENT-->


	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Services for Long Term</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->

	      <p style="text-align:right; font-weight:bold"><span id="td0" > Maintenance: </span><!--<br />-->
	      <input type="text" class="azul" style="text-align:right" name="maintenance" value="<?=$casa['maintenance']?>" READONLY>
	           </p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Pool and garden: </span><!--<br />--> <? poolLong($casa['p_out_clear'],0,3);?><!--Pool owner long Term--></p>
	       <!--<br />-->

	       <p style="text-align:right; font-weight:bold"><span id="td0">Water: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_water" value="<?=price_water($bed=$casa['bed'])?>" READONLY></p>
	       <p style="text-align:right; font-weight:bold"><span id="td0">Gas: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_gas" value="<?=price_gas($bed=$casa['bed'])?>" READONLY></p>

	       <p style="text-align:right; font-weight:bold">
	       	<span id="td0">Maid service: </span><!--<br />-->
	       	 <? maidLong($casa['p_in_clear']);?><!--Maid owner long Term--></p>
	       <!--<br />-->
	       </fieldset></td></tr>
	      <? if ($_SESSION['info']['level']==1){ //start flat fee
	       	?>
	       <tr><td colspan="2">
	       <!--Flat Feet per month and per booking start here-->
	       <p style="text-align:right; font-weight:bold"><span id="td0">
	      	 <input type="radio" name="rate" value="regular" id="regular_rate" CHECKED >Regular pricing</input>
	      	  <script type="text/javascript">
				function f_boxcheck()
				{

				if(document.getElementById("regular_rate").checked){
				document.getElementById("FM").disabled=true;
				document.getElementById("FB").disabled=true;

				}
				}

				document.getElementById("regular_rate").onclick=f_boxcheck;
			</script>
			 <input type="radio" name="rate" value="flat_month" id="Flat_month">Flat amount per Months</input>
			 <script type="text/javascript">
				function f_boxcheck2()
				{

				if(document.getElementById("Flat_month").checked){
				document.getElementById("FM").disabled=false;
				document.getElementById("FB").disabled=true;

				}else {document.getElementById("FM").disabled=true;}
				}

				document.getElementById("Flat_month").onclick=f_boxcheck2;
			</script>
			  <input type="text" name="FM" value="" disabled="disabled" id="FM" size="5"/>
			 <input type="radio" name="rate" value="flat_booking" id="Flat_booking">Flat amount per booking</input>
			   <script type="text/javascript">
				function f_boxcheck3()
				{

				if(document.getElementById("Flat_booking").checked){
				document.getElementById("FB").disabled=false;
				document.getElementById("FM").disabled=true;

				}else {document.getElementById("FB").disabled=true;}
				}

				document.getElementById("Flat_booking").onclick=f_boxcheck3;
			</script>
			 <input type="text" id="FB" name="FB" value="" size="5" disabled="disabled"/>
			</span></p>
		   <!--Flat Feet per month and per booking start here-->
		  </td></tr>
          <?}else{?>
          <tr><td colspan="2">
             <input type="hidden" name="rate" value="regular" />
          </td></tr>
          <?}// end flat fee
          ?>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? /*$customers=$_SESSION['consultas']->customers();?>
			 Owners: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
				?> <option value=<?=$cu['id']?>
						<? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
					</option>
				<?} ?></select>

				<?*/?>
				 <? $owners=$_SESSION['consultas']->owners();?>
			 <span  style="color:#5e7d07;">Choose Owner:</span>
			 	<select name="client">
			 		<? foreach ($owners as $ow ) { ?>
						<option value=<?=$ow['id']?><? if ($post['client'] == $ow['id']) {echo " SELECTED";} ?>>
							<? $vils=$_SESSION['consultas']->show_data('villas', "`id_owner`=".$ow['id'], 'id');?>
							<? echo $ow['name']." ".$ow['lastname']; foreach( $vils as $vi){ echo " (".$vi['no'].") "; }?>
						</option>
					<?}?>
				</select>
				</p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Payments: </span><u><span style="color:#09F"><?if ($nights_last_payment==0){ echo ($contador-1);}else{echo $contador;}?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="25" checked="checked">Checked out-Long Owner
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="22" checked="checked">Checking in-Long Owner
				     <input type="radio" name="status" value="23">Confirmed-Long Owner
				     <input type="radio" name="status" value="24" >No confirmed-Long Owner
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="23" checked="checked">Confirmed-Long Owner
				     <input type="radio" name="status" value="24" >No confirmed-Long Owner
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="22" checked="checked">Checked in-Long Owner
				  <?}?>
		      </span>
		<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
		      <!--///*REFERAL AGENTS*///-->
		<?php }?>
	      </p>
	      <!--//<p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->


	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$casa['id']?>&v2=<?=$casa['id']?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>

	    <? }   //end else long rental
               //============= TERMINA LONG TERM RENTAL PARTE 1 =====================
	     break;


	    case "vip":

	       $price_default=$_SESSION['info_villa']['p_low'];
	       //--------------------high season and low season prices-----
	       $price_LS=$_SESSION['info_villa']['p_low'];
	       $price_HS=$_SESSION['info_villa']['p_high'];
	       //---------------------------------------------------------
	       $qty_nights=$_SESSION['noches'];
	       #$qty_nights=$noches;
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }

	      $selected_villa_id=$_SESSION['info_villa']['id'];
	      //-----------------------apply weekly and monthly rate-------------------------------------------------------------
             $nights_qty=daysDifference2(date('Y-m-d',strtotime($ending_date)), date('Y-m-d',strtotime($starting_date)));
             /*$price_default=price_rent($nights_qty, $normal_price=$price_default);
             $price_LS=price_rent($nights_qty, $normal_price=$price_LS);
             $price_HS=price_rent($nights_qty, $normal_price=$price_HS);*/
           //----------------------end apply weekly and monthly rate----------------------------------------------------

	      //--------------starting and ending dates --------------
	     $fecha_empiezas=date_to_insert($starting_date);
	     $fecha_termina=date_to_insert($ending_date);
          //----------------------- hight and low seasons dates ------------
          $seasons=$_SESSION['consultas']->seasons();

		   $casa=$_SESSION['info_villa'];
		   ?>

	       <h2 style="text-align:center; color:#06C;">VIP Rental Booking</h2><hr />
	       <form method="post" action="vips_rental.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
           <!--START PRICE FOR THIS RENT-->
           <?

		 if (is_date($fecha_empiezas)){
		 	if (is_date($fecha_termina)){


				$db= new getQueries ();
				
				$p=$db->get_season3_prices($startdate=$fecha_empiezas, $pricelow=$casa['p_low'], $priceshoulder=$casa['p_shoulder'], $pricehigh=$casa['p_high']);	
				  /*echo "<pre>";
				  print_r($p);
				  echo "</pre>";*/
					if($p['price']==0){
					    //if the villa price for that season is 0 or there is problems with seasons getting price, do not continue.
						die('Fatal Error: There is a pricing error, please try again.');
					}
					 $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);  
					 $price_default=$p['price'];
					 $price_LS=$p['price'];
					 $price_HS=$p['price'];
				/*
				$season=$db->show_id('seasons', 1);
				//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)

				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];

				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);

				$Fecha_Inicio=explode('-', $fecha_empiezas);
				$Fecha_Final=explode('-', $fecha_termina);
				// ---------------------------------------------
				$MI=$Fecha_Inicio[1];   //Mes inicio
				$DI=$Fecha_Inicio[2];   //dia inicio
				$AI=$Fecha_Inicio[0];  //a�o inicio

				$MF=$Fecha_Final[1];  //mes final
				$DF=$Fecha_Final[2];  //dia final
				$AF=$Fecha_Final[0];   //a�o final

				$MIHS=$HS_inicio[1];  //mes inicio HS
				$DIHS=$HS_inicio[2];   //dia inicio HS
				$AIHS=$HS_inicio[0];    //a�o inicio HS

				$MFHS=$HS_fin[1];    //mes final HS
				$DFHS=$HS_fin[2];   //Dia final HS
				$AFHS=$HS_fin[0];    //a�o final HS

				 //================================================================================
				  $temporada_alta_mes_dia=array();  //array than content all the month and day of HS

				 //SOLO SI FECHA DE INICIO DE HS IS MAYOR FINAL, SINO ERROR (WEBMASTER)
				 if ($AIHS==$AFHS){
				 	echo "Error year1:Seasons";
				 	die();
				  //echo "el mismo year";

				 }elseif(($AIHS+1)==$AFHS){ //a�o de inio de HS es uno anterior al que termina
				   // echo "diferente year";
				   $m=0;
				   $x=0;
				  // echo "year inicio:"; echo "<br/>";
				   for ($m=$MIHS; $m<=12; $m++){       //meses


				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias
				     #echo "mes:".$m." dia:".$x;
				     #echo "<br/>";
				     	$HS_array=array('mes'=>$m,'dia'=>$x);
						//if (!in_array($esta_villa,$villas_ocupadas)){
					     array_push($temporada_alta_mes_dia,$HS_array);

				    }
				   }
				   //proximo a�o
				   $m=0;
				   $x=0;
				  // echo "year fin:"; echo "<br/>";
				    for ($m=1; $m<=$MFHS; $m++){       //meses

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){       //dias
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);

				    }
				   }

				  ////TERMINO DE ESCRIBIR LOS MES CON SUS DIAS CORRESPONDIENTE A LA TEMPORADA ALTA
				   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);
				  //INICIO PROCESO CON LAS FECHAS SELECCIONADAS PARA ESTA RESERVA A DETERMINAR LOS HS Y LS
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){//a�os
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){//meses
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){//dias

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }

				 }else{
				 	echo "Error year:Seasons";
				 	die();
				 }*/

			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }

			$LS_nights=($night_qty);          $HS_nights=0;

			if (($LS_nights=="0")&&($HS_nights>=
			"1")){    //solo HS
             ?>
            	<? if ($_SESSION['info']['level']==1){?>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="price" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceHS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="price" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}elseif(($HS_nights=="0")&&($LS_nights>="1")){ //solo LS
             ?>
	             <? if ($_SESSION['info']['level']==1){?>
		       		Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		<input type="hidden" name="priceHS" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	<input type="hidden" name="priceHS" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?

			}else{ //existen ambas
                 ?>
             	<? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	PriceLH&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}
//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------
           ?>
           <!--// promotion code//-->
             <br>
             Promotion code:<input type="text" size="7" name="promotion_code" />
           <!--// promotion code//-->
	       </p>

	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Additional Services</legend>
	        <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
	       <?

            $servicios_activos=$_SESSION['consultas']->show_all_active('serv_add', 'id');
            //falta arreglar los servicios de laundry que se calculan de acurdo a la cantidad de dia de la reserva
			nuevo_servicios_bookings($servicios_activos,$qty_nights);
           ?>
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers_vip();?>
			 Customer VIP: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
								?><option value=<?=$cu['id']?><? if ($post['client'] == $cu['id']) {echo " SELECTED";} ?> <? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?> ><?=$cu['name']." ".$cu['lastname']?></option>
								<?
							} ?></select><!-- <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onclick="reserva('new-client1.php','Creat a new client', 530, 800)">New customer</a></span>-->&nbsp;&nbsp;&nbsp;</p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="14" checked="checked">Checked out-Short VIP
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="6" checked="checked">Checking in-Short VIP
				     <input type="radio" name="status" value="12">Confirmed - Short VIP
				     <input type="radio" name="status" value="13">No Confirmed - Short VIP
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="12" checked="checked">Confirmed - Short VIP
			      	<input type="radio" name="status" value="13">No Confirmed - Short VIP
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="6" checked="checked">Checked in-Short VIP
				  <?}?>
		      </span>
			  
			<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
		      <!--///*REFERAL AGENTS*///-->
			<?php }?>
	      </p>
	       <?/*=expedia_fields($id_exp='', $amount_exp='');*/?>
	   <!--//   <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->
	       </fieldset></td></tr>
	       <tr><td>
	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>
		 <!--------------------------------------------------------->
		  <?
        break;
		/*========= START MID TERM RENTAL =====================================*/
		    case "mid":
			die('Error: mid term not available');
			/*
			echo "<pre>";
			echo price_mid($bed=5, $normal_price=5);
			echo "</pre>";*/
			
	       $price_default=$_SESSION['info_villa']['p_low'];
	       //--------------------high season and low season prices-----
	       $price_LS=$_SESSION['info_villa']['p_low'];
	       $price_HS=$_SESSION['info_villa']['p_high'];


	       //---------------------------------------------------------
	       $qty_nights=$_SESSION['noches'];
	       #$qty_nights=$noches;
	       if ($_POST['starting'] && $_POST['ending']){
	       	$starting_date=$_POST['starting']; $ending_date=$_POST['ending'];
	       }else{
	        $starting_date=$_GET['start']; $ending_date=$_GET['end'];
	       }

           $price_default=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_default);
           $price_LS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_LS);
	       $price_HS=special_event(date('Y-m-d',strtotime($starting_date)), date('Y-m-d',strtotime($ending_date)), $price_HS);

           //-----------------------apply weekly and monthly rate-------------------------------------------------------------
             $nights_qty=daysDifference2(date('Y-m-d',strtotime($ending_date)), date('Y-m-d',strtotime($starting_date)));
             $price_default=price_rent($nights_qty, $normal_price=$price_default);
             $price_LS=price_rent($nights_qty, $normal_price=$price_LS);
             $price_HS=price_rent($nights_qty, $normal_price=$price_HS);
           //----------------------end apply weekly and monthly rate----------------------------------------------------


	      $selected_villa_id=$_SESSION['info_villa']['id'];
	      //--------------starting and ending dates --------------
	     $fecha_empiezas=date_to_insert($starting_date);
	     $fecha_termina=date_to_insert($ending_date);
          //----------------------- hight and low seasons dates ------------

		   $casa=$_SESSION['info_villa'];
		   ?>

		   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
	       <h2 style="text-align:center; color:red;">Mid Term Rental Booking</h2><hr />
	       <form method="post" action="short-term-book2.php">
	       <table align="center"><tr><td width="235"><fieldset><legend>Villa details</legend>
	       <!--INFORMACIONES DE LA VILLAS INICIAN-->
	       <input type="hidden" name="starting" value="<?=$starting_date?>"  />
	       <input type="hidden" name="ending" value="<?=$ending_date?>"  />
	       <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
	       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
	       <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

	       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
	       <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
	       <p id="td0" style="font-weight:bold;">Size:<br /> <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
	       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

	       <p  id="td0" style="font-weight:bold;"><!--Max. Persons: <span class="azul"><?=$casa['capacity']?></span>-->
           <!--START PRICE FOR THIS RENT-->
           <?
		 if (is_date($fecha_empiezas)){
		 	if (is_date($fecha_termina)){


				$db= new getQueries ();
				$season=$db->show_id('seasons', 1);
				//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)

				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];

				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);
				 $LS_inicio=explode('-', $inicio_t_baja);
				 $LS_fin=explode('-', $fin_t_baja);
				$Fecha_Inicio=explode('-', $fecha_empiezas);
				$Fecha_Final=explode('-', $fecha_termina);
				// ---------------------------------------------
				$MI=$Fecha_Inicio[1];   //Mes inicio
				$DI=$Fecha_Inicio[2];   //dia inicio
				$AI=$Fecha_Inicio[0];  //a�o inicio

				$MF=$Fecha_Final[1];  //mes final
				$DF=$Fecha_Final[2];  //dia final
				$AF=$Fecha_Final[0];   //a�o final

				$MIHS=$HS_inicio[1];  //mes inicio HS
				$DIHS=$HS_inicio[2];   //dia inicio HS
				$AIHS=$HS_inicio[0];    //a�o inicio HS

				$MFHS=$HS_fin[1];    //mes final HS
				$DFHS=$HS_fin[2];   //Dia final HS
				$AFHS=$HS_fin[0];    //a�o final HS
				 //================================================================================
				  $temporada_alta_mes_dia=array();  //array than content all the month and day of HS
				 //SOLO SI FECHA DE INICIO DE HS IS MAYOR FINAL, SINO ERROR (WEBMASTER)
				 if ($AIHS==$AFHS){
				 	echo "Error year1:Seasons";
				 	die();
				  //echo "el mismo year";
				 }elseif(($AIHS+1)==$AFHS){ //a�o de inio de HS es uno anterior al que termina
				   // echo "diferente year";
				   $m=0;
				   $x=0;
				  // echo "year inicio:"; echo "<br/>";
				   for ($m=$MIHS; $m<=12; $m++){       //meses
				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias
				     	$HS_array=array('mes'=>$m,'dia'=>$x);
					     array_push($temporada_alta_mes_dia,$HS_array);
				    }
				   }
				   //proximo a�o
				   $m=0;
				   $x=0;
				  // echo "year fin:"; echo "<br/>";
				    for ($m=1; $m<=$MFHS; $m++){       //meses

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){       //dias
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);
				    }
				   }
				  ////TERMINO DE ESCRIBIR LOS MES CON SUS DIAS CORRESPONDIENTE A LA TEMPORADA ALTA
				   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);

				  //INICIO PROCESO CON LAS FECHAS SELECCIONADAS PARA ESTA RESERVA A DETERMINAR LOS HS Y LS
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){//a�os
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){//meses
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){//dias

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }
				 }else{
				 	echo "Error year:Seasons";
				 	die();
				 }
			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }
			$LS_nights=($night_qty-$cant_noches_HS);          $HS_nights=$cant_noches_HS;
			$before_priceHS=$price_HS;
			$before_priceLS=$price_default;
			$price_HS=price_mid($bed=$casa['bed'], $normal_price=$price_HS);
			$price_default=price_mid($bed=$casa['bed'], $normal_price=$price_default);

			if (($LS_nights=="0")&&($HS_nights>=
			"1")){    //solo HS
             ?>
            	<? if ($_SESSION['info']['level']==1){?>
		       		PriceHS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceHS?></span></strike><span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="price" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceHS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceHS?></span></strike><span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="price" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}elseif(($HS_nights=="0")&&($LS_nights>="1")){ //solo LS
             ?>
	             <? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceLS?></span></strike><span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		<input type="hidden" name="priceHS" value="0" />
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceLS?></span></strike><span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	<input type="hidden" name="priceHS" value="0" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?

			}else{ //existen ambas
                 ?>
             	<? if ($_SESSION['info']['level']==1){?>
		       		PriceLS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceLS?></span></strike><span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_default,2);?>" /></span>
		       		PriceHS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceHS?></span></strike><span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
		       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}else{?>
	            	PriceLS&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceLS?></span></strike><span class="azul"><?=number_format($price_default,2);?></span>
	            	<input type="hidden" name="price" value="<?=number_format($price_default,2);?>" />
	            	PriceLH&nbsp;<strike><span style="color:green; font-size:14px;"><?=$before_priceHS?></span></strike><span class="azul"><?=number_format($price_HS,2);?></span>
	            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
	            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
	            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	            <?}?>
            <?
			}
//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------
           ?>
          <!--// promotion code//-->
             <br>
             <!--Promotion code:<input type="text" size="7" name="promotion_code" />-->
           <!--// promotion code//-->
	       </p>
	       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
	       </fieldset></td><td><fieldset><legend>Additional Services</legend>
	       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
	       <div style="height:174px; overflow:auto;">
	       <?

            $servicios_activos=$_SESSION['consultas']->show_all_active('serv_add', 'id');
            //falta arreglar los servicios de laundry que se calculan de acurdo a la cantidad de dia de la reserva
			nuevo_servicios_bookings($servicios_activos,$qty_nights);
			selectServices($start_date=$starting_date);
           ?>
           </div>
	       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
	       </fieldset></td></tr>
	       <tr><td colspan="2"><fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
	       <!--INFORMACIONES DE LA RENTA INICIA-->
	      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
	       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
	       <option value="<?=$i?>" <? if ($post['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
	       <? for ($i=0; $i<=($casa['capacity']/2);$i++){?>
	       <option value="<?=$i?>" <? if ($post['children'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
	       <? } ?>
	       </select>&nbsp;&nbsp;&nbsp;
		   <? $customers=$_SESSION['consultas']->customers();?>
			 Customer: <select name="client" size=1 required="required">
			 <option value="">None</option>
			 <? foreach ($customers as $cu ) {     //$owner as $k => $v
								?><option value=<?=$cu['id']?><? if ($_SESSION['client']['new'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)<?/*=utf8_encode($cu['name'])." ".utf8_encode($cu['lastname'])*/?></option>
								<?
			 } ?></select><!-- <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onclick="reserva('new-client1.php','Creat a new client', 530, 800)">New customer</a></span>&nbsp;&nbsp;&nbsp;--></p>

	      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span><u><span style="color:#09F"><?=formatear_fecha($starting_date);?></span></u> <span style="font-weight:bold;">Ending date: </span><u><span style="color:#09F"><?=formatear_fecha($ending_date);?></span></u><span style="font-weight:bold;"> Total nights: </span><u><span style="color:#09F"><?=$qty_nights?></span></u></p>

	      <p style="text-align:leftt; font-size:11px;">
		      <span style="font-weight:bold;">Status:</span>
		      <span style="color:#09F">
			      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
			      	<input type="radio" name="status" value="37" checked="checked">Checked out
			      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
				     <input type="radio" name="status" value="34" checked="checked">Checking in
				     <input type="radio" name="status" value="36">Confirmed
				     <input type="radio" name="status" value="35" >No confirmed
			      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
			      	 <input type="radio" name="status" value="36" >Confirmed
				     <input type="radio" name="status" value="35" checked="checked">No confirmed
				  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
                    <input type="radio" name="status" value="34" checked="checked">Checked in
				  <?}?>
		      </span>
			<?php if($_SESSION['info']['agentes']==1){?>
		      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$_SESSION['consultas']->show_all_active('commission', 'name');  ///elegir solo los activos
							echo "<select name=\"referal\" >";?>
							<option value="0" <? if ((!$_POST['referal'])&&(!$_SESSION['referal']['new'])) echo "selected='selected'"; ?>>None</option>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if (($_POST['referal']==$k['id'])||($_SESSION['referal']['new']==$k['id'])) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></option>
							<?
							}
							echo "</select>";
							if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
							//ending referals
				?>
			<?php }?>
		      <!--///*REFERAL AGENTS*///-->
	      </p>
	       <?/*=expedia_fields($id_exp='', $amount_exp='');*/?>
	     <!--// <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"></textarea> </p>//-->
	       </fieldset></td></tr>

	       <tr><td>

	       <input class="book_but" type="button" onClick="location.href='short-term-book.php?villa=<?=$selected_villa_id?>&v2=<?=$selected_villa_id?>&start=<?=$starting_date?>&end=<?=$ending_date?>'" value="Back" title="Hit to go back"></td><td><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>
	       <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Made by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
	       </table></form>
	   <!--INFORMACIONES DE LA RENTA TERMINAN-->

	      <?
	        break;
		/*========= END MID TERM RENTAL ====================*/
	 } //end swich for bookings (long, short, owner, vip, etc).


 }else{
	header('Location:login.php');
	die();
  }
?>