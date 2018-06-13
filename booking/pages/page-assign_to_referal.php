<? if (!$_POST['assign']=='Assign'){?>
	<h2 class="centro">Search a booking</h2>
	<p>&nbsp;</p>
	<div style="padding-left:35px">
		<form method="post" action="assign_to_referal.php">
			<p style="text-align:center;" id="fields">Reference number: <input style="text-align:right;" class="input" type="text" size="20" name="ref" value="<?=$_POST['ref']?>"  />
	         <input class="book_but" type="submit" name="find" value="search" />   </p>
		</form>
	</div>
	<hr />
	<div style="padding-left:35px">
	 <? if ($_POST['find']){

		if ($_POST['ref']) $_POST['ref']=trim($_POST['ref']);
		$reference = ereg_replace("[^0-9]", "", $_POST['ref']); //take off all other characters and only left numbers
			if 	($reference!=''){
				$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
			      if (isLength($reference,6,10)==true){ //verify an lenght between 6 and 10

	                        $db= new getQueries();
							$result=$db->see_occupancy_ref($reference);

					    if ($result){

							  ?>
						<form method="post" action="assign_to_referal.php" >
							<table align="center" cellpadding="2" cellspacing="2">
								<tr>
									<td
									<? if (($result[0]['status']<>0)&&($result[0]['status']<>5)&&($result[0]['status']<>7)&&($result[0]['status']<>19)&&($result[0]['status']<>20)&&($result[0]['status']<>21)&&($result[0]['status']<>22)&&($result[0]['status']<>23)&&($result[0]['status']<>24)&&($result[0]['status']<>25)){?>
									colspan="7"
									<?}else{?>
									 colspan="5"
									<?}?>
									 align="center" width="85%" class="blue_light"><strong>DETAILS FOR BOOKING <?=$reference?></strong><!--</p>-->
									</td>
								</tr>
	    						<tr bgcolor="#a6cdf4">
		    						<td align="center" class="blue_dark"><strong>Villa</strong>
		    						</td>
		    						<td align="center" class="blue_dark"><strong>From</strong>
		    						</td>
		    						<td  align="center" class="blue_dark"><strong>To</strong>
		    						</td>
		    						<td align="center" class="blue_dark"><strong>Ref.</strong>
		    						</td>
		    						<td  class="blue_dark" align="center"><strong>Status</strong>
		    						</td>
		    						<? if (($result[0]['status']<>0)&&($result[0]['status']<>5)&&($result[0]['status']<>7)&&($result[0]['status']<>19)&&($result[0]['status']<>20)&&($result[0]['status']<>21)&&($result[0]['status']<>22)&&($result[0]['status']<>23)&&($result[0]['status']<>24)&&($result[0]['status']<>25)){?>
			    						<td align="center" class="blue_dark"><strong>Referal</strong>
			    						</td>
			    						<td  class="blue_dark" align="center"><strong>Action</strong>
			    						</td>
                                    <? } ?>
	    						</tr>
	    					<? foreach ($result as $b){?>
							    <tr  bgcolor="#CCCCCC" >
								    <td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
								    <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
								    <td  style="font-size:11px" ><?=$b['ref']?></td>
								    <td  style="font-size:11px" >
								    	<? switch ($b['status']){
								            case 0:
								                echo "<span style='color:red'>Cancelled</span>";
								                break;
								            case 1:
									         	echo "<span class='azul2'>Checked in - Short</span>";
										       	break;
										    case 2:
									         	echo "<span class='azul2'>Confirmed - Short</span>";
										       	break;
										    case 3:
									         	echo "<span class='morado'>No Confirmed - Short </span>";
										       	break;
											case 4:
									         	echo "<span class='outck'>Checked out - Short</span>";
										       	break;
										    case 5:
									         	echo "<span style='color:red'>Maintenance (out of service)</span>";
										       	break;
										   case 6:
									         	echo "<span class='r_vip'>Checked in - VIP, Short</span>";
										       	break;
										    case 7:
									         	echo "<span class='r_owner'>Checked in - Owner, Short</span>";
										       	break;
										    case 8:
									         	echo "<span class='r_long'>Checked in - Long</span>";
										       	break;
										    case 9:
									         	echo "<span class='r_long'>Confirmed - Long</span>";
										       	break;
										 	case 10:
									         	echo "<span class='r_long'>No Confirmed - Long</span>";
										       	break;
										    case 11:
									         	echo "<span class='r_long'>Checked Out - Long</span>";
										       	break;
										 	case 12:
									         	echo "<span class='r_vip'>Confirmed - VIP, Short</span>";
										       	break;
										    case 13:
									         	echo "<span class='r_vip'>No Confirmed - VIP, Short</span>";
										       	break;
										 	case 14:
									         	echo "<span class='r_vip'>Checked Out - VIP, Short</span>";
										       	break;
										    case 15:
									         	echo "<span class='r_vip'>Checked in - VIP, Long</span>";
										       	break;
										 	case 16:
									         	echo "<span class='r_vip'>Confirmed - VIP, Long</span>";
										       	break;
										    case 17:
									         	echo "<span class='r_vip'>No Confirmed - VIP, Long</span>";
										       	break;
										 	case 18:
									         	echo "<span class='r_vip'>Checked Out - VIP, Long</span>";
										       	break;
										    case 19:
									         	echo "<span class='r_long'>Confirmed - Owner, Short</span>";
										       	break;
										 	case 20:
									         	echo "<span class='r_long'>No confirmed - Owner, Short</span>";
										       	break;
										    case 21:
									         	echo "<span class='r_long'>Checked Out - Owner, Short</span>";
										       	break;
										 	case 22:
									         	echo "<span class='r_long'>Checked in - Owner, Long</span>";
										       	break;
										    case 23:
									         	echo "<span class='r_long'>Confirmed - Owner, Long</span>";
										       	break;
										 	case 24:
									         	echo "<span class='r_long'>No confirmed - Owner, Long</span>";
										       	break;
										    case 25:
									         	echo "<span class='r_long'>Checked Out - Owner, Long</span>";
										       	break;
								            default:
								                echo "<span class='negro'>Unavailabe</span>";
								                break;
								        }?></td>

							  <? if (($b['status']<>0)&&($b['status']<>5)&&($b['status']<>7)&&($b['status']<>19)&&($b['status']<>20)&&($b['status']<>21)&&($b['status']<>22)&&($b['status']<>23)&&($b['status']<>24)&&($b['status']<>25)){?>

								       <td>
	                                     	<?php
	                                     	//starting referals
											$commisioners=$db->show_all_active('commission', 'id');  ///elegir solo los activos
											echo "<select name=\"referal\" >";?>
												<option value="0">None</opcion>
											<?	foreach ($commisioners as $k){
												?>
	                                             <option value="<?=$k['id']?>"><?=$k['name']?>&nbsp;<?=$k['lastname']?></opcion>
												<?
											}
											echo "</select>";
											//ending referals
												?>
								        </td>
								        <td>
								        <input type="hidden" name="booking_ref" value="<?=$b['ref']?>"/>
								        <input type="submit" name="assign" value="Assign" class="book_but" onClick="return confirmSubmitText('Are you sure you want to assign booking no. <?=$b['ref'];?> to selected Referal Agent');"/></td>
                              <?}?>
								</tr>
							<? }?>
							</table>
						 </form>
							<?
						}else{
							echo "<p>&nbsp;</p>";
							echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
						}
				  }else{
					echo "<p>&nbsp;</p>";
					echo "<p class='centro' style='font-weight:bold; font-size:16px;'>Invalid number, please, try again</p>";
				  }
			}else{
				echo "<p>&nbsp;</p>";
				echo "<p style='color:red; text-align:center; font-weight:bold;'>Please, type in the searching box a booking reference number.</p>";
			}
	 }?>
	 </div>
<?}else{ //echo "Asignado";
 $referal=$_POST['referal'];
 $reference=$_POST['booking_ref'];
 $id_adm=$_SESSION['info']['id'];
// echo $_SESSION['info']['id'];
  $db= new getQueries();
  $link=new subDB();

 $referido_anterior=$db->show_any_data_limit1('bookingreferred', 'ref_book', $reference, '=');

  if ($referido_anterior){  	#echo "actualizar";
  	$id_update=$link->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
  	//echo $referido_anterior[0]['id_referal'];
    $actualizado=$link->update_assign($referido_anterior[0]['id'], $reference, $referal, $id_adm, $id_update);

  	echo "<p>&nbsp;</p><p style='color:red; font-size:16px; text-align:center;'>Booking successfully reassigned</p>";
  }else{

	$result=$link->Assign_a_booking($reference, $referal, $id_adm);
	 if ($result){	 echo "<p>&nbsp;</p><p style='color:blue; font-size:16px; text-align:center;'>Booking successfully assigned</p>";
	 }
    #echo "insertar";
  }


}?>