<?
 if ($_SESSION['info']){
   if ($_POST){   	 $_SESSION['NO_REFRESH']=1;

	$adults=$_POST['adults'];	$client=$_POST['client'];	$children=$_POST['children'];
	$massage=$_POST['massage'];	$pickup=$_POST['pickup'];  	$VIPpickup=$_POST['VIPpickup'];
	$chef=$_POST['chef'];  	$fridge=$_POST['fridge'];	$villa_no=$_POST['villa_no'];
	$starting=$_POST['starting'];	$ending=$_POST['$ending'];	$nights=$_POST['nights'];
	$villa_id=$_POST['villa_id'];  	$starting=$_POST['starting'];
	$ending=$_POST['ending'];$status=$_POST['status']; $comment=$_POST['comment'];


	$price=$_POST['price']; $priceHS=$_POST['priceHS'];
	$LS_nights=$_POST['LS_nights'];$HS_nights=$_POST['HS_nights'];

	?>
	<!--<img src="images/logo.gif" border="0" style="float:left"><br/>  -->
	    <h2 style="text-align:center; color:#18d62e;">Owner Staying - Short Term (step 3)</h2>
	 	     <hr />
	      <form method="post" action="owner_staying1.php" name="st">

	      <? /*echo  $_SESSION['info_villa']['no']."<br>"*/?>
	    <? /*echo  $_SESSION['info']['name']."<br>"*/?>

<div style="float:left; width:450px; border:0px solid red; padding:0px 0px 0px 20px;">   <!--START DIV DETAILS-->
	<!--EMPIEZO A MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
	<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
		<tr>
			<td colspan="2" bgcolor="#3794ea" align="center">
				<span style="color:white;">BOOKING INFORMATION</span>
			</td>
		</tr>
		<tr>
			<td id="td" colspan="2" style="color:blue;" align="right">
				Villa No.<strong><?=$villa_no?></strong><br />
				Reservation from: <strong><?=formatear_fecha($starting);?></strong>
				<br/> To: <strong><?=formatear_fecha($ending);?></strong>
			</td>
		</tr>
	    <tr>
	    <? if (($HS_nights>0)&&($LS_nights>0)){ ?>
	    	<td id="td" style="text-align:right;">
	    		<?=$LS_nights?> Nights x LS US$ <?=$price;?> =<br />
	    		<?=$HS_nights?> Nights x HS US$ <?=$priceHS;?> =
	    	</td>
	    	<td id="td" width="90" style="text-align:right;">
	    		<? $amount_nightsLS=($LS_nights*$price); echo "US$ ".number_format($amount_nightsLS,2); ?><br />
	    		<? $amount_nightsHS=($HS_nights*$priceHS); echo "US$ ".number_format($amount_nightsHS,2); ?>
	    	 </td>
	    <? }?>

	    <? if (($HS_nights>0)&&($LS_nights==0)){ ?>
	    	<td id="td" style="text-align:right;">
	    		<?=$nights?> Nights x HS US$ <?=$priceHS;?> =
	    	</td>
	    	<td id="td" width="90" style="text-align:right;">
	    		<? $amount_nightsHS=($nights*$priceHS); echo "US$ ".number_format($amount_nightsHS,2); ?>
	    	 </td>
	    <? }?>

	    <? if (($HS_nights==0)&&($LS_nights>0)){ ?>
	    	<td id="td" style="text-align:right;">
	    		<?=$nights?> Nights x LS US$ <?=$price;?> =
	    	</td>
	    	<td id="td" width="90" style="text-align:right;">
	    		<? $amount_nightsLS=($nights*$price); echo "US$ ".number_format($amount_nightsLS,2); ?>
	    	 </td>
	    <? }
	     $amount_nights=$amount_nightsLS+$amount_nightsHS;

	    ?>
	    </tr>


	   <tr>
	   		<td id="td" style="text-align:right;">
	   			<strong>Sub total =</strong>
	   		</td>
	   		<td id="td" style="text-align:right;">
	   			<? $sub_total=($amount_nights+$itbis); echo "<strong>US$ ".number_format($sub_total,2)."</strong>";?>
	   		</td>
	   	</tr>


	            <!--SERVICES ADDITIONALS-->
	            <?  if ($massage>0 || $pickup>0 || $VIPpickup>0 || $chef>0 || $fridge>0 || $_POST['cars']>0){
					$result= new getQueries;
						if ($massage>0){
						//$result=$_SESSION['consultas'];
						$massage_details=$result->additional_service($massage, 'massage');
						?>
						<tr><td id="td" style="text-align:right; color:#00F;">Massage <?=$massage_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_massage=$massage_details['price']; echo $amount_massage; ?></td></tr>
	                    <input type="hidden" name="massage_id" value="<?=$massage;?>" />
	             		<input type="hidden" name="massage_amount" value="<?=$amount_massage;?>" />
						<? } ?>

						 <?
						if ($pickup>0){
						//$result= new getQueries;
						$pickup_details=$result->additional_service($pickup, 'Airport Pick Up');
						?>
						<tr><td id="td" style="text-align:right;  color:#00F;"><?=$pickup_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_pickup=$pickup_details['price']; echo $amount_pickup; ?></td></tr>
	                    <input type="hidden" name="pickup_id" value="<?=$pickup;?>" />
	             		<input type="hidden" name="pickup_amount" value="<?=$amount_pickup;?>" />
						<? } ?>

					 	<?
						if ($VIPpickup>0){
						//$result= new getQueries;
						$VIPpickup_details=$result->additional_service($VIPpickup, 'VIP Airport Pick Up');
						?>
						<tr><td id="td" style="text-align:right;  color:#00F;"><?=$VIPpickup_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_VIPpickup=$VIPpickup_details['price']; echo $amount_VIPpickup; ?></td></tr>
	                    <input type="hidden" name="VIPpickup_id" value="<?=$VIPpickup;?>" />
	             		<input type="hidden" name="VIPpickup_amount" value="<?=$amount_VIPpickup;?>" />
						<? } ?>

						 <?
						if ($chef>0){
						//	$result= new getQueries;
						$chef_details=$result->additional_service($chef, 'chef');
						?>
						<tr><td id="td" style="text-align:right;  color:#00F;"> <?=$chef_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_chef=$chef_details['price']; echo $amount_chef; ?></td></tr>
	                    <input type="hidden" name="chef_id" value="<?=$chef;?>" />
	             		<input type="hidden" name="chef_amount" value="<?=$amount_chef;?>" />
						<? } ?>

						<?
						if ($fridge>0){
						//$result= new getQueries;
						$fridge_details=$result->additional_service($fridge, 'Filled Fridge');
						?>
						<tr><td id="td" style="text-align:right;  color:#00F;">Filled Fridge <?=$fridge_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_fridge=$fridge_details['price']; echo $amount_fridge; ?></td></tr>
	                    <input type="hidden" name="fridge_id" value="<?=$fridge;?>" />
	             		<input type="hidden" name="fridge_amount" value="<?=$amount_fridge;?>" />
						<? }

						if ($_POST['cars']>0){
						$cars_details=$result->additional_service($_POST['cars'], 'Car_Rental');
						if ($_POST['qtydcars']<5){ $precio_renta_cars=$cars_details['price'];}else{$precio_renta_cars=$cars_details['price_min'];}
						?>
						<tr><td id="td" style="text-align:right;  color:#00F;"><?=substr($cars_details['name'],0,15);?> (<?=$_POST['qtydcars']?> days at <?=$precio_renta_cars?>)=</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_cars=$precio_renta_cars*$_POST['qtydcars']; echo number_format($amount_cars,2); ?></td></tr>
	                    <input type="hidden" name="cars_id" value="<?=$_POST['cars'];?>" />
	             		<input type="hidden" name="cars_amount" value="<?=$amount_cars;?>" />
	             		<input type="hidden" name="cars_days" value="<?=$_POST['qtydcars'];?>" />
						<? } //terminan los servicios para carro

						$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup+$amount_cars); ?>
	                    <tr><td id="td" style="text-align:right;  color:#00F; font-weight:bold;">Total additionals services=</td><td id="td" style="text-align:right; color:#00F; font-weight:bold;">US$ <?=number_format($sub_services,2); ?></td></tr>
	                    <input type="hidden" name="services_amount" value="<?=$sub_services;?>" />

			<?	}?>
	            <!--SERVICES ADDITIONALS-->
	             <tr>
			    	<td id="td" style="text-align:right;">
			    		VAT - TAX <?=TAX_PERCENT?> of <?=number_format($amount_nights-$descuento+$amount_cars,2);?> =
			    	</td>
			    	<td id="td" style="text-align:right;">
			    		<? $itbis=(($amount_nights-$descuento+$amount_cars)*TAX_DECIMAL); echo "US$ ".number_format($itbis,2); ?>
			    	</td>
			    </tr>
	            <tr><td id="td" style="text-align:right;"><strong>GENERAL AMOUNT = </strong></td><td id="td" style="text-align:right;"><? $general_amount=$sub_total+$sub_services+$itbis; echo "<strong>US$ ".number_format($general_amount,2)."</strong>"; ?></td></tr></table>
     </div>   <!--END FIRST DIV DETAILS-->

<div style="float:left; width:450px; border-bottom:0px solid blue;">   <!--START SECOND DIV DETAILS-->


	           <table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;"><tr><td colspan="4" bgcolor="#3794ea" align="center"><span style="color:white;">MORE BOOKING DETAILS</span></td></tr>

				<tr><td  id="td"><strong>Adults:</strong></td><td id="td"><span style="color:#3b3838;"> <?=$adults?>  Person(s)</span> </td><td id="td"><strong>Chidren:</strong></td><td id="td"><span style="color:#3b3838">  <?=$children?> kid(s)</span></td></tr>

	   			 <? $db=new getQueries; $owner=$db->show_id('owners', $client); $client_details=$owner[0];?>
	   			  <tr><td id="td"> <strong>Owner:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['name']." ".$client_details['lastname'];?></span></td><td id="td"> <strong>Email:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['email'];?></span></td></tr>
	              <? if ($client_details['phone']!=''){?>
	               <tr><td id="td"><!--<br />--><strong> Phone:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"> <?=$client_details['phone'];?></span></td></tr>
	               <? }?>
	               <? if ($client_details['address']!=''){?>
	                <tr><td id="td"><!--<br />--><strong>Address:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"><?=$client_details['address'].", ".$client_details['country'];?></span></td></tr>
	               <? }?>

	              <? if ($_POST['referal']>0){
					  $r=new getQueries; $intermediario=$r->intermediario($_POST['referal']);
					  ?>
					  <tr><td id="td"><!--<br />--><strong>Refered&nbsp;by:</strong></td><td colspan="3" id="td"> <span style="color:#3b3838;"><? echo $intermediario['name']." ".$intermediario['lastname']; echo "-".($intermediario['percent']*100)."%"?> </span></td></tr>
	                  <?/* $total_comision=$amount_nights*$intermediario['percent'];*/ ?>
	                	<input type="hidden" name="id_referal" value="<?=$_POST['referal'];?>"/>
	              <? } ?>

	               <? if ($comment!=''){?>
	           <tr><td id="td" colspan="4"> <strong>Reservation Comment:</strong><br /><span style="color:#3b3838;"> <?=wordwrap($comment, 75, "\n", true);?> </span><?}?></td></tr>
	            <tr><td id="td" style="text-align:right"> <strong>Status: </strong></td><td id="td" nowrap="nowrap"><? //=$status
				switch ($status){
					case 7: echo "<span style='color:green;'>Checking in</span>";
						break;
					case 19: echo "<span style='color:#00F;'>Confirmed</span>";
					        echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=000.00>";
						break;
					case 20: echo "<span style='color:#FF0000;'>Not confirmed</span>";
							//echo " - <span style='color:green;'>Deposit</span> <input type=text name=deposit size=5 value=000.00>";
						break;
					case 21: echo "<span style='color:#FF0000;'>Check out</span>";
							break;
				}
				?> </td><td id="td" style="text-align:right"><strong>Made by: </strong></td><td id="td"><span style="color:#3b3838;"><?=$_SESSION['info']['name']?></span></td></tr></table>
	 </div><!--END SECOND DIV DETAILS-->

<div style="clear:both; width:100%; border-bottom:0px solid black;">   <!--START THIRD DIV DETAILS-->
     <fieldset><legend>Adults Names</legend>
	  <? for ($i=1; $i<=$adults;$i++){
	       // if ($adults==1){
	       if ($i==1){
	         /* $custom=new getQueries; */ $client_name=$owner[0]; //$cm=$client_name['name']." ".$client_name['lastname'];
	        	?>
	        <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$client_name['name']?>" /> Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$client_name['lastname'];?>" /></p>
	      <? }else{  ?>
	       <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
	       <?=$i;?> Name: <input type="text" size="25" name="a_name<?=$i;?>" value="" /> Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="" /></p>
	     <?  }
	   } ?>
	      </fieldset><br>

	      <? if($children>0){?>
	           <fieldset><legend>Children Names</legend>
	          <?for ($i=1; $i<=$children;$i++){?>
	           <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="25" name="c_name<?=$i;?>" value="" /> Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" value="" /></p>
	          <? }  ?>
	        </fieldset>
	      <? }?>
	        <? if ($massage>0 || $pickup>0 || $VIPpickup>0 || $chef>0 || $fridge>0){?>
			<fieldset><legend>Services Notes</legend>
				<table align="center" border="0">
				   <? if($massage>0){?>
                   <tr>
                     <td>
					   <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Massage: </p>
                        </td>
					  <td>
                       <input type="text" name="massage_comment" value="" size="55" />
                     </td>
				   </tr>
				  <? }?>
	              <? if($pickup>0){?>
                  <tr>
                     <td>
					  <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Pickup:</p>
                     </td>
					  <td>
                      <input type="text" name="pickup_comment" value="" size="55" />
                       </td>
				   </tr>
				  <? }?>
	              <? if($VIPpickup>0){?>
                   <tr>
                     <td>
					  <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">VIP Pickup:</p>
                      </td>
					  <td>
                      <input type="text" name="VIPpickup_comment" value="" size="55" />
                       </td>
				   </tr>
				  <? }?>
	              <? if($chef>0){?>
                  <tr>
                     <td>
					   <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Chef:</p>
                     </td>
					  <td>
                        <input type="text" name="chef_comment" value="" size="55" />
                         </td>
				   </tr>
				  <? }?>
	              <? if($fridge>0){?>
                   <tr>
                     <td>
					 <p style="text-align:right; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Filled Fridge:</p>
                     </td>
					  <td>
                     <input type="text" name="fridge_comment" value="" size="55" />
                         </td>
				   </tr>
				  <? }?>
	             </table>
               </fieldset>
	           <? }?>
</div>   <!--END THIRD DIV DETAILS-->
    <hr />
	<!--campos que envian datos a la seccion final-->
	<input type="hidden" name="id_villa" value="<?=$villa_id;?>" />
	<input type="hidden" name="id_customer" value="<?=$client;?>" />
	<input type="hidden" name="id_adm" value="<?=$_SESSION['info']['id'];?>" />
	<input type="hidden" name="starting_date" value="<?=$starting;?>" />
	<input type="hidden" name="ending_date" value="<?=$ending;?>" />
	<input type="hidden" name="qty_nights" value="<?=$nights;?>" />
	<input type="hidden" name="price_per_night" value="<?=$price;?>" />
	<input type="hidden" name="amount_per_nights" value="<?=$amount_nights;?>" />
	<input type="hidden" name="ITBIS" value="<?=$itbis;?>" />
	<input type="hidden" name="sub_total_rent" value="<?=$sub_total;?>" />
	<input type="hidden" name="general_amount" value="<?=$general_amount;?>" />
	<input type="hidden" name="priceHS" value="<?=$priceHS;?>" />
	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />

	<? if ($children>0){?>
	<input type="hidden" name="children_qty" value="<?=$children;?>" />
	<?}?>
	<input type="hidden" name="adults_qty" value="<?=$adults;?>" />
	<? if ($client_details['id_commission']>0){?>
	<input type="hidden" name="interm_id" value="<?=$client_details['id_commission'];?>" />
	<?}?>

	<input type="hidden" name="reserve_comment" value="<?=$comment;?>" />

	<input type="hidden" name="status" value="<?=$status;?>" />

	<!--campos que envian datos a la seccion final-->
	    <INPUT class="book_but" TYPE="button" onClick="location.href='short-term-book.php?villa=<?=$villa_id?>&v2=<?=$villa_id?>&start=<?=$starting?>&end=<?=$ending?>&destine=owner'"  VALUE="Back" title="Hit to go back">
	    <input class="book_but" type="submit" name="confirm" value="Done"  title="Save Reservation" onclick="return muestraConfirm('<?=$general_amount?>', document.st.deposit.value);"/>
	    <span style="font-size:10px; color: #06F; font-family:Arial, Helvetica, sans-serif;"><span style="color:red"><strong>WARNING!:</strong></span> Make sure that all information is correct before confirming reservation</span>
	     <!-- <input class="submit" onmouseover="this.className='submitover'" onmouseout="this.className='submit'" type="submit" name="confirm" value="Done"  title="Save Reservation" />-->
	      </form>

	<?
   }else{ echo "<h2>Error with data, try again.</h2>";}
 }else{
	 header('Location:login.php');
	 die();
 }
?>