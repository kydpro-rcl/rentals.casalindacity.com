<?
if ($_POST['refnumb']) $reference=$_POST['refnumb'];
if ($_GET['refnumb']) $reference=$_GET['refnumb'];
	$db= new getQueries();

 if ($reference!=""){
	$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
	$book=$db->see_occupancy_ref($reference); /*//get reservation details*/

    if (!empty($book)){
     $estado=$book[0]['status'];
     if((($estado==4)||($estado==11)||($estado==14)||($estado==18)||($estado==21)||($estado==25))&&($_SESSION['info']['manager']!=1)){ /* //only if booking is checkout and user is not the manager*/
   		echo "<h2>You are not authorized to change the reservation</h2>";
   		/*//echo $_SESSION['info']['manager'];*/
     }else{
	 $villa=$db->villa($book[0]['villa']); /*//get villa details*/
	 $cl=$db->customer($book[0]['client']);/*//get cliente details*/
            /*//=========================EXPEDIA============================================
     		#$link= new getQueries();*/
		    $expedia=$db->show_any_data_limit1('expedia', 'rcl_ref', $reference, '=');
           /*//------------------------------------------------------------------------------*/
	$customers=$db->customers();

	$villas=$db->showTable_restrinted("villas","able_r=1","no");  /*//SHOW ONLY VILLAS AVAILABLE FOR RENT*/
	$gente_reserva=$db->people($book[0]['reserveid']);/*//get people names*/
	$servicios_reserva=$db->services_reserved($book[0]['reserveid']); /*//get services reserved*/
      /* PRINT_R($servicios_reserva); */
      if (($estado==1)||($estado==2)||($estado==3)||($estado==4)||($estado==6)||($estado==12)||($estado==13)||($estado==14)){  /*//short rental-vip, short, buyer short*/
		 ?>

		<!--titulo-->
		<p>&nbsp;</p>
		  <h2>Editing booking <span style="color:black;">No.<?=$reference?></span> - Short Rental<? if (($estado==6)||($estado==12)||($estado==13)||($estado==14)) echo ", <span style=\"color:red\">VIP</span>";?>
		  <? if (($estado==30)||($estado==31)||($estado==32)||($estado==33)) echo ", <span style=\"color:red\">Buyer</span>";?>
		  </h2>
		  <hr/>
		<form name="change_booked" action="edit-booking1.php" method="post">
		  <table width="100%" border="0"><tr><td colspan="2" align="center">
			<p class="p_inline">
			<?php if($_SESSION['info']['movevillas']==1){?>
				Villa: <select name="villa" >
				<? foreach ($villas as $k){?>
				<option value="<?=$k['id']?>" <? if ($k['id'] == $book[0]['villa']) {echo " SELECTED";} ?>><?=$k['no']?></option>
				<? }?>
				</select>
			<?}else{?>
				Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
			<?php } ?>
			 </p>

	    <p class="p_inline">
	    	From: <input type="text" name="from" value="<?=$book[0]['start']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    <p class="p_inline">
	    	To: <input type="text" name="to" value="<?=$book[0]['end']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    </td></tr>
	    <tr><td colspan="2" align="center">
	    <?
	    if (($estado!=6)&&($estado!=12)&&($estado!=13)&&($estado!=14)){/*//it is not an vip*/
	    	?>
	    <!--NORMAL CLIENTS-->
	    <p id="parraf" style="text-align:center;">
	    	Customer: <select name="client" size="1">
	      <? foreach ($customers as $cu ) { ?>
	            <option value="<?=$cu['id']?>" <? if ($cu['id'] == $book[0]['client']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?>	</option>
	      <? } ?></select>

		  <?php if($_SESSION['info']['agentes']==1){?>
	      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  /*//starting referals   $_SESSION['consultas']*/
						$commisioners=$db->show_all_active('commission', 'name');  /*///elegir solo los activos*/
						$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
							echo "<select name=\"referal\" >";?>
							<option value="0" >None</opcion>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
							<?
							}
							echo "</select>";
				?>
		      <!--///*REFERAL AGENTS*///-->
		  <?php }else{
			  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
			  if ($referido_anterior[0]['id_referal']!=0){
				echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
			  }
		  } ?>
	    </p><?/*=expedia_fields($id_exp=$expedia[0]['exp_id'], $amount_exp=$expedia[0]['exp_amount']);*/?>
        <!--NORMAL CLIENTS-->
        <?}else{?>
           <p id="parraf" style="text-align:center;">
          <? $customers=$db->customers_vip();?>
			 Customer VIP: <select name="client" size=1><? foreach ($customers as $cu ) {     /*//$owner as $k => $v*/
								?><option value=<?=$cu['id']?><? if ($post['client'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?></option>
								<?
							} ?></select>
							
		<?php if($_SESSION['info']['agentes']==1){?>
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  /*//starting referals   $_SESSION['consultas']*/
						$commisioners=$db->show_all_active('commission', 'name');  /*///elegir solo los activos*/
						$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');

							echo "<select name=\"referal\" >";?>
							<option value="0" >None</opcion>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
							<?
							}
							echo "</select>";

				?>
		      <!--///*REFERAL AGENTS*///-->
		<?php 
		}else{
			  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
			  if ($referido_anterior[0]['id_referal']!=0){
				echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
			 }
		  }
			?>
		      <?=expedia_fields($id_exp=$expedia[0]['exp_id'], $amount_exp=$expedia[0]['exp_amount']);?>
			</p>
        <?}?>
        </td></tr>
        <tr><td>
            <!--//  <p><?/* print_r($villa);*/?></p>//-->
	   &nbsp;

	  <!--//  <p id="parraf">
	     	Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$book[0]['rc']?></textarea>
	    </p>//-->
	    </td><td>
	    <fieldset><legend>Additional Services</legend>
		       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
		       <table align="center"><tr><td valign="top">
		       <?
			   $qty_nights=$book[0]['nights'];
               // ChangeServices($reference, $start_date=$book[0]['start']);/*rental car*/
			    /*$servicios=$db->show_all($table='services', $order='id');
				servicios_reserva($servicios,$qty_nights, $beds=$casa['bed']);*/
		       ?>
              </td><td>
             <?
             	$array_servicios_activos=$db->show_all_active('serv_add', 'id');
             	
             	$services_booked=array();/*//this array must be created even if there is not service, so don't get error if empty.*/
	            if (!empty($servicios_reserva)){
					foreach ($servicios_reserva as $s){
						if($s['tipo']!=2){
							array_push($services_booked,$s['id_service']);
						}
						
	                }
	            }
         	   editar_servicios_bookings($array_servicios_activos,$qty_nights,$services_booked,$book[0]['reserveid']);
             ?>
            </td></tr></table>


		 </fieldset>
	    </td></tr>
	    <tr><td colspan="2">
	     <p id="parraf" style="text-align:left;">
	    	Adults: <select name="adults">
	        			<? for ($i=1; $i<=$villa[0]['capacity']; $i++){?>
							<option value="<?=$i?>" <? if ($book[0]['adults']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	                 </select>
	    	Children:
	        	<select name="children">
	        			<? for ($i=0; $i<=($villa[0]['capacity']/2); $i++){?>
							<option value="<?=$i?>"  <? if ($book[0]['kids']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	             </select>
	    </p>
	    <hr />
	    <p style="text-align:right; font-weight:bold; padding:0px 50px 0px 0px;">
	    	<input type="hidden" name="busyid" value="<?=$book[0]['busyid']?>"/>
	        <input type="hidden" name="ref" value="<?=$reference?>"/>
			<input type="hidden" name="reserveid" value="<?=$book[0]['reserveid']?>" ? />
	        <input type="hidden" name="status" value="<?=$book[0]['status']?>" ? />
	    	<input type="submit" value="continue" name="continue" class="book_but"/>
	    </p>
	    </td></tr></table>
		</form>
 	 <?
      }
	  
	      if (($estado==34)||($estado==35)||($estado==36)||($estado==37)){  /*//MID TERM rental*/
		 ?>

		<!--titulo-->
		<p>&nbsp;</p>
		  <h2>Editing booking <span style="color:black;">No.<?=$reference?></span> - MID TERM Rental<? if (($estado==6)||($estado==12)||($estado==13)||($estado==14)) echo ", <span style=\"color:red\">VIP</span>";?>
		  <? if (($estado==30)||($estado==31)||($estado==32)||($estado==33)) echo ", <span style=\"color:red\">Buyer</span>";?>
		  </h2>
		  <hr/>
		<form name="change_booked" action="edit-booking1.php" method="post">
		  <table width="100%" border="0"><tr><td colspan="2" align="center">
			<p class="p_inline">
			
			<?php if($_SESSION['info']['movevillas']==1){?>
				Villa: <select name="villa">
				<? foreach ($villas as $k){?>
				<option value="<?=$k['id']?>" <? if ($k['id'] == $book[0]['villa']) {echo " SELECTED";} ?>><?=$k['no']?></option>
				<? }?>
				</select>
			<?}else{?>
				Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
			<?php } ?>
			 </p>

	    <p class="p_inline">
	    	From: <input type="text" name="from" value="<?=$book[0]['start']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    <p class="p_inline">
	    	To: <input type="text" name="to" value="<?=$book[0]['end']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    </td></tr>
	    <tr><td colspan="2" align="center">
	    <?
	    if (($estado!=6)&&($estado!=12)&&($estado!=13)&&($estado!=14)){//it is not an vip
	    	?>
	    <!--NORMAL CLIENTS-->
	    <p id="parraf" style="text-align:center;">
	    	Customer: <select name="client" size="1">
	      <? foreach ($customers as $cu ) { ?>
	            <option value="<?=$cu['id']?>" <? if ($cu['id'] == $book[0]['client']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?>	</option>
	      <? } ?></select>

		    <?php if($_SESSION['info']['agentes']==1){?>
	      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$db->show_all_active('commission', 'name');  ///elegir solo los activos
						$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
							echo "<select name=\"referal\" >";?>
							<option value="0" >None</opcion>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
							<?
							}
							echo "</select>";

				?>
		      <!--///*REFERAL AGENTS*///-->
			<?php
			}else{
			  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
			  if ($referido_anterior[0]['id_referal']!=0){
				echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
			 }
		  }?>
	    </p><?/*=expedia_fields($id_exp=$expedia[0]['exp_id'], $amount_exp=$expedia[0]['exp_amount']);*/?>
        <!--NORMAL CLIENTS-->
        <?}else{?>
           <p id="parraf" style="text-align:center;">
          <? $customers=$db->customers_vip();?>
			 Customer VIP: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
								?><option value=<?=$cu['id']?><? if ($post['client'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?></option>
								<?
							} ?></select>
				
  <?php if($_SESSION['info']['agentes']==1){?>				
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$db->show_all_active('commission', 'name');  ///elegir solo los activos
						$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');

							echo "<select name=\"referal\" >";?>
							<option value="0" >None</opcion>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
							<?
							}
							echo "</select>";

				?>
		      <!--///*REFERAL AGENTS*///-->
  <?php }else{
			  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
			  if ($referido_anterior[0]['id_referal']!=0){
				echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
			 }
		  }?>
		      <?=expedia_fields($id_exp=$expedia[0]['exp_id'], $amount_exp=$expedia[0]['exp_amount']);?>
			</p>
        <?}?>
        </td></tr>
        <tr><td>
            <!--//  <p><?/* print_r($villa);*/?></p>//-->
	   &nbsp;

	  <!--//  <p id="parraf">
	     	Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$book[0]['rc']?></textarea>
	    </p>//-->
	    </td><td>
	    <fieldset><legend>Additional Services</legend>
		       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
		       <table align="center"><tr><td valign="top">
		       <?
                ChangeServices($reference, $start_date=$book[0]['start']);/*rental car*/
		       ?>
              </td><td>
             <?
             	$array_servicios_activos=$db->show_all_active('serv_add', 'id');
             	$qty_nights=$book[0]['nights'];
             	$services_booked=array();//this array must be created even if there is not service, so don't get error if empty.
	            if (!empty($servicios_reserva)){
					foreach ($servicios_reserva as $s){
						array_push($services_booked,$s['serviceid']);
	                }
	            }
         	   editar_servicios_bookings($array_servicios_activos,$qty_nights,$services_booked,$book[0]['reserveid']);
             ?>
            </td></tr></table>


		 </fieldset>
	    </td></tr>
	    <tr><td colspan="2">
	     <p id="parraf" style="text-align:left;">
	    	Adults: <select name="adults">
	        			<? for ($i=1; $i<=$villa[0]['capacity']; $i++){?>
							<option value="<?=$i?>" <? if ($book[0]['adults']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	                 </select>
	    	Children:
	        	<select name="children">
	        			<? for ($i=0; $i<=($villa[0]['capacity']/2); $i++){?>
							<option value="<?=$i?>"  <? if ($book[0]['kids']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	             </select>
	    </p>
	    <hr />
	    <p style="text-align:right; font-weight:bold; padding:0px 50px 0px 0px;">
	    	<input type="hidden" name="busyid" value="<?=$book[0]['busyid']?>"/>
	        <input type="hidden" name="ref" value="<?=$reference?>"/>
			<input type="hidden" name="reserveid" value="<?=$book[0]['reserveid']?>" ? />
	        <input type="hidden" name="status" value="<?=$book[0]['status']?>" ? />
	    	<input type="submit" value="continue" name="continue" class="book_but"/>
	    </p>
	    </td></tr></table>
		</form>
 	 <?
      }

       if ($estado==5){ //Maintenance
		  if ($_SESSION['info']['level']==1){
		         ?>
		            <!---------------------------------------------------------------->

					  	<script language="javascript" src="js/formfields.js"></script>
						<script language="javascript" src="js/formvalidation.js"></script>
					  <h2 style="text-align:center; color:#06C;">Editing Maintenance</h2>
					  <hr />
			       <form method="post" name="maintenance" action="edit_maintenance.php" >


					  <div class="book_inserted1" style="padding:7px 0px 12px 0px;">
				 	<p class="bloques">
					
					<?php if($_SESSION['info']['movevillas']==1){?>
					Villa:
					 	<select name="villa">
							<? foreach ($villas as $k){?>
							<option value="<?=$k['id']?>" <? if ($k['id'] == $book[0]['villa']) {echo " SELECTED";} ?>><?=$k['no']?></option>
							<? }?>
						</select>
						<?}else{?>
							Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
						<?php } ?>
					</p>
				 	<p class="bloques">From:<input type="text" name="from" value="<?=$book[0]['start']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span></p>
				 	<p class="bloques">To:<input type="text" name="to" value="<?=$book[0]['end']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span></p>
				 </div><!--END SHOWING DATES AND VILLA-->

					 <div style="text-align:center; width:400px; margin:0 auto;" >

			           	<p id="fields" style="text-align:justify;"><span style="font-size:11px; color:red;text-transform:uppercase;">If you need to type an extra note for this maintenance, you can do it below or later on the booking details choosing the comments tab:</span><br/>
			           		<textarea name="reasons" cols="60" rows="15"><?=$book[0]['rc']?></textarea>&nbsp;
			           	<br/>
				      	<input class="book_but" type="submit" name="confirm" value="Confirm" /></p>
				      	<input type="hidden" name="ref" value="<?=$book[0]['ref']?>" />
				      </form>
					 </div>
					  <!--------------------------------------------------------->

          <?   }else{
 	 	    echo "<h2>You are not authorized to change this maintenance</h2>";
 	      }


       }


    	if (($estado==8)||($estado==9)||($estado==10)||($estado==11)||($estado==22)||($estado==23)||($estado==24)||($estado==25)){ //Long Rental
         ?>
            <!---------------------------------------------------------------->
			<?

		  $info_book=$book[0];
		 // $price_default=$info_book['price'];
	      $starting_date=$info_book['start']; $ending_date=$info_book['end'];
           $qty_nights=$info_book['nights'];
	       $casa=$villa[0];

		 if ($_SESSION['info']['manager']!=1){// if this user is not MANAGER
		            // echo $qty_nights." nights";
		        if ($qty_nights<30){
		             	echo $qty_nights." nights";
		             	echo "<br/>";
		             	echo "<span style='color:red'>Long term rental must be minimun 30 NIGHTS</span>";
		        }else{
		             //============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================
		                 ?>

				   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
			       <h2 style="text-align:center; color:red;">Changing a <? if(($estado==22)||($estado==23)||($estado==24)||($estado==25)){?><span style="color:green">Owner</span><?}?> Long Term Rental - <span style="color:black">Booking <?=$reference?></span></h2>
			        <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/1-4.png" alt="" width="571px" height="33px"/> </div>
			       <hr />
			       <form method="post" action="edit_long_term_rental2.php">
			       <input type="hidden" name="rate" value="regular" />
			       <input type="hidden" name="reference" value="<?=$info_book['ref']?>"/>
			       <table align="center"><tr><td width="300"><fieldset><legend>Villa details</legend>
			       <!--INFORMACIONES DE LA VILLAS INICIAN-->

			       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
			       <p id="td0" style="font-weight:bold;">
				   
				<?php if($_SESSION['info']['movevillas']==1){?>
				   No.
			        <select name="villa">
						<? foreach ($villas as $k){?>
						<option value="<?=$k['id']?>" <? if ($k['id'] == $casa['id']) {echo " SELECTED";} ?>><?=$k['no']?></option>
						<? }?>
					</select>
					<?}else{?>
						Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
					<?php } ?>
			        </p>
			       <p id="td0" style="font-weight:bold;">Size:<span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
			       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

			       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
		           <!--START PRICE FOR THIS RENT-->
		           <?
		           if ($info_book['PL']!=0){
		              $price_long=$info_book['PL'];
		           }else{
		              $price_long=$casa['p_long'];
		           }

		             	 if ($_SESSION['info']['level']==1){?>
				       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
			            <?}else{?>
			            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
			            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
			            <?}?>


			       </p>
			       <!--END PRICE FOR THIS RENT-->


			       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
			       </fieldset></td><td>
				           <!--//servicios long term//-->
		              <fieldset><legend>Dates and Customer</legend>

					      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span>
					      	<input type="text" name="fecha_inicio" size="9" value="<?=$starting_date?>"/>&nbsp;<span style="font-size:9px;color:#09F">(YYYY-MM-DD)</span>
					      </p>
					      <P  style="text-align:leftt; font-size:11px;">
					       <span style="font-weight:bold;">Ending date: </span>
					       <input type="text" name="fecha_final" size="9" value="<?=$ending_date?>"/>&nbsp;<span style="font-size:9px;color:#09F">(YYYY-MM-DD)</span>
					       </p>
					        <p style="text-align:leftt; font-weight:bold; font-size:11px;">
							   <? if(($estado==22)||($estado==23)||($estado==24)||($estado==25)){?>
					           <? $owners=$db->owners();?>
								 <span  style="color:#5e7d07;">Owner:</span>
								 	<select name="client">
								 		<? foreach ($owners as $ow ) { ?>
											<option value=<?=$ow['id']?><? if ($book[0]['client'] == $ow['id']) {echo " SELECTED";} ?>>
												<? $vils=$db->show_data('villas', "`id_owner`=".$ow['id'], 'id');?>
												<? echo $ow['name']." ".$ow['lastname']; foreach( $vils as $vi){ echo " (".$vi['no'].") "; }?>
											</option>
										<?}?>
									</select>
                            <?}else{?>
							   <? $customers=$db->customers();?>
								 Customer: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
									?> <option value=<?=$cu['id']?>
											<? if ($info_book['client'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
										</option>
								 <?} ?></select>
							<?}?>
							</p>
							<!--///*REFERAL AGENTS*///-->
					<?php if($_SESSION['info']['agentes']==1){?>
					 <p style="text-align:leftt; font-weight:bold; font-size:11px;">
				      	<span style="font-weight:bold;">Referral:</span>
				      	<?php
			                  //starting referals   $_SESSION['consultas']
								$commisioners=$db->show_all_active('commission', 'id');  ///elegir solo los activos
								$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');

									echo "<select name=\"referal\" >";?>
									<option value="0" >None</opcion>
									<?	foreach ($commisioners as $k){
									?>
			                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
									<?
									}
									echo "</select>";
									//if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
									//ending referals
						?>
				      <!--///*REFERAL AGENTS*///-->
				      </p>
					<?php }else{
						  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
						  if ($referido_anterior[0]['id_referal']!=0){
							echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
						 }
					  }?>
		          </fieldset>
				</td></tr>
				<tr><td colspan="2">
				<!--//	<fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
					    <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$info_book['rc']?></textarea> </p>
		       		</fieldset>//-->

			    </td></tr>
			    <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Modified by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
				<tr><td>
			      &nbsp;</td><td align="right"><input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>

			       </table></form>
			   <!--INFORMACIONES DE LA RENTA TERMINAN-->

			      <? }
               //============= TERMINA LONG TERM RENTAL PARTE 1 =====================
         //echo "<h1>Sorry, we are working on this...coming soon.</h1>";
         }

         if ($_SESSION['info']['manager']==1){// if this user is an MANAGER
		            // echo $qty_nights." nights";
		        if ($qty_nights<1){
		             	echo $qty_nights." nights";
		             	echo "<br/>";
		             	echo "<span style='color:red'>Long term rental must be minimun 4 weeks (30 nights)</span>";
		        }else{
		             //============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================
		                 ?>

				   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
			       <h2 style="text-align:center; color:red;">Changing a <? if(($estado==22)||($estado==23)||($estado==24)||($estado==25)){?><span style="color:green">Owner</span><?}?> Long Term Rental - <span style="color:black">Booking <?=$reference?></span></h2>
			        <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/1-4.png" alt="" width="571px" height="33px"/> </div>
			         <? if ($qty_nights<21){?>
	 	    			<p style="color:white; background-color:green; font-size:12px; padding:3px;">WARNING: This long term rental has less than the minimum 30 nights required (<?=$qty_nights?> nights in the booking), pricing will apply as a month.</p>
	 	   			 <? }?>
			       <hr />
			       <form method="post" action="edit_long_term_rental2.php">
			       <input type="hidden" name="reference" value="<?=$info_book['ref']?>"/>
			       <table align="center"><tr><td width="300"><fieldset><legend>Villa details</legend>
			       <!--INFORMACIONES DE LA VILLAS INICIAN-->

			       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
			       <p id="td0" style="font-weight:bold;">
				   <?php if($_SESSION['info']['movevillas']==1){?>
				   No.
			        <select name="villa">
						<? foreach ($villas as $k){?>
						<option value="<?=$k['id']?>" <? if ($k['id'] == $casa['id']) {echo " SELECTED";} ?>><?=$k['no']?></option>
						<? }?>
					</select>
					<?}else{?>
						Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
					<?php } ?>
			        </p>
			       <p id="td0" style="font-weight:bold;">Size:<span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
			       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

			       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
		           <!--START PRICE FOR THIS RENT-->
		           <?
		           if ($info_book['PL']!=0){
		              $price_long=$info_book['PL'];
		           }else{
		              $price_long=$casa['p_long'];
		           }

		             	 if ($_SESSION['info']['level']==1){?>
				       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
			            <?}else{?>
			            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
			            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
			            <?}?>


			       </p>
			       <!--END PRICE FOR THIS RENT-->


			       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
			       </fieldset></td><td>
				           <!--//servicios long term//-->
		              <fieldset><legend>Dates and Customer</legend>

					      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span>
					      	<input type="text" name="fecha_inicio" size="9" value="<?=$starting_date?>"/>&nbsp;<span style="font-size:9px;color:#09F">(YYYY-MM-DD)</span>
					      </p>
					      <P  style="text-align:leftt; font-size:11px;">
					       <span style="font-weight:bold;">Ending date: </span>
					       <input type="text" name="fecha_final" size="9" value="<?=$ending_date?>"/>&nbsp;<span style="font-size:9px;color:#09F">(YYYY-MM-DD)</span>
					       </p>
					        <p style="text-align:leftt; font-weight:bold; font-size:11px;">
					        <? if(($estado==22)||($estado==23)||($estado==24)||($estado==25)){?>
					           <? $owners=$db->owners();?>
								 <span  style="color:#5e7d07;">Owner:</span>
								 	<select name="client">
								 		<? foreach ($owners as $ow ) { ?>
											<option value=<?=$ow['id']?><? if ($book[0]['client'] == $ow['id']) {echo " SELECTED";} ?>>
												<? $vils=$db->show_data('villas', "`id_owner`=".$ow['id'], 'id');?>
												<? echo $ow['name']." ".$ow['lastname']; foreach( $vils as $vi){ echo " (".$vi['no'].") "; }?>
											</option>
										<?}?>
									</select>
                            <?}else{?>
							   <? $customers=$db->customers();?>
								 Customer: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
									?> <option value=<?=$cu['id']?>
											<? if ($info_book['client'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
										</option>
								 <?} ?></select>
							<?}?>
							</p>
					  <?php if($_SESSION['info']['agentes']==1){?>
							<!--///*REFERAL AGENTS*///-->
					 <p style="text-align:leftt; font-weight:bold; font-size:11px;">
				      	<span style="font-weight:bold;">Referral:</span>
				      	<?php
			                  //starting referals   $_SESSION['consultas']
								$commisioners=$db->show_all_active('commission', 'id');  ///elegir solo los activos
								$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');

									echo "<select name=\"referal\" >";?>
									<option value="0" >None</opcion>
									<?	foreach ($commisioners as $k){
									?>
			                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
									<?
									}
									echo "</select>";
									//if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
									//ending referals
						?>
				      <!--///*REFERAL AGENTS*///-->
				      </p>
					  <?php }else{
						  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
						  if ($referido_anterior[0]['id_referal']!=0){
							echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
						 }
					  }?>
		          </fieldset>
				</td></tr>
					<? if ($_SESSION['info']['level']==1){ //start flat fee
						 $flat_guardado=$db->show_active_limit1($table='flat_amount_long', $field='ref', $value=$reference, $operator='=');
						 $flat=$flat_guardado[0];
						// print_r( $flat); echo 'arreglo';
				       	?>
				       <tr><td colspan="2">
				       <!--Flat Feet per month and per booking start here-->
				       <p style="text-align:right; font-weight:bold"><span id="td0">
				      	 <input type="radio" name="rate" value="regular" id="regular_rate" <? if(!$flat){?>CHECKED <?}?> >Regular pricing</input>
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
						 <input type="radio" name="rate" value="flat_month" id="Flat_month"  <? if($flat['flat_type']==1){?>CHECKED <?}?>>Flat amount per Months</input>
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
						  <input type="text" name="FM" value="<? if($flat['flat_type']==1){ echo $flat['flat_amount']; }?>" <? if($flat['flat_type']!=1){?> disabled="disabled" <?}?> id="FM" size="5"/>


						 <input type="radio" name="rate" value="flat_booking" id="Flat_booking"  <? if($flat['flat_type']==2){?>CHECKED <?}?>>Flat amount per booking</input>
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
						 <input type="text" id="FB" name="FB" value="<? if($flat['flat_type']==2){ echo $flat['flat_amount']; }?>" size="5" <? if($flat['flat_type']!=2){?> disabled="disabled" <?}?>/>
						</span></p>
					   <!--Flat Feet per month and per booking start here-->
					  </td></tr>
			        <?}else{?>
			          <tr><td colspan="2">
			             <input type="hidden" name="rate" value="regular" />
			          </td></tr>
			        <?}// end flat fee
			          ?>
				<tr><td colspan="2">
					<!--//<fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
					    <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$info_book['rc']?></textarea> </p>
		       		</fieldset>//-->&nbsp;
			    </td></tr>
			    <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Modified by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
				<tr><td>
			      &nbsp;</td><td align="right">
			      <input type="hidden" name="estado" value="<?=$estado?>"/>
			      <input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>

			       </table></form>
			   <!--INFORMACIONES DE LA RENTA TERMINAN-->

			      <? }
               //============= TERMINA LONG TERM RENTAL PARTE 1 =====================
         //echo "<h1>Sorry, we are working on this...coming soon.</h1>";
         }
       }

       /*===========================================================================START CHANGING BUYER==================================================================*/
        if (($estado==26)||($estado==27)||($estado==28)||($estado==29)||($estado==30)||($estado==31)||($estado==32)||($estado==33)){ //BUYER  LONG TERM  AND SHORT TERM
         ?>
            <!---------------------------------------------------------------->
			<?

		  $info_book=$book[0];
		 // $price_default=$info_book['price'];
	      $starting_date=$info_book['start']; $ending_date=$info_book['end'];
           $qty_nights=$info_book['nights'];
	       $casa=$villa[0];


         if ($_SESSION['info']['manager']==1){// if this user is an MANAGER
		            // echo $qty_nights." nights";
		        if ($qty_nights<1){
		             	echo $qty_nights." nights";
		             	echo "<br/>";
		             	echo "<span style='color:red'>Error in quantity of nights</span>";
		        }else{
		             //============= EMPIEZA LONG TERM RENTAL PARTE 1 =====================
		                 ?>

				   <!--<img src="images/logo.gif" border="0" style="float:left"><br/>-->
			       <h2 style="text-align:center; color:red;">Changing Buyer Booking - <span style="color:black">Booking <?=$reference?></span></h2>
			        <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/1-4.png" alt="" width="571px" height="33px"/> </div>
			         <? /*if ($qty_nights<21){?>
	 	    			<p style="color:white; background-color:green; font-size:12px; padding:3px;">WARNING: This long term rental has less than the minimum 30 nights required (<?=$qty_nights?> nights in the booking), pricing will apply as a month.</p>
	 	   			 <? }*/?>
			       <hr />
			       <form method="post" action="edit_buyer2.php">
			       <input type="hidden" name="reference" value="<?=$info_book['ref']?>"/>
			       <table align="center"><tr><td width="300"><fieldset><legend>Villa details</legend>
			       <!--INFORMACIONES DE LA VILLAS INICIAN-->

			       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
			       <p id="td0" style="font-weight:bold;">
				   <?php if($_SESSION['info']['movevillas']==1){?>
				   No.
			        <select name="villa">
						<? foreach ($villas as $k){?>
						<option value="<?=$k['id']?>" <? if ($k['id'] == $casa['id']) {echo " SELECTED";} ?>><?=$k['no']?></option>
						<? }?>
					</select>
					<?}else{?>
						Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
					<?php } ?>
			        </p>
			       <p id="td0" style="font-weight:bold;">Size:<span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
			       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

			       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
		           <!--START PRICE FOR THIS RENT-->
		           <?
		           if ($info_book['PL']!=0){
		              $price_long=$info_book['PL'];
		           }else{
		              $price_long=$casa['p_long'];
		           }

		             	 if ($_SESSION['info']['level']==1){?>
				       	 	Price&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price_long" size="5" value="<?=$price_long;?>" /></span>
			            <?}else{?>
			            	Price&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_long,2);?></span>
			            	<input type="hidden" name="price_long" value="<?=number_format($price_long,2);?>" />
			            <?}?>


			       </p>
			       <!--END PRICE FOR THIS RENT-->


			       <!--INFORMACIONES DE LA VILLAS TERMINAN-->
			       </fieldset></td><td>
				           <!--//servicios long term//-->
		              <fieldset><legend>Dates and Customer</legend>

					      <P  style="text-align:leftt; font-size:11px;"><span style="font-weight:bold;">Starting Date: </span>
					      	<input type="text" name="fecha_inicio" size="9" value="<?=$starting_date?>"/>&nbsp;<span style="font-size:9px;color:#09F">(YYYY-MM-DD)</span>
					      </p>
					      <P  style="text-align:leftt; font-size:11px;">
					       <span style="font-weight:bold;">Ending date: </span>
					       <input type="text" name="fecha_final" size="9" value="<?=$ending_date?>"/>&nbsp;<span style="font-size:9px;color:#09F">(YYYY-MM-DD)</span>
					       </p>
					        <p style="text-align:leftt; font-weight:bold; font-size:11px;">
					        <? if(($estado==22)||($estado==23)||($estado==24)||($estado==25)){?>
					           <? $owners=$db->owners();?>
								 <span  style="color:#5e7d07;">Owner:</span>
								 	<select name="client">
								 		<? foreach ($owners as $ow ) { ?>
											<option value=<?=$ow['id']?><? if ($book[0]['client'] == $ow['id']) {echo " SELECTED";} ?>>
												<? $vils=$db->show_data('villas', "`id_owner`=".$ow['id'], 'id');?>
												<? echo $ow['name']." ".$ow['lastname']; foreach( $vils as $vi){ echo " (".$vi['no'].") "; }?>
											</option>
										<?}?>
									</select>
                            <?}else{?>
							   <? $customers=$db->customers();?>
								 Customer: <select name="client" size=1><? foreach ($customers as $cu ) {     //$owner as $k => $v
									?> <option value=<?=$cu['id']?>
											<? if ($info_book['client'] == $cu['id']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?> (<?=$cu['id']?>)
										</option>
								 <?} ?></select>
							<?}?>
							</p>
							
					  <?php if($_SESSION['info']['agentes']==1){?>
							<!--///*REFERAL AGENTS*///-->
					 <p style="text-align:leftt; font-weight:bold; font-size:11px;">
				      	<span style="font-weight:bold;">Referral:</span>
				      	<?php
			                  //starting referals   $_SESSION['consultas']
								$commisioners=$db->show_all_active('commission', 'id');  ///elegir solo los activos
								$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');

									echo "<select name=\"referal\" >";?>
									<option value="0" >None</opcion>
									<?	foreach ($commisioners as $k){
									?>
			                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
									<?
									}
									echo "</select>";
									//if ($_SESSION['referal']['new']) unset($_SESSION['referal']['new']);/*QUITAR REFERAL*/
									//ending referals
						?>
				      <!--///*REFERAL AGENTS*///-->
				      </p>
					  <?php }else{
						  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
						  if ($referido_anterior[0]['id_referal']!=0){
							echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
						 }
					  }?>
		          </fieldset>
				</td></tr>
					<? if ($_SESSION['info']['level']==1){ //start flat fee
						 $flat_guardado=$db->show_active_limit1($table='flat_amount_long', $field='ref', $value=$reference, $operator='=');
						 $flat=$flat_guardado[0];
						// print_r( $flat); echo 'arreglo';
				       	?>
				       <tr><td colspan="2">
				       <!--Flat Feet per month and per booking start here-->
				       <p style="text-align:right; font-weight:bold"><span id="td0">
				      	 <input type="radio" name="rate" value="regular" id="regular_rate" <? if(!$flat){?>CHECKED <?}?> >Regular pricing</input>
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
						 <input type="radio" name="rate" value="flat_month" id="Flat_month"  <? if($flat['flat_type']==1){?>CHECKED <?}?>>Flat amount per Months</input>
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
						  <input type="text" name="FM" value="<? if($flat['flat_type']==1){ echo $flat['flat_amount']; }?>" <? if($flat['flat_type']!=1){?> disabled="disabled" <?}?> id="FM" size="5"/>


						 <input type="radio" name="rate" value="flat_booking" id="Flat_booking"  <? if($flat['flat_type']==2){?>CHECKED <?}?>>Flat amount per booking</input>
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
						 <input type="text" id="FB" name="FB" value="<? if($flat['flat_type']==2){ echo $flat['flat_amount']; }?>" size="5" <? if($flat['flat_type']!=2){?> disabled="disabled" <?}?>/>
						</span></p>
					   <!--Flat Feet per month and per booking start here-->
					  </td></tr>
			        <?}else{?>
			          <tr><td colspan="2">
			             <input type="hidden" name="rate" value="regular" />
			          </td></tr>
			        <?}// end flat fee
			          ?>
				<tr><td colspan="2">
					<!--//<fieldset style="margin:5px; padding:5px;"><legend>Renting Details</legend>
					    <p style="text-align:leftt; font-weight:bold; font-size:11px;">Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$info_book['rc']?></textarea> </p>
		       		</fieldset>//-->&nbsp;
			    </td></tr>
			    <tr><td colspan="2"><p style="text-align:right; font-size:10px;"><span style="font-weight:bold;">Modified by: </span><span style="color:#09F"><u><? echo $_SESSION['info']['name']." ".$_SESSION['info']['lastname'];?></span></u> </p></td></tr>
				<tr><td>
			      &nbsp;</td><td align="right">
			      <input type="hidden" name="estado" value="<?=$estado?>"/>
			      <input class="book_but" type="submit" name="next" value="Next" title="Go to next step"  /></td></tr>

			       </table></form>
			   <!--INFORMACIONES DE LA RENTA TERMINAN-->

			      <? }
         }
       }

       /*=======================================END CHANGER BUYER===========================================================================================================*/

       if (($estado==7)||($estado==19)||($estado==20)||($estado==21)){ //owner, short term
         ?>

            <!--titulo-->
		<p>&nbsp;</p>
		  <h2 style="color:#13a703;">Editing booking <span style="color:black;">No.<?=$reference?></span> - Short Rental Owners<? if (($estado==6)||($estado==12)||($estado==13)||($estado==14)) echo ", <span style=\"color:red\">VIP</span>";?></h2>
		  <hr/>
		<form name="change_booked" action="edit_owner_so1.php" method="post">
		  <table width="100%" border="0"><tr><td colspan="2" align="center">
			<p class="p_inline">
			<?php if($_SESSION['info']['movevillas']==1){?>
				Villa: <select name="villa">
				<? foreach ($villas as $k){?>
				<option value="<?=$k['id']?>" <? if ($k['id'] == $book[0]['villa']) {echo " SELECTED";} ?>><?=$k['no']?></option>
				<? }?>
				</select>
			<?}else{?>
				Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
			<?php } ?>
			 </p>

	    <p class="p_inline">
	    	From: <input type="text" name="from" value="<?=$book[0]['start']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    <p class="p_inline">
	    	To: <input type="text" name="to" value="<?=$book[0]['end']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    </td></tr>
	    <tr><td colspan="2" align="center">
	    <?
	    //if (($estado!=6)&&($estado!=12)&&($estado!=13)&&($estado!=14)){//it is not an vip
	    	?>
	    <!--NORMAL CLIENTS-->
	    <p id="parraf" style="text-align:center;">
	    	 <? $owners=$db->owners();?>
			 <span  style="color:#5e7d07;">Owner:</span>
			 	<select name="client">
			 		<? foreach ($owners as $ow ) { ?>
						<option value=<?=$ow['id']?><? if ($book[0]['client'] == $ow['id']) {echo " SELECTED";} ?>>
							<? $vils=$db->show_data('villas', "`id_owner`=".$ow['id'], 'id');?>
							<? echo $ow['name']." ".$ow['lastname']; foreach( $vils as $vi){ echo " (".$vi['no'].") "; }?>
						</option>
					<?}?>
				</select>
  <?php if($_SESSION['info']['agentes']==1){?>
	      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  //starting referals   $_SESSION['consultas']
						$commisioners=$db->show_all_active('commission', 'id');  ///elegir solo los activos
						$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
							echo "<select name=\"referal\" >";?>
							<option value="0" >None</opcion>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
							<?
							}
							echo "</select>";

				?>
		      <!--///*REFERAL AGENTS*///-->
			  
  <?php }else{
			  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
			  if ($referido_anterior[0]['id_referal']!=0){
				echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
			 }
		  }?>
	    </p>
        <!--NORMAL CLIENTS-->

        </td></tr>
        <tr><td>
			&nbsp;

	    <!--//<p id="parraf">
	     	Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$book[0]['rc']?></textarea>
	    </p>//-->
	    </td><td>
	    <fieldset><legend>Additional Services</legend>
		       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
		       <?

		        $services_booked=array();//this array must be created even if there is not service, so don't get error if empty.
	            if (!empty($servicios_reserva)){

					foreach ($servicios_reserva as $s){

						array_push($services_booked,$s['id']);

	                }

	            }

			   ?>
			   <? $masaje=$db->services("massage");
			   ?>
		      <p style="text-align:right; font-weight:bold"><span id="td0" > Massages: </span><!--<br />--><select class="azul" style="text-align:right" name="massage" size=1>
		           <option value="0" >None</option>
				   <? foreach($masaje as $masaje){
	                 // echo $masaje['name']."<br>";
	      			?>
	                 <option value="<?=$masaje['id']?>"<? if (in_array($masaje['id'], $services_booked)) {echo " SELECTED";} ?>><?=$masaje['name']." ".$masaje['price']?></option>
	                 <?
	               }
	               ?></select>
	           </p>
		       <!--<br />-->
		         <? $pickup=$db->services("Airport Pick Up");?>
		       <p style="text-align:right; font-weight:bold">
	           		<span id="td0">Airport Pick up: </span><!--<br />-->
	                <select class="azul" style="text-align:right" name="pickup" size=1>
		       			<option value="0" >None</option>
					   <? foreach($pickup as $pickup){
	                     // echo $masaje['name']."<br>";
	                     ?>
	                     <option value="<?=$pickup['id']?>"<? if (in_array($pickup['id'], $services_booked)) {echo " SELECTED";} ?>><?=$pickup['name']." ".$pickup['price']?></option>
	                     <?
			  			 }
			   			?>
	                 </select>
	            </p>
		       <!--<br />-->
		        <? $VIPpickup=$db->services("VIP Airport Pick Up");?>
		       <p style="text-align:right; font-weight:bold">
	           		<span id="td0">VIP Airport Pick up: </span><!--<br />-->
	                <select class="azul" style="text-align:right" name="VIPpickup" size=1>
		       			<option value="0" >None</option>
					   <? foreach($VIPpickup as $VIPpickup){
	                     // echo $masaje['name']."<br>";
	                     ?>
	                     <option value="<?=$VIPpickup['id']?>"<? if (in_array($VIPpickup['id'], $services_booked)) {echo " SELECTED";} ?>><?=$VIPpickup['name']." ".$VIPpickup['price']?></option>
	                     <? }?>
	                </select>
	            </p>
		       <!--<br />-->
		        <? $chef=$db->services("chef");?>
		       <p style="text-align:right; font-weight:bold">
	           		<span id="td0">On Site Chef: </span><!--<br />-->
	                <select  class="azul" style="text-align:right" name="chef" size=1>
	                   <option value="0" >None</option>
	                   <? foreach($chef as $chef){
	                     // echo $masaje['name']."<br>";
	                     ?>
	                     <option value="<?=$chef['id']?>"<? if (in_array($chef['id'], $services_booked)) {echo " SELECTED";} ?>><?=$chef['name']." ".$chef['price']?></option>
	                     <? }?>
	                </select>
	           </p>
		       <!--<br />-->
		        <? $fridge=$db->services("Filled Fridge");?>
		       <p style="text-align:right; font-weight:bold">
	           		<span id="td0">Filled Fridge: </span><!--<br />-->
	                <select class="azul" style="text-align:right" name="fridge" size=1>
	                   <option value="0" >None</option>
	                   <? foreach($fridge as $fridge){
	                     // echo $masaje['name']."<br>";
	                     ?>
	                     <option value=<?=$fridge['id']?><? if (in_array($fridge['id'], $services_booked)) {echo " SELECTED";} ?>><?=$fridge['name']." ".$fridge['price']?></option>
	                     <?
	                   }
	                   ?>
	                </select>
	            </p>
		 </fieldset>
	    </td></tr>
	    <tr><td colspan="2">

	    <p id="parraf" style="text-align:left">
	    	Adults: <select name="adults">
	        			<? for ($i=1; $i<=8; $i++){?>
							<option value="<?=$i?>" <? if ($book[0]['adults']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	                 </select>
	  <!--//  </p>
	    <p id="parraf">//-->
	    	Children:
	        	<select name="children">
	        			<? for ($i=0; $i<=8; $i++){?>
							<option value="<?=$i?>"  <? if ($book[0]['kids']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	             </select>


	    </p>
	    <hr />
	    <? /*echo $book[0]['busyid'];*/?>
	    <p style="text-align:right; font-weight:bold; padding:0px 50px 0px 0px;">
	    	<input type="hidden" name="busyid" value="<?=$book[0]['busyid']?>"/>
	        <input type="hidden" name="ref" value="<?=$reference?>"/>
			<input type="hidden" name="reserveid" value="<?=$book[0]['reserveid']?>" ? />
	        <input type="hidden" name="status" value="<?=$book[0]['status']?>" ? />
	    	<input type="submit" value="continue" name="continue" class="book_but"/>
	    </p>
	    </td></tr></table>
		</form>



            <?
       }  //End short term owners
	   
	   
	   if (($estado==38)||($estado==39)||($estado==40)||($estado==41)){  /*/try and buy/*/
		 ?>

		<!--titulo-->
		<p>&nbsp;</p>
		  <h2>Editing booking <span style="color:black;">No.<?=$reference?></span> - Try and buy renters
		 
		  </h2>
		  <hr/>
		<form name="change_booked" action="edit-bookingtb1.php" method="post">
		  <table width="100%" border="0"><tr><td colspan="2" align="center">
			<p class="p_inline">
			<?php if($_SESSION['info']['movevillas']==1){?>
				Villa: <select name="villa">
				<? foreach ($villas as $k){?>
				<option value="<?=$k['id']?>" <? if ($k['id'] == $book[0]['villa']) {echo " SELECTED";} ?>><?=$k['no']?></option>
				<? }?>
				</select>
			<?}else{?>
				Villa: <?=$villa[0]['no']?> <input type="hidden" name="villa" value="<?=$book[0]['villa']?>"/>
			<?php } ?>
			 </p>

	    <p class="p_inline">
	    	From: <input type="text" name="from" value="<?=$book[0]['start']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    <p class="p_inline">
	    	To: <input type="text" name="to" value="<?=$book[0]['end']?>" size="10" /> <span style="color:#999; font-size:9px; font-family:Arial, Helvetica, sans-serif;"><em>YYYY-MM-DD</em></span>

	    </p>
	    </td></tr>
	    <tr><td colspan="2" align="center">
	    <?
	    if (($estado==38)||($estado==39)||($estado==40)||($estado==41)){
	    	?>
	    <!--NORMAL CLIENTS-->
	    <p id="parraf" style="text-align:center;">
	    	Customer: <select name="client" size="1">
	      <? foreach ($customers as $cu ) { ?>
	            <option value="<?=$cu['id']?>" <? if ($cu['id'] == $book[0]['client']) {echo " SELECTED";} ?>><?=$cu['name']." ".$cu['lastname']?>	</option>
	      <? } ?></select>
  <?php if($_SESSION['info']['agentes']==1){?>
	      <!--///*REFERAL AGENTS*///-->
		      	<span style="font-weight:bold;">Referral:</span>
		      	<?php
	                  /*//starting referals   $_SESSION['consultas']*/
						$commisioners=$db->show_all_active('commission', 'name');  /*///elegir solo los activos*/
						$referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
							echo "<select name=\"referal\" >";?>
							<option value="0" >None</opcion>
							<?	foreach ($commisioners as $k){
							?>
	                          <option value="<?=$k['id']?>" <? if ($referido_anterior[0]['id_referal']==$k['id']) echo "selected='selected'"; ?>><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
							<?
							}
							echo "</select>";

				?>
		      <!--///*REFERAL AGENTS*///-->
  <?php }else{
			  $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');
			  if ($referido_anterior[0]['id_referal']!=0){
				echo "<input type=\"hidden\" name=\"referal\" value=\"".$referido_anterior[0]['id_referal']."\">";
			 }
		  }?>
	    </p><?/*=expedia_fields($id_exp=$expedia[0]['exp_id'], $amount_exp=$expedia[0]['exp_amount']);*/?>
        <!--NORMAL CLIENTS-->
        <?}?>
          
        </td></tr>
        <tr><td>
            <!--//  <p><?/* print_r($villa);*/?></p>//-->
	   &nbsp;

	  <!--//  <p id="parraf">
	     	Booking Notes:<textarea name="comment" rows="10" cols="50"><?=$book[0]['rc']?></textarea>
	    </p>//-->
	    </td><td>
	    <fieldset><legend>Additional Services</legend>
		       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->
		       <table align="center"><tr><td valign="top">
		       <?
			   $qty_nights=$book[0]['nights'];
               // ChangeServices($reference, $start_date=$book[0]['start']);/*rental car*/
			    /*$servicios=$db->show_all($table='services', $order='id');
				servicios_reserva($servicios,$qty_nights, $beds=$casa['bed']);*/
		       ?>
              </td><td>
             <?
             	$array_servicios_activos=$db->show_all_active('serv_add', 'id');
             	
             	$services_booked=array();/*//this array must be created even if there is not service, so don't get error if empty.*/
	            if (!empty($servicios_reserva)){
					foreach ($servicios_reserva as $s){
						if($s['tipo']!=2){
							array_push($services_booked,$s['id_service']);
						}
						
	                }
	            }
         	   editar_servicios_bookings($array_servicios_activos,$qty_nights,$services_booked,$book[0]['reserveid']);
             ?>
            </td></tr></table>


		 </fieldset>
	    </td></tr>
	    <tr><td colspan="2">
	     <p id="parraf" style="text-align:left;">
	    	Adults: <select name="adults">
	        			<? for ($i=1; $i<=$villa[0]['capacity']; $i++){?>
							<option value="<?=$i?>" <? if ($book[0]['adults']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	                 </select>
	    	Children:
	        	<select name="children">
	        			<? for ($i=0; $i<=($villa[0]['capacity']/2); $i++){?>
							<option value="<?=$i?>"  <? if ($book[0]['kids']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
						<? }?>
	             </select>
	    </p>
	    <hr />
	    <p style="text-align:right; font-weight:bold; padding:0px 50px 0px 0px;">
	    	<input type="hidden" name="busyid" value="<?=$book[0]['busyid']?>"/>
	        <input type="hidden" name="ref" value="<?=$reference?>"/>
			<input type="hidden" name="reserveid" value="<?=$book[0]['reserveid']?>" ? />
	        <input type="hidden" name="status" value="<?=$book[0]['status']?>" ? />
	    	<input type="submit" value="continue" name="continue" class="book_but"/>
	    </p>
	    </td></tr></table>
		</form>
 	 <?
      }
	   
	   
	   
    }//if is is check out and is manager

    }else{
	  echo '<p>&nbsp;</p>';
	  echo "<hr /><p style='text-align:center; color:red;'><strong>Booking <span style='color:blue'>$reference</span> not found</strong></p>";
	}
 }else{?>
	<p>&nbsp;</p>
	<h2 align="center">Type reference number below</h2>

	<hr />
    <table align="center" ><tr><td>

    <form method="post" action="edit-booking.php">
        <input type="text" name="refnumb" />
        <input type="submit" name="go" value="go" class="book_but" />
    </form></td></tr></table>
 <? }

 ?>