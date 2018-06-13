<?php
$data= new getQueries ();
$services=$data->show_active_services();
/*=======================================================================================================*/
?>
   <p class="header">Booking system - Add Services to a Booking</p>
   <form action="view-services_booking.php" method="post">
	    <p>Reference Number: <input type="text" name="ref" value="<?=$_POST['ref']?>" /> <input name="go" type="submit" value="Search" /></p>
   </form>
<?
 if($_POST['go']=='Search'){
//$reference='3198';
    $reference=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
						      if (isLength($reference,6,10)==true){ //verify an lenght between 6 and 10

				                        $db= new getQueries();
										$result=$db->see_occupancy_ref($reference);
										//$total_records=$db->getAffectedRows();


								    if ($result){
                                          $bo=$result[0];
                                          $villa_reserva=$db->villa($bo['villa']);
                                          $cl=$db->customer($bo['client']);
										  ?>
										  <div style="background-color:green; padding:5px; margin:5px;">
										  <h3>Details of booking</h3>
										  <p style="color:white; font-size:16px;">Villa:<b><?=$villa_reserva[0]['no']?></b> &nbsp;&nbsp;
										  From:<b><?=formatear_fecha($bo['start'])?></b>&nbsp;&nbsp;
										  To:<b><?=formatear_fecha($bo['end'])?></b>&nbsp;&nbsp;Client's name: <b><?=$cl['name']?>&nbsp;<?=$cl['lastname']?></b></p>

										  </div>
                                        <form action="view-services_booking.php" method="post">
											  <fieldset><legend>SERVICES</legend>
											        <?

											        //$bo['busyid'];
											        //print_r($bo);
											        $servicios_reserva=$db->services_reserved($bo['busyid']);
											        /*echo '<pre>';
											        print_r($servicios_reserva);
											        echo '</pre>';*/
											        $ss_id=array(); //services selected id


											         foreach($servicios_reserva AS $s){
											          $ss_qty[$s['serviceid']]=array(); //services selected qty
											           array_push($ss_id,$s['serviceid']);
											           array_push($ss_qty[$s['serviceid']],$s['qty']);
											         }

													foreach ($services AS $k) {
														?>
														<span style="display: block; float: left; height: 18px; line-height: 18px; margin: 1px; padding: 3px 0; width: 250px; font-size:10px;">
											            <input type="checkbox" value="<?=$k['id']?>" name="serv[<?=$k['id']?>]"  <? if (in_array($k['id'], $ss_id)){ echo 'checked="checked"'; }?>   > <?=substr($k['name'], 0, 20);?> (US$ <?=number_format($k['price'],0)?>)
											            <select name="qty[<?=$k['id']?>]">
											            	<?for($i=1; $i<=50; $i++){?>
											                 <option value="<?=$i;?>" <? if($ss_qty[$k['id']]!=''){if (in_array($i, $ss_qty[$k['id']])){ echo 'selected="selected"'; }}?>><?=$i;?></option>
											            	<?}?>
											              </select>
														</span>
                                                        <?
                                                         if($k['type']=='Car_Rental'){                                                          $precio_servicio=$k['hs_price2'];
                                                          /* $precio_servicio=price_vehicle($id=$serv['id'], $start_date=$starting, $days=$_POST['qty'][$serv['type'].$cars_qty]);
               											  $amount_cars+=$precio_servicio*$_POST['qty'][$serv['type'].$cars_qty];*/  /*need it to calculate the taxes for this services*/
                                                         }else{                                                          $precio_servicio=$k['price'];
                                                         }

               											  //editar la reservacion para poder aplicar el nuevo monto total y el monto por los servicios creo; los nuevos impuestos

                                                         ?>
														<input type="hidden" name="price[<?=$k['id']?>]" value="<?=$precio_servicio?>"/>
														<?
													}

													?>
											   </fieldset>
                                                <? /*print_r($bo);*/?>

                                               <input type="hidden" name="id_reserve" value="<?=$bo['reserveid']?>"/>
                                               <input type="hidden" name="reserve_amount" value="<?=$bo['total']?>"/>
											   <input type="submit" name="apply" value="Apply Services"/>
										</form>

									<?
									}else{
										echo "<p>&nbsp;</p>";
										echo "<hr/>";
										echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No result found for this booking number</p>";
									}
							  }else{
								echo "<p>&nbsp;</p>";
								echo "<hr/>";
								echo "<p class='centro' style='font-weight:bold; font-size:16px;'>Invalid number, please, try again</p>";
							  }
 }

  if($_POST['apply']=='Apply Services'){      echo "servicios aplicados";
      //DELETE OLD SAVED SERVICES
	$link=new DB();
	$db= new subDB (); //CONNECT TO DATABASE
 	$link->delete_items('serv_reserv', 'id_reserve', $_POST['id_reserve']);   //table - field_condition - value

   if($_POST['serv']){   	$amount_services=0;
      foreach($_POST['serv'] AS $ids){
      	$qty=$_POST['qty'][$ids];

      	$precio=$_POST['price'][$ids]*$qty;

		echo $qty; echo '*'; echo $_POST['price'][$ids]; echo '='; echo $precio; echo '<br/>';

        $amount_services+=$precio;/*nuevo monto para los servicios*/
         $db->insert_additional_services($ids, $_POST['id_reserve'],$qty,$precio , $comment="");
      }
      echo $amount_services;

      $nuevo_total=$_POST['reserve_amount']+$amount_services;
      //$nuevo_total=$_POST['reserve_amount'];
      $db->upd_reserv($_POST['id_reserve'], $nuevo_total);
   }

  }
?>