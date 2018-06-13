<!--<p class="header">Search Bookings</p>   -->
<h2 class="centro">Search Bookings</h2>
<p>&nbsp;</p>
<div style="padding-left:35px">
	<form method="post" action="find-booking.php">
		<p style="text-align:center;" id="fields">Reference number: <input style="text-align:right;" class="input" type="text" size="20" name="ref" value="<?=$_POST['ref']?>"  />
       <!-- by <select class="input" name="findby">
			<option  <? if (!$_POST['findby']){?> selected="selected" <? }?> <? if ($_POST['findby']=="id"){?> selected="selected" <? }?>value="id">reference</option>
            <option <? if ($_POST['findby']=="email"){?> selected="selected" <? }?>value="email">villa number</option>
            <option <? if ($_POST['findby']=="lastname"){?> selected="selected" <? }?> value="lastname">client number</option>
            <option <? if ($_POST['findby']=="name"){?> selected="selected" <? }?> value="name">client name</option>
         </select>    -->
         <input class="book_but" type="submit" name="find" value="search" />   </p>
	</form>
</div>
<hr />
<div style="padding-left:35px">
 <? if ($_POST['find']){

		if ($_POST['ref']) $_POST['ref']=trim($_POST['ref']);
		$reference = ereg_replace("[^0-9]", "", $_POST['ref']); //take off all other characters and only left numbers
 		//echo $reference;
		if 	($reference!=''){
			$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
		      if (isLength($reference,6,10)==true){ //verify an lenght between 6 and 10

                        $db= new getQueries();
						$result=$db->see_occupancy_ref($reference);
						//$total_records=$db->getAffectedRows();


				    if ($result){

						  ?>
						<table align="center" cellpadding="2" cellspacing="2">
							<tr>
								<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>DETAILS FOR BOOKING <?=$reference?></strong><!--</p>-->
								</td>
							</tr>
    						<tr bgcolor="#a6cdf4">
	    						<td align="center" class="blue_dark"><strong>Villa</strong>
	    						</td>
	    						<td align="center" class="blue_dark"><strong>From</strong>
	    						</td>
	    						<td  align="center" class="blue_dark"><strong>To</strong>
	    						</td>
	    						<td align="center" class="blue_dark"><strong>Price</strong>
	    						</td>
	    						<td  align="center" class="blue_dark"><strong>Comment</strong>
	    						</td>
	    						<td align="center" class="blue_dark"><strong>Ref.</strong>
	    						</td>
	    						<td  class="blue_dark" align="center"><strong>Status</strong>
	    						</td>
    						</tr>
    					<? foreach ($result as $b){?>
						    <tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
							    <td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
							    <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
							    <td style="font-size:11px"  ><?=$b['ppn']?></td>
							    <td style="font-size:11px" ><?=$b['note']?></td>
							    <td  style="font-size:11px" ><?=$b['ref']?></td>
							    <td  style="font-size:11px" >
							    	<? switch ($b['status']){
							            case 0:
							                echo "<span style='color:red'>Cancelled</span>";
							                break;
							            case 1:
							                echo "<span class='verde'>Checked&nbsp;in</span>";
							                break;
							            case 2:
							                echo "<span class='azul2'>Confirmed</span>";
							                break;
							            case 3:
							                echo "<span class='morado'>Transit</span>";
							                break;
							            case 4:
							                echo "<span class='azul'>Checked&nbsp;out</span>";
							                break;
							            case 5:
         									echo "<span style='color:red'>Maintenance</span>";
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
							                echo "<span class='negro'>Unavailabe</span>";
							                break;
							        }?></td>
							</tr>
							    <? }?>
						    </table>
						<?
					}else{
						echo "<p>&nbsp;</p>";
						echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Result Found</p>";
					}
			  }else{
				echo "<p>&nbsp;</p>";
				echo "<p class='centro' style='font-weight:bold; font-size:16px;'>invalid number, please, check again</p>";
			  }
		}else{
			echo "<p>&nbsp;</p>";
			echo "<p style='color:red; text-align:center; font-weight:bold;'>Please, type in the searching box a booking reference number.</p>";
		}
 }?>
 </div>